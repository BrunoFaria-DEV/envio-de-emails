<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(Request $request)
	{
			if (!$request->get('keyword')) {
				$customers = Customer::all();
			} else {
				$customers = Customer::where('id', 'like', '%'.$request->get('keyword').'%')
										->orWhere('name', 'like', '%'.$request->get('keyword').'%')
										->orWhere('fantasy_name', 'like', '%'.$request->get('keyword').'%')
                                        ->orWhere('email', 'like', '%'.$request->get('keyword').'%')
                                        ->orWhere('cpf', 'like', '%'.$request->get('keyword').'%')
                                        ->orWhere('cnpj', 'like', '%'.$request->get('keyword').'%')
                                        ->orWhere('phone', 'like', '%'.$request->get('keyword').'%')
                                        ->orWhere('slug', 'like', '%'.$request->get('keyword').'%')
                                        ->orderBy('created_at', 'desc')->get();
			}

		return view('admin.customers.index', ['title' => Str::plural(trans('models.customer')), 'customers' => $customers]);
	}

	public function create()
	{
		return view('admin.customers.create', ['title' => 'Novo Cliente']);
	}

	public function store(Request $request)
	{
		$request->merge([
			'cpf' => str_replace(['.', '-', '/'], '', $request->get('cpf')),
			'cnpj' => str_replace(['.', '-', '/'], '', $request->get('cnpj')),
		]);

		if($request->get('type') == 1) {
			$request->validate([
				'fantasy_name' => 'required|unique:customers,fantasy_name',
				'cnpj' => 'nullable|unique:customers,cnpj',
				'email' => 'nullable|unique:customers,email',
			]);

			$customer = new Customer([
				'fantasy_name' => $request->get('fantasy_name'),
				'email' => $request->get('email'),
				'cnpj' => only_numbers($request->get('cnpj')),
				'phone' => only_numbers($request->get('phone')),
				'type' => $request->get('type'),
				'user_id' => auth()->user()->id,
				'slug' => Str::slug($request->get('fantasy_name'), '-')
			]);

		} else{
			$request->validate([
				'name' => 'required|unique:customers,name',
				'cpf' => 'nullable|unique:customers,cpf',
				'email' => 'nullable|unique:customers,email',
			]);

			$customer = new Customer([
				'name' => $request->get('name'),
				'email' => $request->get('email'),
				'cpf' => only_numbers($request->get('cpf')),
				'phone' => only_numbers($request->get('phone')),
				'type' => $request->get('type'),
				'user_id' => auth()->user()->id,
				'slug' => Str::slug($request->get('name'), '-')
			]);
		}

		$customer->save();

		return redirect()->route('admin.customers.index')->with('success', 'Cliente cadastrado com sucesso');
	}

	public function edit($id)
	{
        $customer = Customer::find($id);

		return view('admin.customers.edit', ['title' => 'Editar Cliente', 'customer' => $customer]);
	}

	public function update(Request $request, $id)
	{	//dd($request->all());
		$request->merge([
			'cpf' => str_replace(['.', '-', '/'], '', $request->get('cpf')),
			'cnpj' => str_replace(['.', '-', '/'], '', $request->get('cnpj')),
		]);

		if($request->get('type') === '1') {
			$request->validate([
				'fantasy_name' => 'required|unique:customers,fantasy_name,' . $id,
				'cnpj' => 'nullable|unique:customers,cnpj,' . $id,
				'email' => 'nullable|unique:customers,email,' . $id,
			]);

			$customer = Customer::find($id);

			$customer->name = null;
			$customer->fantasy_name = $request->get('fantasy_name');
			$customer->email = $request->get('email');
			$customer->cpf = null;
			$customer->cnpj = only_numbers($request->get('cnpj'));
			$customer->phone = only_numbers($request->get('phone'));
			$customer->type = $request->get('type');
			$customer->slug = Str::slug($request->get('fantasy_name'), '-');
			$customer->user_id = auth()->user()->id;

			$customer->save();
		} else{
			$request->validate([
				'name' => 'required|unique:customers,name,' . $id,
				'cpf' => 'nullable|unique:customers,cpf,' . $id,
				'email' => 'nullable|unique:customers,email,' . $id,
			]);

			$customer = Customer::find($id);
			
			$customer->name = $request->get('name');
			$customer->fantasy_name = null;
			$customer->email = $request->get('email');
			$customer->cpf = only_numbers($request->get('cpf'));
			$customer->cnpj = null;
			$customer->phone = only_numbers($request->get('phone'));
			$customer->type = $request->get('type');
			$customer->slug = Str::slug($request->get('name'), '-');
			$customer->user_id = auth()->user()->id;
	
			$customer->save();
		}

		return redirect()->route('admin.customers.index')->with('success', 'Cliente salvo com sucesso');
	}

	public function destroy($id)
	{
		$customer = Customer::find($id);
		$customer->delete();
		try {
			$customer->delete();
			return redirect()->route('admin.customers.index')->with('success', 'Cliente apagado com sucesso.');
		} catch (\Illuminate\Database\QueryException $e) {
			$errorCode = $e->errorInfo[0];

			if ($errorCode == '23000') {
				return redirect()->route('admin.customers.index')->with('warning', 'O Cliente não pode ser apagado no momento.');
			} else {
				return redirect()->route('admin.customers.index')->with('danger', 'Não foi possível apagar o Cliente.');
			}
		}
	}

	public function show($id)
	{
		$customer = Customer::find($id);
		return view('admin.customers.show', ['customer' => $customer]);
	}
}
