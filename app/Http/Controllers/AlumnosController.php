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
    public function index()
    {
        $alumnos = Alumno::all();
        return view('Admin.users', compact('alumnos')); 
    }

    // Este es el método que llama el UsersController
    public function datosFormulario()
    {
        return [
            'niveles'    => Nivel::all(),
            'grados'     => Grado::all(),
            'secciones'  => Seccion::all(),
            'facultades' => Facultad::all(),
        ];
    }

    // Si necesitas entrar a una vista propia de registro de alumnos
    public function create()
    {
        $datos = $this->datosFormulario();
        return view('Admin.users', $datos); // O la vista que uses para alumnos
    }

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

        // 2. BUSCAR EL SALÓN
        $salon = Salon::where('id_nivel', $request->id_nivel)
            ->when($request->id_grado, fn($q) => $q->where('id_grado', $request->id_grado))
            ->when($request->id_seccion, fn($q) => $q->where('id_seccion', $request->id_seccion))
            ->when($request->id_facultad, fn($q) => $q->where('id_facultad', $request->id_facultad))
            ->first();

        if (!$salon) {
            return back()->withInput()->with('error', 'No existe un salón con esos datos');
        }

        // 3. PROCESAR APODERADO
        $idApoderado = null;
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

        // 4. CREAR ALUMNO
        // Usamos 'contrasena' (sin ñ) que es el nombre real de tu columna en la DB.
        // Obtenemos el valor de $request->input('contraseña') (con ñ) que viene del formulario.
        Alumno::create([
            'id_salon'         => $salon->id_salon,
            'id_apoderado'     => $idApoderado,
            'nombre'           => $request->nombre,
            'apellido'         => $request->apellido,
            'dni'              => $request->dni,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'usuario'          => $request->usuario,
            'contrasena'       => Hash::make($request->input('contraseña')), 
            'tipo'             => $request->tipo ?? 'colegio',
        ]);

        return redirect()->route('listado')->with('success', 'Alumno registrado correctamente');
    }
}
