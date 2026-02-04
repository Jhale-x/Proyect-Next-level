<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class herramientasController extends Controller
{
    public function index()
    {
        return view('herramientas');
    }
}