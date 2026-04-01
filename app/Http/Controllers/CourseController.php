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
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        $cursos = Course::all();
        $salonesPrimaria = Salon::with(['nivel', 'grado', 'seccion', 'facultad'])
            ->where('id_nivel', 1)
            ->get();
        $salonesSecundaria = Salon::with(['nivel', 'grado', 'seccion', 'facultad'])
            ->where('id_nivel', 2)
            ->get();
        $users = User::all();
        $cursos = Course::all();
        $salones = Salon::all();
        $users = User::all();
        $niveles = Nivel::all();
        $actividades = Activity::all();

        $cursosResumen = DB::table('cursos as c')
            ->leftJoin('docente_salon as ds', 'ds.id_curso', '=', 'c.id_curso')
            ->leftJoin('users as u', function ($join) {
                $join->on('u.id_usuario', '=', 'ds.id_usuario')
                    ->where('u.rol', '=', 'docente');
            })
            ->leftJoin('curso_salon as cs', 'cs.id_curso', '=', 'c.id_curso')
            ->leftJoin('salones as s', 's.id_salon', '=', 'cs.id_salon')
            ->leftJoin('niveles as n', 'n.id_nivel', '=', 's.id_nivel')
            ->leftJoin('grados as g', 'g.id_grado', '=', 's.id_grado')
            ->leftJoin('alumnos as a', 'a.id_salon', '=', 's.id_salon')
            ->select(
                'c.id_curso',
                'c.materia',
                DB::raw("COALESCE(MAX(CONCAT(u.nombre, ' ', u.apellido)), 'Sin docente') as docente_nombre"),
                DB::raw('COUNT(DISTINCT u.id_usuario) as total_docentes'),
                DB::raw("GROUP_CONCAT(DISTINCT CONCAT(u.nombre, ' ', u.apellido) ORDER BY u.nombre, u.apellido SEPARATOR ', ') as docentes_nombres"),
                DB::raw('COUNT(DISTINCT a.id_alumno) as total_alumnos'),
                DB::raw('COUNT(DISTINCT cs.id_salon) as total_salones'),
                DB::raw("COALESCE(GROUP_CONCAT(DISTINCT n.nivel ORDER BY n.nivel SEPARATOR ', '), 'Sin nivel') as niveles"),
                DB::raw("COALESCE(GROUP_CONCAT(DISTINCT g.grado ORDER BY g.grado SEPARATOR ', '), 'Sin grado') as grados")
            )
            ->groupBy('c.id_curso', 'c.materia')
            ->orderBy('c.materia')
            ->get()
            ->map(function ($curso) {
                $curso->estado = (int) $curso->total_salones > 0 ? 'activo' : 'inactivo';
                return $curso;
            });

        $statsCursos = [
            'total' => $cursosResumen->count(),
            'activos' => $cursosResumen->where('estado', 'activo')->count(),
            'inactivos' => $cursosResumen->where('estado', 'inactivo')->count(),
            'alumnos' => (int) $cursosResumen->sum('total_alumnos'),
        ];

        return view('Admin.courses', compact(
            'cursos',
            'cursosResumen',
            'statsCursos',
            'salones',
            'users',
            'niveles',
            'actividades',
            'salonesPrimaria',
            'salonesSecundaria',
        ));
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

    public function docentes($id_curso)
    {
        $docentes = DB::table('users as u')
            ->leftJoin('docente_salon as ds', 'ds.id_usuario', '=', 'u.id_usuario')
            ->leftJoin('curso_salon as cs', 'cs.id_salon', '=', 'ds.id_salon')
            ->where('u.rol', 'docente')
            ->where(function ($query) use ($id_curso) {
                $query->where('u.id_curso', $id_curso)
                    ->orWhere('ds.id_curso', $id_curso)
                    ->orWhere('cs.id_curso', $id_curso);
            })
            ->select(
                'u.id_usuario as id',
                DB::raw("CONCAT(u.nombre, ' ', u.apellido) as nombre")
            )
            ->distinct()
            ->orderBy('nombre')
            ->get();

        return response()->json($docentes);
    }

    public function salonesPorDocente($id_usuario)
    {
        $cursoId = request()->query('id_curso');

        $salones = DB::table('docente_salon')
            ->join('salones', 'docente_salon.id_salon', '=', 'salones.id_salon')
            ->join('niveles', 'salones.id_nivel', '=', 'niveles.id_nivel')
            ->join('grados', 'salones.id_grado', '=', 'grados.id_grado')
            ->join('secciones', 'salones.id_seccion', '=', 'secciones.id_seccion')
            ->where('docente_salon.id_usuario', $id_usuario)
            ->when($cursoId, fn($query) => $query->where('docente_salon.id_curso', $cursoId))
            ->select(
                'salones.id_salon as id',
                'niveles.nivel',
                'grados.grado',
                'secciones.seccion'
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
            DB::table('docente_salon')
                ->where('id_usuario', $docenteId)
                ->where('id_curso', $cursoId)
                ->when(!empty($salones), fn($query) => $query->whereNotIn('id_salon', $salones))
                ->when(empty($salones), fn($query) => $query)
                ->delete();

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
            }
        });

        return redirect()->back()->with('success', 'Salones asignados correctamente ✅');
    }

    public function detalleSalon($idSalon)
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

    public function guardarNotasSalon(Request $request, $idSalon)
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
