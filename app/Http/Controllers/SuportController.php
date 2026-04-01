<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suport;
use Illuminate\Support\Facades\Auth;

class SuportController extends Controller
{
    public function index()
    {
        if (Auth::guard('alumno')->check()) {
            return view('Alumno.suport');
        }

        $user = Auth::user();

        if ($user && $user->rol === 'administrador') {
            return view('Admin.suport');
        }

        if ($user && $user->rol === 'docente') {
            return view('Docentes.suport');
        }

        if ($user && $user->rol === 'auxiliar') {
            return view('auxiliar.soporte');
        }

        return view('soporte');
    }
}
