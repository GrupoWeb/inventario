<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class inventario extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.home');
    }

    public function showProduct(){
        return view('product.index');
    }

    public function showActive(){
        return view('active.index');
    }
}
