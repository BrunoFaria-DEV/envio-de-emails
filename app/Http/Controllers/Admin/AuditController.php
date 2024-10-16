<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class AuditController extends Controller
{
	public function __construct()
  {
  	$this->middleware(['role:super-admin'], ['except' => ['edit', 'update']]);
  }
  
	public function index(Request $request)
	{
		$audits = Audit::orderBy('created_at', 'desc')->paginate(10);
		return view('admin.audits.index', ['title' => __('models.audit'), 'audits' => $audits]);
	}

	public function show($id)
	{
		return view('admin.audits.show', ['audit' => Audit::find($id)]);
	}
}