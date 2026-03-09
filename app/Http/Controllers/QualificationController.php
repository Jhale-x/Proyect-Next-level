<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QualificationController extends Controller
{
    public function index()
    {
        if (Auth::guard('alumno')->check()) {
            return view('Alumno.qualifications');
        }

        $user = Auth::user();
        if ($user && $user->rol === 'administrador') {
            return view('Admin.qualifications');
        }

        return view('Docentes.qualifications');
    }
}
