<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MensajessController extends Controller
{
    public function create($curso)
    {
        return view('mensajess', compact('curso'));
    }
}
