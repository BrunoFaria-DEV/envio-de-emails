<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\CustomerAccount;
use App\Models\Customer;

class CustomerAccountController extends Controller
{
    public function index(Request $request)
	{
			if (!$request->get('keyword')) {
				$customerAccounts = CustomerAccount::all();
			} else {
				$customerAccounts = CustomerAccount::where('id', 'like', '%'.$request->get('keyword').'%')
										->orWhere('name', 'like', '%'.$request->get('keyword').'%')
										->orWhere('fantasy_name', 'like', '%'.$request->get('keyword').'%')
                                        ->orWhere('email', 'like', '%'.$request->get('keyword').'%')
                                        ->orWhere('cpf', 'like', '%'.$request->get('keyword').'%')
                                        ->orWhere('cnpj', 'like', '%'.$request->get('keyword').'%')
                                        ->orWhere('phone', 'like', '%'.$request->get('keyword').'%')
                                        ->orWhere('slug', 'like', '%'.$request->get('keyword').'%')
                                        ->orderBy('created_at', 'desc')->get();
			}

		return view('admin.customer_accounts.index', ['title' => trans_choice('models.customer_account', 2), 'customerAccounts' => $customerAccounts]);
	}

	public function create()
	{
		$customers = Customer::all();

		return view('admin.customer_accounts.create', ['title' => 'Nova Conta De Disparo', 'customers' => $customers]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|unique:customer_accounts,name',
			'email' => 'required|unique:customer_accounts,email',
			'domain' => 'required',
			'related' => 'required'
		]);
		
		
		try{
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
			} else{
				$customerAccount = new CustomerAccount([
					'name' => $request->get('name'),
					'email' => $request->get('email'),
					'domain' => $request->get('domain'),
					'slug' => Str::slug($request->get('name'), '-'),
					'user_id' => auth()->user()->id,
				]);
				$customerAccount->save();
			}
		}catch(\Exception $e){
			if ($e->getCode() == 0) {
				return redirect()->back()->with('danger', 'O Cliente selecionado pode ter sido excluido, por favor tente novamente!!');
			}
			else{
				return redirect()->back()->with('danger', 'Ocorreu um problema, por favor tente novamente!!');
			}
		}

		return redirect()->route('admin.customer_accounts.index')->with('success', trans_choice('models.customer_account', 1).'cadastrada com sucesso');
	}

	public function edit($id)
	{
		$customerAccount = CustomerAccount::find($id);
		$customers = Customer::all();

		return view('admin.customer_accounts.edit', ['title' => 'Editar Cliente', 'customers' => $customers, 'customerAccount' => $customerAccount]);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'required|unique:customer_accounts,name,' . $id,
			'email' => 'required|unique:customer_accounts,email,' . $id,
			'domain' => 'required',
			'related' => 'required'
		]);

		try{
			if ($request->get('related') === 'true') {
				$customer = Customer::find(only_numbers($request->get('customer_id')));

				$customerAccount = CustomerAccount::find($id);

				$customerAccount->name = $request->get('name');
				$customerAccount->email = $request->get('email');
				$customerAccount->domain = $request->get('domain');
				$customerAccount->slug = Str::slug($request->get('name'), '-');
				if ($request->get('customer_id') != $customerAccount->customer_id) {
					$customerAccount->customer_id = $customer->id;
				}
				$customerAccount->user_id = auth()->user()->id;

				$customerAccount->save();
			} else{
				$customerAccount = CustomerAccount::find($id);

				$customerAccount->name = $request->get('name');
				$customerAccount->email = $request->get('email');
				$customerAccount->domain = $request->get('domain');
				$customerAccount->slug = Str::slug($request->get('name'), '-');
				$customerAccount->customer_id = null;
				$customerAccount->user_id = auth()->user()->id;

				$customerAccount->save();
			}
		}catch(\Exception $e){
			if ($e->getCode() == 0) {
				return redirect()->back()->with('danger', 'O Cliente selecionado pode ter sido excluido, por favor tente novamente!!');
			}
			else{
				return redirect()->back()->with('danger', 'Ocorreu um problema, por favor tente novamente!!');
			}
		}

		return redirect()->route('admin.customer_accounts.index')->with('success', 'Cliente salvo com sucesso');
	}

	public function destroy($id)
	{
		$customerAccount = CustomerAccount::find($id);
		$customerAccount->delete();
		try {
			$customerAccount->delete();
			return redirect()->route('admin.customer_accounts.index')->with('success', 'Cliente apagado com sucesso.');
		} catch (\Illuminate\Database\QueryException $e) {
			$errorCode = $e->errorInfo[0];

			if ($errorCode == '23000') {
				return redirect()->route('admin.customer_accounts.index')->with('warning', 'O Cliente não pode ser apagado no momento.');
			} else {
				return redirect()->route('admin.customer_accounts.index')->with('danger', 'Não foi possível apagar o Cliente.');
			}
		}
	}

	public function show($id)
	{
		$customerAccount = CustomerAccount::find($id);
		return view('admin.customer_accounts.show', ['customerAccount' => $customerAccount]);
	}
}