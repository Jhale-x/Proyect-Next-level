<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        // 1. Iniciamos consulta con la relación del curso (asegúrate que esté en el modelo User)
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

        // 4. Datos para el modal de registro (Niveles, Grados, etc.)
        // Usamos Course::all() para evitar el error anterior de "Curso not found"
        $alumnosCtrl = new AlumnosController();
        $datosExtra = $alumnosCtrl->datosFormulario();

        return view('Admin.ListadoPersonal', array_merge(
            compact('personales'),
            $datosExtra
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'     => 'required|string|max:100',
            'apellido'   => 'required|string|max:100',
            'dni'        => 'required|unique:users,dni',
            'usuario'    => 'required|unique:users,usuario',
            'contrasena' => 'required|min:6',
            'rol'        => 'required'
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

        return redirect()->route('admin.users.index')->with('success', 'Personal creado correctamente');
    }
}