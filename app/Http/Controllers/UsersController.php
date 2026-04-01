<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Nivel;
use App\Models\Grado;
use App\Models\Seccion;
use App\Models\Facultad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::with('salones')->get();
        $cursos = Course::all();

        $totalUsuarios = User::count();
        $admins = User::where('rol', 'administrador')->count();
        $docentes = User::where('rol', 'docente')->count();
        $auxiliares = User::where('rol', 'auxiliar')->count();

        $usuariosRecientes = User::latest()->take(5)->get();

        $niveles = Nivel::all();
        $grados = Grado::all();
        $secciones = Seccion::all();
        $facultades = Facultad::all();

        return view('Admin.users', compact(
            'users',
            'cursos',
            'totalUsuarios',
            'admins',
            'docentes',
            'auxiliares',
            'usuariosRecientes',
            'niveles',
            'grados',
            'secciones',
            'facultades'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'            => 'required|string|max:100',
            'apellido'          => 'required|string|max:100',
            'dni'               => 'required|unique:users,dni',
            'fecha_nacimiento'  => 'required|date',
            'usuario'           => 'required|unique:users,usuario',
            'contrasena'        => 'required|min:6',
            'rol'               => 'required|in:administrador,docente,auxiliar',
            'id_curso'          => 'nullable|exists:cursos,id_curso|required_if:rol,docente'
        ]);

        $idCurso = $request->rol === 'docente' ? $request->id_curso : null;

        User::create([
            'id_curso'         => $idCurso,
            'nombre'           => $request->nombre,
            'apellido'         => $request->apellido,
            'dni'              => $request->dni,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'usuario'          => $request->usuario,
            // Guardamos con Hash para mantener la seguridad que pediste
            'contrasena'       => Hash::make($request->contrasena),
            'rol'              => $request->rol,
        ]);

        return redirect()->route('admin.users')->with('success', 'Personal creado correctamente');
    }
}
