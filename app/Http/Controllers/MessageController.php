<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        if (Auth::guard('alumno')->check()) {
            return view('Alumno.messages');
        }

        $user = Auth::user();
        if ($user && $user->rol === 'administrador') {
            return view('Admin.messages');
        }

        return view('Docentes.messages');
    }
}
