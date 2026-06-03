<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\CursoActividad;
use App\Models\Nota;
use App\Models\Alumno;
use App\Models\Course;
use App\Models\Salon;
use App\Models\User;
use App\Models\Nivel;
use App\Models\CursoSalon;
use App\Models\Apoderado;
use App\Models\Facultad;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // =====================
    // 👨‍💼 ADMIN
    // =====================
    public function index()
    {
        $cursos = Course::all();
        $salones = Salon::all();
        $users = User::all();
        $niveles = Nivel::all();
        $actividades = Activity::all();

        $salonesPrimaria = Salon::with(['grado', 'seccion', 'nivel'])
            ->whereHas('nivel', function ($q) {
                $q->where('nivel', 'Primaria');
            })
            ->get();

        $salonesSecundaria = Salon::with(['grado', 'seccion', 'nivel'])
            ->whereHas('nivel', function ($q) {
                $q->where('nivel', 'Secundaria');
            })
            ->get();

        $facultadesAcademia =  Salon::with(['facultad', 'nivel'])
            ->whereHas('nivel', function ($q) {
                $q->where('nivel', 'academia');
            })
            ->get();

        return view('Admin.courses', compact(
            'cursos',
            'salones',
            'users',
            'niveles',
            'actividades',
            'salonesPrimaria',
            'salonesSecundaria',
            'facultadesAcademia'
        ));
    }

    // =====================
    // 👨‍🏫 DOCENTE (ARREGLADO)
    // =====================
    public function docenteIndex()
    {
        $user = Auth::user();

        $cursos = DB::table('docente_salon as ds')
            ->join('cursos as c', 'c.id_curso', '=', 'ds.id_curso')
            ->where('ds.id_usuario', $user->id_usuario)
            ->groupBy('c.id_curso', 'c.materia', 'c.created_at', 'c.updated_at')
            ->select('c.*')
            ->get();

        return view('Docentes.courses', compact(
            'cursos',
        ));
    }


    // =====================
    // 👨‍🎓 ALUMNO
    // =====================
    public function alumnoIndex()
    {
        $alumno = Auth::guard('alumno')->user();

        $cursos = DB::table('cursos as c')
            ->join('curso_salon as cs', 'cs.id_curso', '=', 'c.id_curso')
            ->where('cs.id_salon', $alumno->id_salon)
            ->select('c.*')
            ->get();

        return view('Alumno.courses', compact(
            'cursos'
        ));
    }

    // =====================
    // 👨‍🎓 APODERADO
    // =====================
    public function apoderadoIndex()
    {
        $apoderado = auth('apoderado')->user();

        $apoderado = Apoderado::with('alumnos')->find($apoderado->id_apoderado);

        $idSalones = $apoderado->alumnos->pluck('id_salon')->unique();

        $cursos = CursoSalon::with('curso')
            ->whereIn('id_salon', $idSalones)
            ->get()
            ->pluck('curso')
            ->unique('id_curso')
            ->values();

        return view('Apoderado.courses', compact('cursos'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'materia' => 'required|string|max:100',
        ]);
        Course::create([
            'materia' => $request->materia,
        ]);
        return redirect()->route('admin.courses')->with('success', 'Curso creado correctamente');
    }

    public function docentes(int $id_curso)
    {
        $docentes = DB::table('users')
            ->where('id_curso', $id_curso)
            ->whereIn('rol', ['docente', 'auxiliar'])
            ->select(
                'id_usuario as id',
                DB::raw("CONCAT(nombre, ' ', apellido) as nombre"),
                'rol'
            )
            ->orderBy('nombre')
            ->get();

        return response()->json($docentes);
    }
    public function salonesPorDocente(int $id_usuario)
    {
        $cursoId = request()->query('id_curso');

        $salones = DB::table('docente_salon')
            ->join('salones', 'docente_salon.id_salon', '=', 'salones.id_salon')
            ->join('niveles', 'salones.id_nivel', '=', 'niveles.id_nivel')
            ->leftJoin('grados', 'salones.id_grado', '=', 'grados.id_grado')
            ->leftJoin('secciones', 'salones.id_seccion', '=', 'secciones.id_seccion')
            ->leftJoin('facultades', 'salones.id_facultad', '=', 'facultades.id_facultad')
            ->where('docente_salon.id_usuario', $id_usuario)
            ->select(
                'salones.id_salon as id',
                'niveles.nivel',
                'grados.grado',
                'secciones.seccion',
                'facultades.facultad'
            )
            ->get();

        return response()->json($salones);
    }

    public function asignarSalones(Request $request)
    {
        $validated = $request->validate([
            'docente_id' => 'required|exists:users,id_usuario',
            'id_curso' => 'required|exists:cursos,id_curso',
            'salones' => 'nullable|array',
            'salones.*' => 'integer|exists:salones,id_salon',
        ]);

        $docenteId = (int) $validated['docente_id'];
        $cursoId = (int) $validated['id_curso'];
        $salones = $validated['salones'] ?? [];

        DB::transaction(function () use ($docenteId, $cursoId, $salones) {
            foreach ($salones as $id_salon) {
                DB::table('docente_salon')->updateOrInsert(
                    [
                        'id_usuario' => $docenteId,
                        'id_salon'   => $id_salon,
                        'id_curso'   => $cursoId,
                    ],
                    [
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );
                CursoSalon::updateOrCreate(
                    [
                        'id_curso' => $cursoId,
                        'id_salon' => $id_salon,
                    ],
                    []
                );
            }
        });

        return redirect()->back()->with('success', 'Salones asignados correctamente ✅');
    }

    public function detalleSalon(int $idSalon)
    {
        $alumnos = Alumno::where('id_salon', $idSalon)->get();

        $cursoId = request()->query('id_curso');
        $curso = $cursoId ? Course::find($cursoId) : Course::first();

        if (!$curso) {
            return response()->json([
                'alumnos' => [],
                'actividades' => [],
                'notas' => [],
            ]);
        }

        $actividades = CursoActividad::with('actividad')
            ->where('id_curso', $curso->id_curso)
            ->get()
            ->map(function ($ca) {
                return [
                    'id_curso_actividad' => $ca->id_curso_actividad,
                    'fecha_entrega'      => $ca->fecha_entrega,
                    'hora_entrega'       => $ca->hora_entrega,
                    'porcentaje'         => $ca->porcentaje ?? $ca->actividad->porcentaje,
                    'actividad'          => $ca->actividad,
                ];
            });

        $notas = Nota::whereIn(
            'id_alumno',
            $alumnos->pluck('id_alumno')
        )
            ->whereIn(
                'id_curso_actividad',
                $actividades->pluck('id_curso_actividad')
            )
            ->get();

        return response()->json([
            'alumnos' => $alumnos,
            'actividades' => $actividades,
            'notas' => $notas
        ]);
    }

    // =====================
    // 👨‍🎓 DETALLE CURSO ALUMNO
    // =====================
    public function detalleAlumno(int $idCurso)
    {
        $alumno = Auth::guard('alumno')->user();

        $actividades = DB::table('curso_actividades as ca')
            ->join('actividades as a', 'a.id_actividad', '=', 'ca.id_actividad')
            ->leftJoin('notas as n', function ($join) use ($alumno) {
                $join->on('n.id_curso_actividad', '=', 'ca.id_curso_actividad')
                    ->where('n.id_alumno', '=', $alumno->id_alumno);
            })
            ->where('ca.id_curso', $idCurso)
            ->select(
                'a.actividad',
                'ca.fecha_entrega',
                'ca.hora_entrega',
                'n.nota'
            )
            ->orderBy('ca.fecha_entrega')
            ->get();

        return response()->json([
            'actividades' => $actividades
        ]);
    }

    // =====================
    // 👨‍🎓 DETALLE CURSO APODERADO
    // =====================
    public function detalleApoderado(int $idCurso)
    {
        $apoderado = Auth::guard('apoderado')->user();

        $alumnosIds = $apoderado->alumnos->pluck('id_alumno');

        $actividades = DB::table('curso_actividades as ca')
            ->join('actividades as a', 'a.id_actividad', '=', 'ca.id_actividad')
            ->leftJoin('notas as n', function ($join) use ($alumnosIds) {
                $join->on('n.id_curso_actividad', '=', 'ca.id_curso_actividad')
                    ->whereIn('n.id_alumno', $alumnosIds);
            })
            ->where('ca.id_curso', $idCurso)
            ->select(
                'a.actividad',
                'ca.fecha_entrega',
                'ca.hora_entrega',
                'n.nota'
            )
            ->orderBy('ca.fecha_entrega')
            ->get();

        return response()->json([
            'actividades' => $actividades
        ]);
    }

    public function salonesPorCursoDocente(int $id_curso)
    {
        $user = Auth::user();

        $salones = DB::table('docente_salon')
            ->join('salones', 'docente_salon.id_salon', '=', 'salones.id_salon')
            ->join('niveles', 'salones.id_nivel', '=', 'niveles.id_nivel')
            ->leftJoin('grados', 'salones.id_grado', '=', 'grados.id_grado')
            ->leftJoin('secciones', 'salones.id_seccion', '=', 'secciones.id_seccion')
            ->leftJoin('facultades', 'salones.id_facultad', '=', 'facultades.id_facultad')
            ->where('docente_salon.id_usuario', $user->id_usuario)
            ->where('docente_salon.id_curso', $id_curso)
            ->select(
                'salones.id_salon as id',
                'niveles.nivel',
                'grados.grado',
                'secciones.seccion',
                'facultades.facultad'
            )
            ->get();

        return response()->json($salones);
    }

    public function guardarNotasSalon(Request $request, int $idSalon)
    {
        $validated = $request->validate([
            'notas' => 'required|array|min:1',
            'notas.*.id_alumno' => 'required|exists:alumnos,id_alumno',
            'notas.*.id_curso_actividad' => 'required|exists:curso_actividades,id_curso_actividad',
            'notas.*.nota' => 'nullable|numeric|min:0|max:20',
        ]);

        DB::transaction(function () use ($validated, $idSalon) {
            foreach ($validated['notas'] as $item) {
                $alumnoPerteneceSalon = Alumno::where('id_alumno', $item['id_alumno'])
                    ->where('id_salon', $idSalon)
                    ->exists();

                if (!$alumnoPerteneceSalon) {
                    continue;
                }

                if ($item['nota'] === null || $item['nota'] === '') {
                    Nota::where('id_alumno', $item['id_alumno'])
                        ->where('id_curso_actividad', $item['id_curso_actividad'])
                        ->delete();
                    continue;
                }

                Nota::updateOrCreate(
                    [
                        'id_alumno' => $item['id_alumno'],
                        'id_curso_actividad' => $item['id_curso_actividad'],
                    ],
                    [
                        'nota' => $item['nota'],
                    ]
                );
            }
        });

        return response()->json([
            'ok' => true,
            'message' => 'Notas guardadas correctamente.',
        ]);
    }
}
