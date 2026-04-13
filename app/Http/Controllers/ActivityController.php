<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = DB::table('curso_actividades as ca')
            ->join('actividades as a', 'a.id_actividad', '=', 'ca.id_actividad')
            ->join('cursos as c', 'c.id_curso', '=', 'ca.id_curso')
            ->leftJoin('curso_salon as cs', 'cs.id_curso', '=', 'c.id_curso')
            ->leftJoin('salones as s', 's.id_salon', '=', 'cs.id_salon')
            ->leftJoin('niveles as n', 'n.id_nivel', '=', 's.id_nivel')
            ->leftJoin('grados as g', 'g.id_grado', '=', 's.id_grado')
            ->leftJoin('secciones as sec', 'sec.id_seccion', '=', 's.id_seccion')
            ->select(
                'a.id_actividad',
                'a.actividad',
                'a.descripcion',
                'ca.id_curso',
                'ca.fecha_entrega',
                'ca.hora_entrega',
                DB::raw('COALESCE(ca.porcentaje, a.porcentaje) as porcentaje'),
                'c.materia',
                's.id_salon',
                DB::raw("COALESCE(CONCAT(n.nivel, ' - ', g.grado, ' ', sec.seccion), 'Sin salon asignado') as salon_nombre")
            )
            ->orderBy('c.materia')
            ->orderBy('ca.fecha_entrega', 'desc')
            ->get();

        // Compatibilidad: algunas vistas usan $activities y otras $actividades.
        $actividades = $activities;
        $activitiesBySalon = collect($activities ?? [])->groupBy('materia');


        if (Auth::guard('alumno')->check()) {
            return view('Alumno.activity', compact('activities', 'actividades', 'activitiesBySalon'));
        }

        $user = Auth::user();

        if ($user && $user->rol === 'administrador') {
            return view('Admin.activity', compact('activities', 'actividades', 'activitiesBySalon'));
        }

        return view('Docentes.activity', compact('activities', 'actividades', 'activitiesBySalon'));
    }

    public function store(Request $request)
    {
        // Eliminada la validación de fecha_entrega
        $request->validate([
            'actividad' => 'required|string|max:255',
            'id_curso'  => 'required|exists:cursos,id_curso',
            'porcentaje' => 'required|integer|min:1|max:100',
            'fecha_entrega' => 'required|date',
            'hora_entrega' => 'nullable|date_format:H:i',
        ]);

        $activityName = trim((string) $request->actividad);

        $alreadyExistsInCourse = DB::table('curso_actividades as ca')
            ->join('actividades as a', 'a.id_actividad', '=', 'ca.id_actividad')
            ->where('ca.id_curso', $request->id_curso)
            ->whereRaw('LOWER(a.actividad) = ?', [mb_strtolower($activityName)])
            ->exists();

        if ($alreadyExistsInCourse) {
            return back()
                ->withInput()
                ->withErrors(['actividad' => 'Esta actividad ya está registrada en este curso.']);
        }

        DB::transaction(function () use ($request, $activityName) {
            // Eliminada fecha_entrega del Create
            $actividad = Activity::create([
                'actividad'   => $activityName,
                'descripcion' => $request->descripcion,
                'porcentaje' => $request->porcentaje,
            ]);

            DB::table('curso_actividades')->insert([
                'id_curso' => $request->id_curso,
                'id_actividad' => $actividad->id_actividad,
                'fecha_entrega' => $request->fecha_entrega,
                'hora_entrega' => $request->hora_entrega,
                'porcentaje' => $request->porcentaje,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        return back()->with('success', 'Actividad registrada correctamente 🔥');
    }

    public function asignar(Request $request)
    {
        $request->validate([
            'id_curso' => 'required|exists:cursos,id_curso',
            'id_actividad' => 'required|exists:actividades,id_actividad',
            'fecha_entrega' => 'required|date',
            'hora_entrega' => 'nullable|date_format:H:i',
        ]);

        $alreadyAssigned = DB::table('curso_actividades')
            ->where('id_curso', $request->id_curso)
            ->where('id_actividad', $request->id_actividad)
            ->exists();

        if ($alreadyAssigned) {
            return back()
                ->withInput()
                ->withErrors(['id_actividad' => 'Esta actividad ya fue asignada a este curso.']);
        }

        $actividad = Activity::findOrFail($request->id_actividad);

        DB::table('curso_actividades')->insert([
            'id_curso' => $request->id_curso,
            'id_actividad' => $request->id_actividad,
            'porcentaje' => $actividad->porcentaje,
            'fecha_entrega' => $request->fecha_entrega,
            'hora_entrega' => $request->hora_entrega,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Actividad asignada correctamente 🔥');
    }

    public function updateFecha(Request $request, $id)
    {
        $request->validate([
            'fecha_entrega' => 'required|date',
            'hora_entrega'  => 'nullable|date_format:H:i',
        ]);

        $updated = DB::table('curso_actividades')
            ->where('id_curso_actividad', $id)
            ->update([
                'fecha_entrega' => $request->fecha_entrega,
                'hora_entrega'  => $request->hora_entrega,
                'updated_at'    => now(),
            ]);

        if (!$updated) {
            return response()->json(['ok' => false, 'message' => 'Actividad no encontrada.'], 404);
        }

        return response()->json(['ok' => true, 'message' => 'Fecha y hora actualizadas correctamente.']);
    }
}
