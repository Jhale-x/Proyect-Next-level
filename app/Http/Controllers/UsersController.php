<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        // 1. Iniciamos consulta con la relación del curso
        $query = User::with('cursoRelacion'); 

        // 2. Filtro por búsqueda (Nombre, Apellido o DNI)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'LIKE', "%$search%")
                  ->orWhere('apellido', 'LIKE', "%$search%")
                  ->orWhere('dni', 'LIKE', "%$search%");
            });
        }

        // 3. Filtro por Rol (Cargo)
        if ($request->filled('rol')) {
            $query->where('rol', $request->rol);
        }

        $personales = $query->get();

        // 4. Datos para el modal de registro
        $cursos = Course::all();
        $niveles = DB::table('niveles')->get();
        $grados = DB::table('grados')->get();
        $secciones = DB::table('secciones')->get();
        $facultades = DB::table('facultades')->get();

        return view('Admin.ListadoPersonal', compact('personales', 'cursos', 'niveles', 'grados', 'secciones', 'facultades'));
    }

    // ========== REGISTRO DE PERSONAL ==========
    public function store(Request $request)
    {
        $request->validate([
            'nombre'     => 'required|string|max:100',
            'apellido'   => 'required|string|max:100',
            'dni'        => 'required|unique:users,dni',
            'usuario'    => 'required|unique:users,usuario',
            'contrasena' => 'required|min:6',
            'rol'        => 'required|in:administrador,docente,auxiliar'
        ]);

        User::create([
            'id_curso'         => $request->id_curso,
            'nombre'           => $request->nombre,
            'apellido'         => $request->apellido,
            'dni'              => $request->dni,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'usuario'          => $request->usuario,
            'contrasena'       => Hash::make($request->contrasena),
            'rol'              => $request->rol,
        ]);

        return redirect()->route('admin.listado.personal')->with('success', 'Personal creado correctamente');
    }

    // ========== REGISTRO DE ALUMNOS ==========
    public function storeAlumno(Request $request)
    {
        // Validar datos del alumno
        $request->validate([
            'nombre'           => 'required|string|max:100',
            'apellido'         => 'required|string|max:100',
            'dni'              => 'required|unique:alumnos,dni',
            'fecha_nacimiento' => 'required|date',
            'usuario'          => 'required|unique:alumnos,usuario',
            'contrasena'       => 'required|min:6',
        ]);

        // Insertar alumno en la tabla alumnos
        DB::table('alumnos')->insert([
            'nombre'           => $request->nombre,
            'apellido'         => $request->apellido,
            'dni'              => $request->dni,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'usuario'          => $request->usuario,
            'contrasena'       => Hash::make($request->contrasena),
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);

        return redirect()->route('admin.listado.alumnos')->with('success', 'Alumno registrado correctamente');
    }

    // Listado de personal (alias)
    public function listado()
    {
        return $this->index(new Request());
    }
}