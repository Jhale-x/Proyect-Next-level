<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Nivel;
use App\Models\Grado;
use App\Models\Seccion;
use App\Models\Facultad;
use App\Models\Salon;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AlumnosController extends Controller
{
    public function index(Request $request)
    {
        // 1. Iniciamos consulta con relaciones para evitar error de "propiedad en null"
        $query = Alumno::with(['salon.nivel', 'salon.grado', 'salon.seccion']);

        // 2. Filtro de búsqueda (Nombre, Apellido o DNI)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'LIKE', "%$search%")
                    ->orWhere('apellido', 'LIKE', "%$search%")
                    ->orWhere('dni', 'LIKE', "%$search%");
            });
        }

        // 3. Filtros por Nivel y Grado (vía tabla Salones)
        if ($request->filled('nivel')) {
            $query->whereHas('salon', function ($q) use ($request) {
                $q->where('id_nivel', $request->nivel);
            });
        }

        if ($request->filled('grado')) {
            $query->whereHas('salon', function ($q) use ($request) {
                $q->where('id_grado', $request->grado);
            });
        }

        $alumnos = $query->get();
        $niveles = Nivel::all();
        $grados = Grado::all();

        return view('Admin.ListadoAlumno', compact('alumnos', 'niveles', 'grados'));
    }

    public function datosFormulario()
    {
        return [
            'niveles'    => Nivel::all(),
            'grados'     => Grado::all(),
            'secciones'  => Seccion::all(),
            'facultades' => Facultad::all(),
            'cursos'     => Course::all(),
        ];
    }

    public function create()
    {
        $datos = $this->datosFormulario();
        return view('Admin.users', $datos);
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

        $salon = Salon::where('id_nivel', $request->id_nivel)
            ->when($request->id_grado, fn($q) => $q->where('id_grado', $request->id_grado))
            ->when($request->id_seccion, fn($q) => $q->where('id_seccion', $request->id_seccion))
            ->first();

        if (!$salon) {
            return back()->withInput()->with('error', 'No existe un salón con esos datos');
        }

        Alumno::create([
            'id_salon'         => $salon->id_salon,
            'nombre'           => $request->nombre,
            'apellido'         => $request->apellido,
            'dni'              => $request->dni,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'usuario'          => $request->usuario,
            'contrasena'       => Hash::make($request->input('contraseña')),
            'tipo'             => $request->tipo ?? 'colegio',
        ]);

        return redirect()->route('admin.alumnos.index')->with('success', 'Alumno registrado');
    }
}
