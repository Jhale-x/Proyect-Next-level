<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Nivel;
use App\Models\Seccion;
use App\Models\Facultad;
use App\Models\Course; // Asegúrate de que el modelo se llame así
use App\Models\User;

class EtisController extends Controller
{
    public function index()
    {
        // 1. Verificación de sesión
        if (Auth::guard('alumno')->check()) {
            return view('Alumno.eti');
        }

        $user = Auth::user();
        if ($user && $user->rol === 'administrador') {
            // 2. Carga de datos para los formularios en Admin.users
            $niveles = Nivel::all();
            $secciones = Seccion::all();
            $facultades = Facultad::all();
            $cursos = Course::all(); // Esto evita el error de la variable $cursos
            $personales = User::all(); // Para el listado de personal

            return view('Admin.users', compact('niveles', 'secciones', 'facultades', 'cursos', 'personales'));
        }
        
        return redirect('/auth/intranet');
    }
    public function viewEti()
    {
        return view('Admin.eti');
    }
}