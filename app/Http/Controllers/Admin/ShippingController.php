<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\ShippingExport;
use App\Exports\ShippingEmailErrorExport;
use App\Exports\ShippingEmailSuccessExport;
use App\Exports\ShippingEmailExport;
use App\Mail\MailtrapMail;
use App\Http\Requests\ShippingStoreRequest;
use App\Http\Requests\ShippingUpdateRequest;

use App\Models\Customer;
use App\Models\Shipping;
use App\Models\CustomerAccount;
use App\Models\ShippingEmail;
use App\Models\ShippingImage;

class ShippingController extends Controller
{
	public function index(Request $request)
	{
		if (!$request->get('keyword')) {

			if ( !$request->filled('data_inicial') && !$request->filled('data_final') ) {
				$shippings = Shipping::orderBy('created_at', 'desc')->paginate(10)->withQueryString();
			}
			else if(!$request->filled('data_inicial') || !$request->filled('data_final')) {

				if (!$request->filled('data_inicial') && $request->filled('data_final')) {
					$shippings = Shipping::where('created_at', '<=', $request->get('data_final').' 23:59:59')
					->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
				}
				else {
					$shippings = Shipping::where('created_at', '>=', $request->get('data_inicial').' 00:00:00')
					->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
				}

			}
			else{
				$shippings = Shipping::whereBetween('created_at', [$request->get('data_inicial').' 00:00:00', $request->get('data_final').' 23:59:59'])
				->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
			}

		}
		else {
			$shippings = Shipping::where('name', 'LIKE', '%'.$request->get('keyword').'%')->orderBy('created_at', 'desc')->get();
		}

		return view('admin.shippings.index', ['title' => __('models.shipping'), 'shippings' => $shippings]);
	}

	public function create()
	{
		$customers = Customer::all();
		$customerAccounts = CustomerAccount::all();
		$shippings = Shipping::all();

		return view('admin.shippings.create', ['title' => 'Nova Conta De Disparo', 'shippings' => $shippings, 'customerAccounts' => $customerAccounts, 'customers' => $customers]);
	}

