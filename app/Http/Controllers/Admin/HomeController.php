<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware(['role:super-admin|admin']);
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    return view('admin/home', ['title' => 'Dashboard']);
  }

  public function summernote_upload(Request $request)
  {
    $path = $request->file->store('uploads/sumernote/');
    echo Storage::url($path);
  }

  public function get_company_info(Request $request)
  {
    $cnpj = $request->get('cnpj');

    $response = Http::withToken(env('RECEITA_WS_KEY'))->get('https://receitaws.com.br/v1/cnpj/' . $cnpj);

    return $response;
  }

  public function login()
  {
      if (!auth()->check()) {
          return view('admin.login', ['title' => 'Painel Administrador']);
      } else {
          return redirect()->route('admin.home');
      }
  }
}
