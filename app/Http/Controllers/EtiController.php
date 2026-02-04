<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EtiController extends Controller
{
    public function index()
    {
        return view('eti'); // Asegúrate de que el nombre coincida con el archivo .blade.php
    }
}