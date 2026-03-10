<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        if (Auth::guard('alumno')->check()) {
            return view('Alumno.calendar');
        }

        $user = Auth::user();
        if ($user && $user->rol === 'administrador') {
            return view('Admin.calendar');
        }

        return view('Docentes.calendar');
    }
}