	public function store(ShippingStoreRequest $request)
	{
		try{
			DB::beginTransaction();

			//////////////////////////////////////////////////////////
			/***** 				CHECK SHIPMENT TYPE				*****/
			//////////////////////////////////////////////////////////
			if ($request->get('shipping_type') === 'I') {
				$shippingDate = Carbon::now();
			}else{
				$shippingDate = Carbon::parse($request->get('shipping_date'));
			}

			//////////////////////////////////////////////////////////
			/***** 			NEW OR OLD ACCOUNT IN SHIPMENT		*****/
			//////////////////////////////////////////////////////////
			if ($request->get('newaccount') === 'true') {

				if ($request->get('related') === 'true') {
					$customer = Customer::find(only_numbers($request->get('customer_id')));

					$customerAccount = new CustomerAccount([
						'name' => $request->get('name'),
						'email' => $request->get('email'),
						'domain' => $request->get('domain'),
						'slug' => Str::slug($request->get('name'), '-'),
						'customer_id' => $customer->id,
						'user_id' => auth()->user()->id,
					]);
					$customerAccount->save();
				}else {
					$customerAccount = new CustomerAccount([
						'name' => $request->get('name'),
						'email' => $request->get('email'),
						'domain' => $request->get('domain'),
						'slug' => Str::slug($request->get('name'), '-'),
						'user_id' => auth()->user()->id,
					]);
					$customerAccount->save();
				}

			} else{
				$customerAccount = CustomerAccount::find(only_numbers($request->get('customer_account_id')));
			}

			$shipping = new Shipping([
				'title' => $request->get('title'),
				'html' => $request->get('html'),
				'shipping_type' => $request->get('shipping_type'),
				'shipping_date' => $shippingDate,
				'shipping_code' => $request->get('shipping_code'),
				'slug' => Str::slug($request->get('name'), '-'),
				'customer_account_id' => $customerAccount->id,
				'user_id' => auth()->user()->id,
			]);
			$shipping->save();

			if ($request->hasFile('images')) {
				$images = [];

				foreach ($request->file('images') as $key => $dataImage) {
					$fileoriginalname = $dataImage->getClientOriginalName();

					$filename = pathinfo($fileoriginalname, PATHINFO_FILENAME);
					$extension = pathinfo($fileoriginalname, PATHINFO_EXTENSION);

					$images[] = new ShippingImage([
						'image' => $dataImage->storeAs('uploads/shippings/', $shipping->shipping_code . '-' . $filename . '.' . $extension),
						'user_id' => auth()->user()->id,
					]);
				}
				$shipping->shippingImages()->saveMany($images);
			}

			$dataFile = file($request->file('file'));
			//////////////////////////////////////////////////////////
			/***** 			DELETE DUPLICATE EMAILS				*****/
			//////////////////////////////////////////////////////////
			foreach ($dataFile as $key => $email) {
				for ($i=$key+1; $i < count($dataFile); $i++) {
					if (!empty($dataFile[$i]) && $email == $dataFile[$i]) {
						unset($dataFile[$i]);
					}
				}
			}
			//////////////////////////////////////////////////////////
			/***** 			INSERT EMAILS TO ARRAY				*****/
			//////////////////////////////////////////////////////////
			$shippingEmails = [];
			foreach ($dataFile as $key => $email) {
				$shippingEmails[] = new ShippingEmail([
					'email' => strtolower(str_replace("\n", "", $email)),
					'user_id' => auth()->user()->id
				]);
			}
			$shipping->shippingEmails()->saveMany($shippingEmails);

			DB::commit();
		}catch(\Exception $e){
			DB::rollBack();

			if ($e->getCode() == 0) {
				return redirect()->back()->with('danger', 'A Conta selecionada pode ter sido excluida, por favor tente novamente!!');
			}
			else{
				return redirect()->back()->with('danger', 'Ocorreu um problema, por favor tente novamente!!');
			}
		}

		//////////////////////////////////////////////////////////
		/***** 	SEND MAISL CASE SHIPMENT_TYPE == IMMEDIATE	*****/
		//////////////////////////////////////////////////////////
		if ($shipping->shipping_type == 'I') { //IMMEDIATE
			$shipping->status == 'I'; //IN PROGRESS
			$shipping->save();

			foreach ($shipping->shippingEmails()->get() as $key => $shippingEmail) {
				try{
					Mail::to($shippingEmail->email)->send(new MailtrapMail($shipping, $shippingEmail));

					$shippingEmail->status = "S";

					$shippingEmail->save();
				}catch(\Exception $e){
					$shippingEmail->status = "F";
					$shippingEmail->error = $e->getMessage();

					$shippingEmail->save();
				}
			}

			if ( count($shipping->shippingEmails->where('status', 'F')) >= 1 ) {
				$shipping->status = 'F'; //FAIL
				$shipping->save();
			}else {
				$shipping->status = 'S'; //SUCCESS
				$shipping->save();
			}
		}

		return redirect()->route('admin.shippings.index')->with('success', __('models.shipping').' criado com sucesso');
	}

	public function edit($id)
	{
		$shipping = Shipping::find($id);
		$customers = Customer::all();
		$customerAccounts = CustomerAccount::all();

		$shippingDate = Carbon::parse($shipping->shipping_date);
		$currentDate = Carbon::now();

		if ($shipping->shipping_type != 'I' && $shippingDate->greaterThanOrEqualTo($currentDate)) {
			return view('admin.shippings.edit', ['title' => 'Editar Cliente', 'shipping' => $shipping, 'customerAccounts' => $customerAccounts, 'customers' => $customers]);
		}else{
			return redirect()->route('admin.shippings.index')->with('warning', 'O envio: "'. $shipping->title.'", não pode ser editado pois está definido como envio imediato e/ou já foi enviado!!');
		}

		return redirect()->route('admin.shippings.index')->with('warning', 'Oops, algo deu errado, mas não se preocupe!! Tente novamente em alguns intantes');
	}

