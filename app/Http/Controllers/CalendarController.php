<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function index()
    {

        // =========================
        // 👨‍🎓 APODERADO
        // =========================
        if (Auth::guard('apoderado')->check()) {

            $apoderado = Auth::guard('apoderado')->user();

            $alumnosIds = $apoderado->alumnos->pluck('id_alumno');

            $actividades = DB::table('curso_actividades as ca')
                ->join('actividades as a', 'a.id_actividad', '=', 'ca.id_actividad')
                ->join('cursos as c', 'c.id_curso', '=', 'ca.id_curso')
                ->join('curso_salon as cs', 'cs.id_curso', '=', 'c.id_curso')
                ->join('salones as s', 's.id_salon', '=', 'cs.id_salon')
                ->join('alumnos as al', 'al.id_salon', '=', 's.id_salon')
                ->whereIn('al.id_alumno', $alumnosIds)
                ->select(
                    'ca.fecha_entrega as fecha',
                    'ca.hora_entrega',
                    'a.actividad as titulo',
                    'c.materia as curso'
                )
                ->orderBy('ca.fecha_entrega')
                ->get();

            return view('Apoderado.calendar', compact('actividades'));
        }
        // =========================
        // 👨‍🎓 ALUMNO
        // =========================
        if (Auth::guard('alumno')->check()) {

            $alumno = Auth::guard('alumno')->user();

            $actividades = DB::table('curso_actividades as ca')
                ->join('actividades as a', 'a.id_actividad', '=', 'ca.id_actividad')
                ->join('cursos as c', 'c.id_curso', '=', 'ca.id_curso')
                ->join('curso_salon as cs', 'cs.id_curso', '=', 'c.id_curso')
                ->where('cs.id_salon', $alumno->id_salon)
                ->select(
                    'ca.fecha_entrega as fecha',
                    'ca.hora_entrega',
                    'a.actividad as titulo',
                    'c.materia as curso'
                )
                ->orderBy('ca.fecha_entrega')
                ->get();

            return view('Alumno.calendar', compact('actividades'));
        }

        // =========================
        // 👨‍🏫 DOCENTE
        // =========================
        if (Auth::check() && Auth::user()->rol === 'docente') {

            $user = Auth::user();

            $query = DB::table('curso_actividades as ca')
                ->join('actividades as a', 'a.id_actividad', '=', 'ca.id_actividad')
                ->join('cursos as c', 'c.id_curso', '=', 'ca.id_curso')
                ->leftJoin('curso_salon as cs', 'cs.id_curso', '=', 'c.id_curso')
                ->leftJoin('salones as s', 's.id_salon', '=', 'cs.id_salon')
                ->select(
                    'ca.id_curso_actividad',
                    'a.actividad as titulo',
                    'ca.fecha_entrega as fecha',
                    'c.materia as curso',
                    'ca.hora_entrega',
                    's.id_salon'
                );

            $cursosDocente = DB::table('docente_salon')
                ->where('id_usuario', $user->id_usuario)
                ->pluck('id_curso')
                ->unique();

            $query->whereIn('ca.id_curso', $cursosDocente);

            $actividades = $query->get();

            $actividadesPorFechaHora = $actividades->groupBy(function ($act) {
                $hora = $act->hora_entrega
                    ? (int) explode(':', $act->hora_entrega)[0]
                    : -1;

                return $act->fecha . '__' . $hora;
            });

            return view('Docentes.calendar', compact(
                'actividades',
                'actividadesPorFechaHora'
            ));
        }


        // =========================
        // 👨‍💼 ADMIN
        // =========================
        if (Auth::check() && Auth::user()->rol === 'administrador') {

            $actividades = DB::table('curso_actividades as ca')
                ->join('actividades as a', 'a.id_actividad', '=', 'ca.id_actividad')
                ->join('cursos as c', 'c.id_curso', '=', 'ca.id_curso')
                ->leftJoin('curso_salon as cs', 'cs.id_curso', '=', 'c.id_curso')
                ->leftJoin('salones as s', 's.id_salon', '=', 'cs.id_salon')
                ->select(
                    'ca.id_curso_actividad',
                    'a.actividad as titulo',
                    'ca.fecha_entrega as fecha',
                    'c.materia as curso',
                    'ca.hora_entrega',
                    's.id_salon'
                )
                ->get();

            $actividadesPorFechaHora = $actividades->groupBy(function ($act) {
                $hora = $act->hora_entrega
                    ? (int) explode(':', $act->hora_entrega)[0]
                    : -1;

                return $act->fecha . '__' . $hora;
            });

            return view('Admin.calendar', compact(
                'actividades',
                'actividadesPorFechaHora'
            ));
        }

        abort(403);
    }
    public function calendarioDocente()
    {
        $docente = Auth::user();

        $actividades = DB::table('curso_actividades as ca')
            ->join('actividades as a', 'a.id_actividad', '=', 'ca.id_actividad')
            ->join('cursos as c', 'c.id_curso', '=', 'ca.id_curso')
            ->join('docente_salon as ds', 'ds.id_curso', '=', 'c.id_curso')
            ->where('ds.id_usuario', $docente->id_usuario)
            ->select(
                'ca.fecha_entrega as fecha',
                'ca.hora_entrega',
                'c.materia as curso',
                'a.actividad as titulo'
            )
            ->distinct()
            ->get();

        return view('Docentes.calendar', compact('actividades'));
    }
}
