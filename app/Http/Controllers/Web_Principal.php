<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Web_Principal extends Controller
{
    public function index()
    {
        return view('web_principal');
    }
}
