<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
	public function __construct()
  {
		$this->middleware(['role:super-admin']);
  }
	
	public function index(Request $request)
	{
		if (!$request->get('keyword')) {
			$roles = Role::orderBy('created_at', 'desc')->paginate(10);
		} else {
			$roles = Role::where('name', 'LIKE', '%'.$request->get('keyword').'%')->orderBy('created_at', 'desc')->get();
		}

		return view('admin.roles.index', ['title' => 'Perfis de Acesso', 'roles' => $roles]);
	}

	public function create()
	{
		$permissions = Permission::get();
		return view('admin.roles.create', ['title' => 'Novo Perfil de Acesso', 'permissions' => $permissions, 'role_permissions' => []]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|unique:roles,name',
			'permissions' => 'required'
		]);

		$role = Role::create(['name' => $request->get('name')]);
		$role->syncPermissions($request->get('permissions'));

		return redirect()->route('admin.roles.index')->with('success', 'Perfil de acesso salvo com sucesso');
	}

	public function edit($id)
  {
		$role = Role::find($id);
		$permissions = Permission::get();
		$role_permissions = Role::findByName($role->name)->permissions->pluck('id');

		return view('admin.roles.edit', ['title' => 'Editar Perfil de Acesso', 'role' => $role, 'permissions' => $permissions, 'role_permissions' => $role_permissions->toArray()]);
  }

  public function update(Request $request, $id)
  {
  	$request->validate([
			'name' => 'required|unique:roles,name,' . Role::find($id)->id
		]);

		$role = Role::find($id);
		$role->name = $request->input('name');
		$role->save();

		$role->syncPermissions($request->input('permissions'));

		return redirect()->route('admin.roles.index')->with('success', 'Perfil de acesso salvo com sucesso');
  }

  public function destroy($id)
  {
  	$role = Role::find($id);
		$role->delete();

  	return redirect()->route('admin.roles.index')->with('success', 'Perfil de acesso apagado com sucesso');
  }
}
