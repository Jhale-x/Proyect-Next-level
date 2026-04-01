<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QualificationController extends Controller
{
    public function index()
    {
        if (Auth::guard('alumno')->check()) {
            return view('Alumno.qualifications');
        }

        $user = Auth::user();
        if ($user && $user->rol === 'administrador') {
            return view('Admin.qualifications');
        }

        return view('Docentes.qualifications');
    }

    public function cursos()
    {
        if (Auth::guard('alumno')->check()) {
            $alumnoId = Auth::guard('alumno')->id();

            $cursos = DB::table('cursos as c')
                ->join('curso_actividades as ca', 'ca.id_curso', '=', 'c.id_curso')
                ->join('notas as n', 'n.id_curso_actividad', '=', 'ca.id_curso_actividad')
                ->where('n.id_alumno', $alumnoId)
                ->select('c.id_curso', 'c.materia')
                ->distinct()
                ->orderBy('c.materia')
                ->get();

            return response()->json($cursos);
        }

        $user = Auth::user();

        if ($user && $user->rol === 'docente') {
            $cursos = DB::table('cursos as c')
                ->leftJoin('docente_salon as ds', function ($join) use ($user) {
                    $join->on('ds.id_curso', '=', 'c.id_curso')
                        ->where('ds.id_usuario', '=', $user->id_usuario);
                })
                ->where(function ($query) use ($user) {
                    $query->where('c.id_curso', $user->id_curso)
                        ->orWhereNotNull('ds.id_docente_salon');
                })
                ->select('c.id_curso', 'c.materia')
                ->distinct()
                ->orderBy('c.materia')
                ->get();

            return response()->json($cursos);
        }

        $cursos = DB::table('cursos')
            ->select('id_curso', 'materia')
            ->orderBy('materia')
            ->get();

        return response()->json($cursos);
    }

    public function salones($idCurso)
    {
        if (Auth::guard('alumno')->check()) {
            $alumnoId = Auth::guard('alumno')->id();

            $salones = DB::table('alumnos as a')
                ->join('salones as s', 's.id_salon', '=', 'a.id_salon')
                ->join('niveles as n', 'n.id_nivel', '=', 's.id_nivel')
                ->leftJoin('grados as g', 'g.id_grado', '=', 's.id_grado')
                ->leftJoin('secciones as sec', 'sec.id_seccion', '=', 's.id_seccion')
                ->where('a.id_alumno', $alumnoId)
                ->whereExists(function ($query) use ($idCurso) {
                    $query->select(DB::raw(1))
                        ->from('notas as n2')
                        ->join('curso_actividades as ca2', 'ca2.id_curso_actividad', '=', 'n2.id_curso_actividad')
                        ->whereColumn('n2.id_alumno', 'a.id_alumno')
                        ->where('ca2.id_curso', $idCurso);
                })
                ->select(
                    's.id_salon',
                    DB::raw("CONCAT(n.nivel, ' - ', COALESCE(g.grado, ''), ' ', COALESCE(sec.seccion, '')) as salon")
                )
                ->distinct()
                ->get();

            return response()->json($salones);
        }

        $user = Auth::user();

        // Fuente adicional: salones que ya tienen notas en ese curso.
        $desdeNotas = DB::table('notas as no')
            ->join('curso_actividades as ca', function ($join) use ($idCurso) {
                $join->on('ca.id_curso_actividad', '=', 'no.id_curso_actividad')
                    ->where('ca.id_curso', '=', $idCurso);
            })
            ->join('alumnos as al', 'al.id_alumno', '=', 'no.id_alumno')
            ->join('salones as s', 's.id_salon', '=', 'al.id_salon')
            ->join('niveles as n', 'n.id_nivel', '=', 's.id_nivel')
            ->leftJoin('grados as g', 'g.id_grado', '=', 's.id_grado')
            ->leftJoin('secciones as sec', 'sec.id_seccion', '=', 's.id_seccion')
            ->select(
                's.id_salon',
                DB::raw("CONCAT(n.nivel, ' - ', COALESCE(g.grado, ''), ' ', COALESCE(sec.seccion, '')) as salon")
            );

        // Fuente principal: como se asigna en la pantalla de cursos (docente_salon + id_curso)
        $desdeDocenteSalon = DB::table('docente_salon as ds')
            ->join('salones as s', 's.id_salon', '=', 'ds.id_salon')
            ->join('niveles as n', 'n.id_nivel', '=', 's.id_nivel')
            ->leftJoin('grados as g', 'g.id_grado', '=', 's.id_grado')
            ->leftJoin('secciones as sec', 'sec.id_seccion', '=', 's.id_seccion')
            ->where('ds.id_curso', $idCurso)
            ->when($user && $user->rol === 'docente', fn($q) => $q->where('ds.id_usuario', $user->id_usuario))
            ->select(
                's.id_salon',
                DB::raw("CONCAT(n.nivel, ' - ', COALESCE(g.grado, ''), ' ', COALESCE(sec.seccion, '')) as salon")
            );

        // Fallback: si existe mapeo directo curso_salon
        $desdeCursoSalon = DB::table('curso_salon as cs')
            ->join('salones as s', 's.id_salon', '=', 'cs.id_salon')
            ->join('niveles as n', 'n.id_nivel', '=', 's.id_nivel')
            ->leftJoin('grados as g', 'g.id_grado', '=', 's.id_grado')
            ->leftJoin('secciones as sec', 'sec.id_seccion', '=', 's.id_seccion')
            ->where('cs.id_curso', $idCurso)
            ->select(
                's.id_salon',
                DB::raw("CONCAT(n.nivel, ' - ', COALESCE(g.grado, ''), ' ', COALESCE(sec.seccion, '')) as salon")
            );

        $salones = $desdeDocenteSalon
            ->union($desdeCursoSalon)
            ->union($desdeNotas)
            ->get()
            ->unique('id_salon')
            ->values();

        return response()->json($salones);
    }

    public function notas($idCurso, $idSalon)
    {
        $alumnos = DB::table('alumnos')
            ->where('id_salon', $idSalon)
            ->select('id_alumno', 'nombre', 'apellido')
            ->orderBy('apellido')
            ->orderBy('nombre')
            ->get();

        if (Auth::guard('alumno')->check()) {
            $alumnoId = Auth::guard('alumno')->id();

            $alumnos = $alumnos->where('id_alumno', $alumnoId)->values();
        }

        $actividades = DB::table('curso_actividades as ca')
            ->join('actividades as a', 'a.id_actividad', '=', 'ca.id_actividad')
            ->where('ca.id_curso', $idCurso)
            ->select(
                'ca.id_curso_actividad',
                'a.actividad as titulo',
                DB::raw('COALESCE(ca.porcentaje, a.porcentaje) as porcentaje')
            )
            ->orderBy('ca.id_curso_actividad')
            ->get();

        $notas = DB::table('notas')
            ->whereIn('id_alumno', $alumnos->pluck('id_alumno'))
            ->whereIn('id_curso_actividad', $actividades->pluck('id_curso_actividad'))
            ->select('id_alumno', 'id_curso_actividad', 'nota')
            ->get();

        return response()->json([
            'alumnos' => $alumnos,
            'actividades' => $actividades,
            'notas' => $notas,
        ]);
    }
}
