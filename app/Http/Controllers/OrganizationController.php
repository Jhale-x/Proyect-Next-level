<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizaciones = Organization::all();

        if (Auth::guard('alumno')->check()) {
            return view('Alumno.organizations', compact('organizaciones'));
        }

        $user = Auth::user();
        if ($user && $user->rol === 'administrador') {
            return view('Admin.organizations', compact('organizaciones'));
        }

        return view('Docentes.organizations', compact('organizaciones'));
    }
}
