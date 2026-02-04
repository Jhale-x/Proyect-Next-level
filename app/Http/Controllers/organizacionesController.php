<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class organizacionesController extends Controller
{
    public function index()
    {
        return view('organizaciones');
    }
}