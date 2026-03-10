<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Apoderado;
use App\Models\Nivel;
use App\Models\Grado;
use App\Models\Seccion;
use App\Models\Facultad;
use App\Models\Salon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AlumnosController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre'           => 'required|string|max:100',
            'apellido'         => 'required|string|max:100',
            'dni'              => 'required|unique:alumnos,dni',
            'fecha_nacimiento' => 'required|date',
            'usuario'          => 'required|unique:alumnos,usuario',
            'contraseña'       => 'required|min:6',
            'id_nivel'         => 'required',
        ]);

        $salon = Salon::where('id_nivel', $request->id_nivel)
            ->when($request->id_grado, fn($q) => $q->where('id_grado', $request->id_grado))
            ->when($request->id_seccion, fn($q) => $q->where('id_seccion', $request->id_seccion))
            ->when($request->id_facultad, fn($q) => $q->where('id_facultad', $request->id_facultad))
            ->first();
        $idApoderado = null;

        // Si se llenaron datos del apoderado
        if (!empty($request->apoderado_dni)) {
            $apoderado = Apoderado::firstOrCreate(
                ['dni' => $request->apoderado_dni],
                [
                    'nombre' => $request->apoderado_nombre,
                    'apellido' => $request->apoderado_apellido
                ]
            );

            $idApoderado = $apoderado->id_apoderado;
        }


        if (!$salon) {
            return back()->withInput()
                ->with('error', 'No existe un salón con esos datos');
        }

        Alumno::create([
            'id_salon'         => $salon->id_salon,
            'id_apoderado'     => $idApoderado,
            'nombre'           => $request->nombre,
            'apellido'         => $request->apellido,
            'dni'              => $request->dni,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'usuario'          => $request->usuario,
            'contraseña'       => Hash::make($request->contrasena),
        ]);

        return redirect()->route('admin.users')
            ->with('success', 'Alumno registrado correctamente');
    }

    public function datosFormulario()
    {
        return [
            'niveles'    => Nivel::all(),
            'grados'     => Grado::all(),
            'secciones'  => Seccion::all(),
            'facultades' => Facultad::all(),
        ];
    }
}
