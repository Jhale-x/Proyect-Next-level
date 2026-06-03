<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToolController extends Controller
{
    public function index()
    {
        if (Auth::guard('apoderado')->check()) {
            return view('Apoderado.tools');
        }

        if (Auth::guard('alumno')->check()) {
            return view('Alumno.tools');
        }
        
        $user = Auth::user();
        if ($user && $user->rol === 'administrador') {
            return view('Admin.tools');
        }

        if ($user && $user->rol === 'docente') {
            return view('Docentes.tools');
        }

        return view('Auxiliar.tools');
    }
}
