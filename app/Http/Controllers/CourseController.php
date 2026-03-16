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

        return view('Admin.courses', compact(
            'cursos',
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
        $docentes = DB::table('users')
            ->where('id_curso', $id_curso)
            ->where('rol', 'docente')
            ->select(
                'id_usuario as id',
                DB::raw("CONCAT(nombre, ' ', apellido) as nombre")
            )
            ->get();
        return response()->json($docentes);
    }

    public function salonesPorDocente($id_usuario)
    {
        $salones = DB::table('docente_salon')
            ->join('salones', 'docente_salon.id_salon', '=', 'salones.id_salon')
            ->join('niveles', 'salones.id_nivel', '=', 'niveles.id_nivel')
            ->join('grados', 'salones.id_grado', '=', 'grados.id_grado')
            ->join('secciones', 'salones.id_seccion', '=', 'secciones.id_seccion')
            ->where('docente_salon.id_usuario', $id_usuario)
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
        $docenteId = $request->docente_id;
        $salones   = $request->salones ?? [];
        foreach ($salones as $id_salon) {
            DB::table('docente_salon')->updateOrInsert(
                [
                    'id_usuario' => $docenteId,
                    'id_salon'   => $id_salon,
                ],
                []
            );
        }

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
            ->get();

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
