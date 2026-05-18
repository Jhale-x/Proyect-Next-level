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
    // PANEL PRINCIPAL (GESTIÓN)
    public function index()
    {
        $cursos = Course::all();
        $niveles = Nivel::all();
        $grados = Grado::all();
        $secciones = Seccion::all();
        $facultades = Facultad::all();
        $personales = User::all();

        return view('Admin.users', compact(
            'cursos',
            'niveles',
            'grados',
            'secciones',
            'facultades',
            'personales'
        ));
    }

    // LISTADO (CON FILTROS)
    public function listado(Request $request)
    {
        $query = User::with('cursoRelacion');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'LIKE', "%$search%")
                    ->orWhere('apellido', 'LIKE', "%$search%")
                    ->orWhere('dni', 'LIKE', "%$search%");
            });
        }

        if ($request->filled('rol')) {
            $query->where('rol', $request->rol);
        }

        $users = $query->get();

        return view('Admin.ListadoPersonal', compact('users'));
    }

    // DETALLE
    public function show(int $id_usuario)
    {
        $user = User::with('cursoRelacion')->findOrFail($id_usuario);

        return view('Admin.PersonalDetalle', compact('user'));
    }

    // EDITAR
    public function edit(int $id_usuario)
    {
        $user = User::findOrFail($id_usuario);
        $cursos = Course::all();

        return view('Admin.PersonalEditar', compact('user', 'cursos'));
    }

    // ACTUALIZAR
    public function update(Request $request, int $id_usuario)
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

        $data = [
            'id_curso'         => $request->rol === 'docente' ? $request->id_curso : null,
            'nombre'           => $request->nombre,
            'apellido'         => $request->apellido,
            'dni'              => $request->dni,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'usuario'          => $request->usuario,
            'rol'              => $request->rol,
        ];

        if ($request->filled('contrasena')) {
            $data['contrasena'] = Hash::make($request->contrasena);
        }

        $user->update($data);

        return redirect()->route('admin.users.show', $user->id_usuario)
            ->with('success', 'Personal actualizado correctamente');
    }

    // GUARDAR
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

        $user = User::create([
            'id_curso'         => $request->rol === 'docente' ? $request->id_curso : null,
            'nombre'           => $request->nombre,
            'apellido'         => $request->apellido,
            'dni'              => $request->dni,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'usuario'          => $request->usuario,
            'contrasena'       => Hash::make($request->contrasena),
            'rol'              => $request->rol,
        ]);

        return redirect()->route('admin.users.show', $user->id_usuario)
            ->with('success', 'Personal creado correctamente');
    }
}
