<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function index()
    {
        $actividades = DB::table('curso_actividades as ca')
            ->join('actividades as a', 'a.id_actividad', '=', 'ca.id_actividad')
            ->join('cursos as c', 'c.id_curso', '=', 'ca.id_curso')
            ->select(
                'a.actividad as titulo',
                'a.fecha_entrega as fecha',
                'c.materia as curso'
            )
            ->get();

        return view('Admin.calendar', compact('actividades'));
    }
}
