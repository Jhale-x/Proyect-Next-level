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
        // Eliminada la columna fecha_entrega del select y del orderBy
        $activities = DB::table('curso_actividades as ca')
            ->join('actividades as a', 'a.id_actividad', '=', 'ca.id_actividad')
            ->join('cursos as c', 'c.id_curso', '=', 'ca.id_curso')
            ->select(
                'a.id_actividad',
                'a.actividad',
                'a.descripcion',
                'c.materia'
            )
            ->orderBy('a.id_actividad', 'desc') // Ordenamos por ID para ver las más recientes
            ->get();

        if (Auth::guard('alumno')->check()) {
            return view('Alumno.activity', compact('activities'));
        }

        $user = Auth::user();

        if ($user && $user->rol === 'administrador') {
            return view('Admin.activity', compact('activities'));
        }

        return view('Docentes.activity', compact('activities'));
    }

    public function store(Request $request)
    {
        // Eliminada la validación de fecha_entrega
        $request->validate([
            'actividad' => 'required|string|max:255',
            'id_curso'  => 'required|exists:cursos,id_curso',
            'porcentaje' => 'required|integer|min:1|max:100',
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
                'porcentaje'  => $request->porcentaje,
            ]);

            DB::table('curso_actividades')->insert([
                'id_curso' => $request->id_curso,
                'id_actividad' => $actividad->id_actividad,
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

        DB::table('curso_actividades')->insert([
            'id_curso' => $request->id_curso,
            'id_actividad' => $request->id_actividad,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back();
    }
}