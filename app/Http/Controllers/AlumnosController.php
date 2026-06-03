<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Nivel;
use App\Models\Grado;
use App\Models\Seccion;
use App\Models\Facultad;
use App\Models\Salon;
use App\Models\Course;
use App\Models\Apoderado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

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

    public function show(int $id_alumno)
    {
        $alumno = Alumno::with(['salon.nivel', 'salon.grado', 'salon.seccion'])
            ->findOrFail($id_alumno);

        return view('Admin.AlumnoDetalle', compact('alumno'));
    }

    public function edit(int $id_alumno)
    {
        $alumno = Alumno::with(['salon'])->findOrFail($id_alumno);
        $datos = $this->datosFormulario();

        return view('Admin.AlumnoEditar', array_merge($datos, compact('alumno')));
    }

    public function update(Request $request, int $id_alumno)
    {
        $alumno = Alumno::findOrFail($id_alumno);

        $request->validate([
            'nombre'           => 'required|string|max:100',
            'apellido'         => 'required|string|max:100',
            'dni'              => 'required|unique:alumnos,dni,' . $alumno->id_alumno . ',id_alumno',
            'fecha_nacimiento' => 'required|date',
            'usuario'          => 'required|unique:alumnos,usuario,' . $alumno->id_alumno . ',id_alumno',
            'contrasena'       => 'nullable|min:6',
            'id_nivel'         => 'required',
        ]);

        $salon = Salon::where('id_nivel', $request->id_nivel)
            ->when($request->id_grado, fn($q) => $q->where('id_grado', $request->id_grado))
            ->when($request->id_seccion, fn($q) => $q->where('id_seccion', $request->id_seccion))
            ->first();

        if (!$salon) {
            return back()->withInput()->with('error', 'No existe un salón con esos datos');
        }

        $alumno->update([
            'id_salon'         => $salon->id_salon,
            'nombre'           => $request->nombre,
            'apellido'         => $request->apellido,
            'dni'              => $request->dni,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'usuario'          => $request->usuario,
            'contrasena'       => $request->filled('contrasena') ? Hash::make($request->input('contrasena')) : $alumno->contrasena,
        ]);

        return redirect()->route('admin.alumnos.show', $alumno->id_alumno)
            ->with('success', 'Alumno actualizado correctamente');
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

    public function gradosPorNivel(int $id_nivel)
    {
        $grados = Grado::where('id_nivel', $id_nivel)->get();
        return response()->json($grados);
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
            'contrasena'       => 'required|min:6',
            'id_nivel'         => 'required',
        ]);

        // =========================
        // BUSCAR SALÓN
        // =========================
        $salonQuery = Salon::where('id_nivel', $request->id_nivel);

        if (!empty($request->id_facultad)) {
            $salonQuery->where('id_facultad', $request->id_facultad);
        }

        if (!empty($request->id_grado) && !empty($request->id_seccion)) {
            $salonQuery->where('id_grado', $request->id_grado)
                ->where('id_seccion', $request->id_seccion);
        }

        $salon = $salonQuery->first();

        if (!$salon) {
            return back()
                ->withInput()
                ->with('error', 'No existe un salón con esos datos');
        }

        // =========================
        // CREAR APODERADO (SI EXISTE)
        // =========================

        $idApoderado = null;

        if (
            $request->filled('apoderado_nombre') &&
            $request->filled('apoderado_apellido') &&
            $request->filled('apoderado_dni')
        ) {
            $apoderado = Apoderado::create([
                'nombre'   => $request->apoderado_nombre,
                'apellido' => $request->apoderado_apellido,
                'dni'      => $request->apoderado_dni,
            ]);

            $idApoderado = $apoderado->id_apoderado;
        }

        // =========================
        // CREAR ALUMNO
        // =========================
        $alumno = Alumno::create([
            'id_salon'         => $salon->id_salon,
            'id_apoderado'     => $idApoderado, // 🔥 AQUÍ SE GUARDA

            'nombre'           => $request->nombre,
            'apellido'         => $request->apellido,
            'dni'              => $request->dni,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'usuario'          => $request->usuario,
            'contrasena'       => Hash::make($request->contrasena),
        ]);

        // =========================
        // QR
        // =========================
        $codigoQR = 'ALU-' . $alumno->id_alumno;

        $qr = QrCode::size(300)
            ->errorCorrection('H')
            ->generate($codigoQR);

        $fileName = 'qr/alumnos/' . $codigoQR . '.svg';

        Storage::disk('public')->put($fileName, $qr);

        $alumno->qr = $fileName;
        $alumno->save();

        return redirect()
            ->route('admin.alumnos.index')
            ->with('success', 'Alumno registrado con apoderado y QR');
    }
}
