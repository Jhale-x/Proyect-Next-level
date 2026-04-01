<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function index()
    {
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

        // Para docentes: filtrar solo las actividades de sus salones
        $user = Auth::user();
        if ($user && $user->rol === 'docente') {
            $salonesDocente = DB::table('docente_salon')
                ->where('id_usuario', $user->id_usuario)
                ->pluck('id_salon');

            $query->whereIn('s.id_salon', $salonesDocente);
        }

        $actividades = $query->distinct('ca.id_curso_actividad')->get();

        // Pre-agrupar para el blade: fecha_YYYY-MM-DD => hora => actividades
        $actividadesPorFechaHora = $actividades->groupBy(function ($act) {
            $hora = $act->hora_entrega ? (int) explode(':', $act->hora_entrega)[0] : -1;
            return $act->fecha . '__' . $hora;
        });

        $view = ($user && $user->rol === 'administrador')
            ? 'Admin.calendar'
            : 'Docentes.calendar';

        return view($view, compact('actividades', 'actividadesPorFechaHora'));
    }
}