	public function update(ShippingUpdateRequest $request, $id)
	{
		$shipping = Shipping::find($id);

		$shippingDate = Carbon::parse($shipping->shipping_date);
		$currentDate = Carbon::now();

		if ($shipping->shipping_type == 'I') { //IMMEDIATE
			return redirect()->route('admin.shippings.index')->with('warning', 'O envio: "'. $shipping->title.'", não pode ser editado porque está definido como envio imediato!!');
		}elseif($shippingDate->lessThanOrEqualTo($currentDate)) {
			return redirect()->route('admin.shippings.index')->with('warning', 'O envio: "'. $shipping->title.'", não pode ser editado porque já foi enviado!!');
		}

		try{
			DB::beginTransaction();

			//////////////////////////////////////////////////////////
			/***** 				CHECK SHIPMENT TYPE				*****/
			//////////////////////////////////////////////////////////
			if ($request->get('shipping_type') === 'I') {
				$shippingDate = Carbon::now();
			}else{
				$shippingDate = Carbon::parse($request->get('shipping_date'));
			}

			//////////////////////////////////////////////////////////
			/***** 			NEW OR OLD ACCOUNT IN SHIPMENT		*****/
			//////////////////////////////////////////////////////////
			if ($request->get('newaccount') === 'true') {

				if ($request->get('related') === 'true') {
					$customer = Customer::find(only_numbers($request->get('customer_id')));

					$customerAccount = new CustomerAccount([
						'name' => $request->get('name'),
						'email' => $request->get('email'),
						'domain' => $request->get('domain'),
						'slug' => Str::slug($request->get('name'), '-'),
						'customer_id' => $customer->id,
						'user_id' => auth()->user()->id,
					]);
					$customerAccount->save();
				}else {
					$customerAccount = new CustomerAccount([
						'name' => $request->get('name'),
						'email' => $request->get('email'),
						'domain' => $request->get('domain'),
						'slug' => Str::slug($request->get('name'), '-'),
						'user_id' => auth()->user()->id,
					]);
					$customerAccount->save();
				}

			} else{
				$customerAccount = CustomerAccount::find(only_numbers($request->get('customer_account_id')));
			}

			$shipping->title = $request->get('title');
			$shipping->html = $request->get('html');
			$shipping->shipping_type = $request->get('shipping_type');
			$shipping->shipping_date = $shippingDate;
			$shipping->customer_account_id = $customerAccount->id;
			$shipping->user_id = auth()->user()->id;

			$shipping->save();

			if ($request->hasFile('images')) {

				foreach ($shipping->shippingImages()->get() as $key => $oldShippingImage) {
					$oldShippingImage->delete();
				}

				$images = [];

				foreach ($request->file('images') as $key => $dataImage) {
					$fileoriginalname = $dataImage->getClientOriginalName();

					$filename = pathinfo($fileoriginalname, PATHINFO_FILENAME);
					$extension = pathinfo($fileoriginalname, PATHINFO_EXTENSION);

					$images[] = new ShippingImage([
						'image' => $dataImage->storeAs('uploads/shippings/', $shipping->shipping_code . '-' . $filename . '.' . $extension),
						'user_id' => auth()->user()->id,
					]);
				}
				$shipping->shippingImages()->saveMany($images);
			}

			if ($request->hasFile('file')) {
				$dataFile = file($request->file('file'));
				//////////////////////////////////////////////////////////
				/***** 				DELETE OLD EMAILS				*****/
				//////////////////////////////////////////////////////////
				foreach ($shipping->shippingEmails()->get() as $key => $oldShippingEmail) {
					$oldShippingEmail->delete();
				}
				//////////////////////////////////////////////////////////
				/***** 			DELETE DUPLICATE EMAILS				*****/
				//////////////////////////////////////////////////////////
				foreach ($dataFile as $key => $email) {
					for ($i=$key+1; $i < count($dataFile); $i++) {
					if (!empty($dataFile[$i]) && $email == $dataFile[$i]) {
							unset($dataFile[$i]);
						}
					}
				}
				//////////////////////////////////////////////////////////
				/***** 			INSERT EMAILS TO ARRAY				*****/
				//////////////////////////////////////////////////////////
				$shippingEmails = [];
				foreach ($dataFile as $key => $email) {
					$shippingEmails[] = new ShippingEmail([
						'email' => strtolower(str_replace("\n", "", $email)),
						'user_id' => auth()->user()->id
					]);
				}
				$shipping->shippingEmails()->saveMany($shippingEmails);
			}

			DB::commit();
		}catch(\Exception $e){
			DB::rollBack();

			if ($e->getCode() == 0) {
				return redirect()->back()->with('danger', 'A Conta selecionada pode ter sido excluida, por favor tente novamente!!');
			}
			else{
				return redirect()->back()->with('danger', 'Ocorreu um problema, por favor tente novamente!!');
			}
		}

		//////////////////////////////////////////////////////////
		/***** 	SEND MAISL CASE SHIPMENT_TYPE == IMMEDIATE	*****/
		//////////////////////////////////////////////////////////
		if ($shipping->shipping_type == 'I') { //IMMEDIATE
			$shipping->status == 'I'; //IN PROGRESS
			$shipping->save();

			foreach ($shipping->shippingEmails()->get() as $key => $shippingEmail) {
				try{
					Mail::to($shippingEmail->email)->send(new MailtrapMail($shipping, $shippingEmail));

					$shippingEmail->status = "S";

					$shippingEmail->save();
				}catch(\Exception $e){
					$shippingEmail->status = "F";
					$shippingEmail->error = $e->getMessage();

					$shippingEmail->save();
				}
			}

			if ( count($shipping->shippingEmails->where('status', 'F')) >= 1 ) {
				$shipping->status = 'F'; //FAIL
				$shipping->save();
			}else {
				$shipping->status = 'S'; //SUCCESS
				$shipping->save();
			}
		}

		return redirect()->route('admin.shippings.index')->with('success', __('models.shipping').' editado com sucesso');
	}

