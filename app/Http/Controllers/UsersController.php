<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    public function index()
    {
        $users = User::with('salones')->get();
        $cursos = Course::all();

        $alumnosController = new AlumnosController();
        $datosAlumno = $alumnosController->datosFormulario();

        return view('Admin.users', array_merge(
            compact('users', 'cursos'),
            $datosAlumno
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
            'rol'               => 'required',
            'id_curso'          => 'required_if:rol,docente|nullable|exists:cursos,id_curso'
        ]);

        User::create([
            'id_curso'   => $request->id_curso,
            'nombre'     => $request->nombre,
            'apellido'   => $request->apellido,
            'dni'        => $request->dni,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'usuario'    => $request->usuario,
            'contrasena' => Hash::make($request->contrasena),
            'rol'        => $request->rol,
        ]);

        return redirect()->route('admin.users')->with('success', 'Personal creado correctamente');
    }
}
