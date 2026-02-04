<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class asispController extends Controller
{
    public function index()
    {
        return view('asistenciaP');
    }
}