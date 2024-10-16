<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        if (auth()->check()) {
        return redirect()->route('admin.home');
        }
        else {
            return view('home');
        }
    }

    public function admin()
    {
        if (!auth()->check()) {
            return view('admin', ['title' => 'Painel Administrador']);
        } else {
            return redirect()->route('admin.home');
        }
    }
}
