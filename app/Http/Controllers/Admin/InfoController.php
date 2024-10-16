<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Info;

class InfoController extends Controller
{
	public function __construct()
  {
		$this->middleware(['can:editar informacoes basicas'], ['only' => ['edit', 'update']]);
  }

	public function edit($id)
	{
		$info = Info::find($id);
		return view('admin.info.edit', ['title' => 'Informações Gerais', 'info' => $info]);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'email1' => 'required|email'
		]);

		$info = Info::find($id);

		$info->twitter = $request->get('twitter');
		$info->facebook = $request->get('facebook');
		$info->instagram = $request->get('instagram');
		$info->youtube = $request->get('youtube');
		$info->whatsapp = only_numbers($request->get('whatsapp'));
		$info->linkedin = $request->get('linkedin');
		$info->email1 = $request->get('email1');
		$info->email2 = $request->get('email2');
		$info->user_id = auth()->user()->id;
		$info->save();

		return redirect()->route('admin.info.edit', $id)->with('success', 'Informações Gerais salvas com sucesso');
	}
}
