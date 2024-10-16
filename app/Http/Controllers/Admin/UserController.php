<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

use App\Models\User;

class UserController extends Controller
{
	public function index(Request $request)
	{
		if (!$request->get('keyword')) {
			$users = User::where('email', '!=', 'admin@admin.com')->orderBy('users.created_at', 'desc')->paginate(10);
		} else {
			$users = User::where('email', '!=', 'admin@admin.com')
									->Where('name', 'LIKE', '%'.$request->get('keyword').'%')
									->orWhere('email', 'LIKE', '%'.$request->get('keyword').'%')
									->orWhere('cellphone', 'LIKE', '%'.$request->get('keyword').'%')
									->orderBy('users.created_at', 'desc')
									->get();
		}

		return view('admin.users.index', ['title' => Str::plural(trans('models.user')), 'users' => $users]);
	}

	public function create()
	{
		$roles = Role::get();
		return view('admin.users.create', ['title' => 'Novo Usuário', 'roles' => $roles]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required|unique:users,email',
			'cellphone' => 'required|unique:users,cellphone',
			'password' => 'required|min:8|confirmed',
			'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);

		$user = new User([
			'name' => $request->get('name'),
			'email' => $request->get('email'),
			'password' => bcrypt($request->get('password')),
			'cellphone' => only_numbers($request->get('cellphone')),
			'avatar' => !$request->hasFile('avatar') ? NULL : $request->avatar->store('uploads/users/' . Str::slug($request->get('name'), '-')),
			'slug' => Str::slug($request->get('name'), '-')
		]);

		$user->save();
		$user->assignRole($request->input('role'));

		return redirect()->route('admin.users.index')->with('success', 'Usuário salvo com sucesso');
	}

	public function edit($id)
	{
		$user = User::find($id);
		$roles = Role::get();
		return view('admin.users.edit', ['title' => 'Editar Usuário', 'user' => $user, 'roles' => $roles]);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required|unique:users,email,' . $id,
			'cellphone' => 'required|unique:users,cellphone' . $id,
			'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);

		$user = User::find($id);

		$user->name = $request->get('name');
		$user->email = $request->get('email');
		if ($request->get('password')) {
			$user->password = bcrypt($request->get('password'));
		}
		$user->cellphone = only_numbers($request->get('cellphone'));

		if ($request->hasFile('avatar')) {
			if(!empty($user->avatar)){
				Storage::delete($request->get('current_file'));
				$user->avatar = $request->avatar->store('uploads/users/' . $user->slug);
			}
			else{
				$user->avatar = $request->avatar->store('uploads/users/' . $user->slug);
			}
		}

		$user->slug = Str::slug($request->get('name'), '-');
		$user->save();

		foreach ($user->roles as $key => $user_role) {
			$user->removeRole($user_role);
		}
		$user->assignRole($request->input('role'));

		if(!auth()->user()->hasRole('super-admin')) {
			return redirect()->route('admin.users.edit', $id)->with('success', 'Usuário salvo com sucesso');
		}

		return redirect()->route('admin.users.index')->with('success', 'Usuário salvo com sucesso');
	}

	public function destroy($id)
	{
		$user = User::find($id);

		try {
			$user->delete();
			return redirect()->route('admin.users.index')->with('success', 'Usuário apagado com sucesso.');
		} catch (\Illuminate\Database\QueryException $e) {
			$errorCode = $e->errorInfo[0];

			if ($errorCode == '23000') {
				return redirect()->route('admin.users.index')->with('warning', 'O Usuário não pode ser apagado no momento.');
			} else {
				return redirect()->route('admin.users.index')->with('danger', 'Não foi possível apagar o Usuário.');
			}
		}
	}

	public function show($slug)
	{
		$user = User::where('slug', $slug)->first();
		abort_unless($user, 404);
		return view('admin.users.show', ['user' => $user]);
	}

}
