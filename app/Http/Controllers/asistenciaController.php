<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class asistenciaController extends Controller
{
    public function index()
    {
        return view('asistencia');
    }
}