	public function destroy($id)
	{
		$shipping = Shipping::find($id);
		$shipping->delete();
		try {
			$shipping->delete();
			return redirect()->route('admin.shippings.index')->with('success', 'Cliente apagado com sucesso.');
		} catch (\Illuminate\Database\QueryException $e) {
			$errorCode = $e->errorInfo[0];

			if ($errorCode == '23000') {
				return redirect()->route('admin.shippings.index')->with('warning', 'O Cliente não pode ser apagado no momento.');
			} else {
				return redirect()->route('admin.shippings.index')->with('danger', 'Não foi possível apagar o Cliente.');
			}
		}
	}

	public function show(Request $request, $id)
	{
		$shipping = Shipping::find($id);

		if ($request->filled('shipping_error')) {
			$shippingError = $shipping->shippingEmails()->where('status', 'F')->get();
			return view('admin.shippings.show_emails', ['shipping' => $shipping, 'shippingError' => $shippingError]);
		}
		if ($request->filled('shipping_success')) {
			$shippingSuccess = $shipping->shippingEmails()->where('status', 'S')->get();
			return view('admin.shippings.show_emails', ['shipping' => $shipping, 'shippingSuccess' => $shippingSuccess]);
		}
		if ($request->filled('shipping_read')) {
			$shippingRead = $shipping->shippingEmails()->where('read', 'R')->get();
			return view('admin.shippings.show_emails', ['shipping' => $shipping, 'shippingRead' => $shippingRead]);
		}
		if ($request->filled('shipping_all')) {
			$shippingAll = $shipping->shippingEmails()->get();
			return view('admin.shippings.show_emails', ['shipping' => $shipping, 'shippingAll' => $shippingAll]);
		}
		if ($request->filled('shipping_image')) {
			$shippingImage = 'all';
			return view('admin.shippings.show_emails', ['shipping' => $shipping, 'shippingImage' => $shippingImage]);
		}

		return view('admin.shippings.show', ['shipping' => $shipping]);
	}

	public function csv(Request $request)
	{
		if ($request->filled('shipping')) {
			if ($request->get('shipping_email') == 'error') {

				return Excel::download(new ShippingEmailErrorExport(), 'emails-com-erro' . '.csv', \Maatwebsite\Excel\Excel::CSV, [
					'Content-Type' => 'text/csv',
				]);
			}
			elseif ($request->get('shipping_email') == 'success') {
				return Excel::download(new ShippingEmailSuccessExport(), 'emails-enviados' . '.csv', \Maatwebsite\Excel\Excel::CSV, [
					'Content-Type' => 'text/csv',
				]);
			}
			elseif ($request->get('shipping_email') == 'read') {
				return Excel::download(new ShippingEmailSuccessExport(), 'cliques-no-link' . '.csv', \Maatwebsite\Excel\Excel::CSV, [
					'Content-Type' => 'text/csv',
				]);
			}
			elseif ($request->get('shipping_email') == 'all') {
				return Excel::download(new ShippingEmailExport(), 'emails-disparo-todos' . '.csv', \Maatwebsite\Excel\Excel::CSV, [
					'Content-Type' => 'text/csv',
				]);
			}
		}
		else{
			return Excel::download(new ShippingExport(), __('models.shipping') . '.csv', \Maatwebsite\Excel\Excel::CSV, [
				'Content-Type' => 'text/csv',
			]);
		}
	}
}
