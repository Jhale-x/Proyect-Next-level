<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EtisController extends Controller
{
    public function index()
    {
        if (Auth::guard('alumno')->check()) {
            return view('Alumno.eti');
        }

        $user = Auth::user();
        if ($user && $user->rol === 'administrador') {
            return view('Admin.eti');
        }
        
        return redirect('/auth/intranet');
    }
}