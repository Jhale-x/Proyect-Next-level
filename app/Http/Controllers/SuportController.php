<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suport;

class SuportController extends Controller
{
    public function index()
    {
        return view('auxiliar.soporte');
    }
}
