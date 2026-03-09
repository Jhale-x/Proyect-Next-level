<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index()
    {
        if (Auth::guard('alumno')->check()) {
            return view('Alumno.activity');
        }

        $user = Auth::user();
        if ($user && $user->rol === 'administrador') {
            return view('Admin.activity');
        }

        return view('Docentes.activity');
    }
    public function store(Request $request)
    {
        $request->validate([
            'actividad' => 'required|string|max:255',
            'id_curso'  => 'required'
        ]);

        DB::transaction(function () use ($request) {

            $actividad = Activity::create([
                'actividad'  => $request->actividad,
                'descripcion' => $request->descripcion,
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
        DB::table('curso_actividades')->insert([
            'id_curso' => $request->id_curso,
            'id_actividad' => $request->id_actividad,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back();
    }
}
