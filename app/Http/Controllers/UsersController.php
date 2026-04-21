<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Nivel;
use App\Models\Grado;
use App\Models\Seccion;
use App\Models\Facultad;
use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    // 🟦 DASHBOARD + REGISTRO
    public function dashboard()
    {
        $totalUsuarios = User::count();
        $admins = User::where('rol', 'administrador')->count();
        $docentes = User::where('rol', 'docente')->count();
        $auxiliares = User::where('rol', 'auxiliar')->count();

        $alumnos = Alumno::count();

        $academia = Alumno::whereHas('salon.nivel', function ($q) {
            $q->where('nivel', 'like', '%academia%');
        })->count();

        $colegio = Alumno::whereHas('salon.nivel', function ($q) {
            $q->whereIn('nivel', ['Inicial', 'Primaria', 'Secundaria']);
        })->count();

        $usuariosRecientes = User::latest()->take(5)->get();

        $cursos = Course::all();
        $niveles = Nivel::all();
        $grados = Grado::all();
        $secciones = Seccion::all();
        $facultades = Facultad::all();

        return view('Admin.users', compact(
            'cursos',
            'totalUsuarios',
            'admins',
            'docentes',
            'auxiliares',
            'usuariosRecientes',
            'niveles',
            'grados',
            'secciones',
            'facultades',
            'alumnos',
            'academia',
            'colegio'
        ));
    }

    // 🟨 LISTADO CON FILTROS
    public function index(Request $request)
    {
        $query = User::with('cursoRelacion');

        // 🔍 búsqueda
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'LIKE', "%$search%")
                    ->orWhere('apellido', 'LIKE', "%$search%")
                    ->orWhere('dni', 'LIKE', "%$search%");
            });
        }

        // 🎭 rol
        if ($request->filled('rol')) {
            $query->where('rol', $request->rol);
        }

        $users = $query->get();

        return view('Admin.ListadoPersonal', compact('users'));
    }

    public function show($id_usuario)
    {
        $user = User::with('cursoRelacion')->findOrFail($id_usuario);

        return view('Admin.PersonalDetalle', compact('user'));
    }

    public function edit($id_usuario)
    {
        $user = User::findOrFail($id_usuario);
        $cursos = Course::all();

        return view('Admin.PersonalEditar', compact('user', 'cursos'));
    }

    public function update(Request $request, $id_usuario)
    {
        $user = User::findOrFail($id_usuario);

        $request->validate([
            'nombre'            => 'required|string|max:100',
            'apellido'          => 'required|string|max:100',
            'dni'               => 'required|unique:users,dni,' . $user->id_usuario . ',id_usuario',
            'fecha_nacimiento'  => 'required|date',
            'usuario'           => 'required|unique:users,usuario,' . $user->id_usuario . ',id_usuario',
            'contrasena'        => 'nullable|min:6',
            'rol'               => 'required|in:administrador,docente,auxiliar',
            'id_curso'          => 'nullable|exists:cursos,id_curso|required_if:rol,docente'
        ]);

        $user->id_curso = $request->rol === 'docente' ? $request->id_curso : null;
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->dni = $request->dni;
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->usuario = $request->usuario;
        $user->rol = $request->rol;

        if ($request->filled('contrasena')) {
            $user->contrasena = Hash::make($request->contrasena);
        }

        $user->save();

        return redirect()->route('admin.users.show', $user->id_usuario)
            ->with('success', 'Personal actualizado correctamente');
    }

    // 🟩 GUARDAR
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
            'contrasena'       => Hash::make($request->contrasena),
            'rol'              => $request->rol,
        ]);

        return redirect()->route('admin.users.dashboard')
            ->with('success', 'Personal creado correctamente');
    }
}
