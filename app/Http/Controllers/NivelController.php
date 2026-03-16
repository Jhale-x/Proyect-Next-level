<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nivel;
use App\Models\Seccion;
use App\Models\Grado;
use App\Models\Facultad; // Asegúrate de que estos modelos existan

class NivelController extends Controller
{
    public function storeMultiple(Request $request)
    {
        $request->validate(['niveles.*' => 'required|string|max:255']);
        foreach ($request->niveles as $nivel) {
            Nivel::create(['nivel' => $nivel]);
        }
        return back()->with('success', 'Niveles registrados correctamente 🔥');
    }

    public function storeSecciones(Request $request)
    {
        $request->validate(['secciones.*' => 'required|string|max:255']);
        foreach ($request->secciones as $seccion) {
            Seccion::create(['seccion' => $seccion]);
        }
        return back()->with('success', 'Secciones registradas correctamente');
    }

    public function storeGrados(Request $request)
    {
        // La vista envía un array de objetos con id_nivel y grado
        foreach ($request->grados as $dato) {
            if (!empty($dato['grado'])) {
                Grado::create([
                    'id_nivel' => $dato['id_nivel'],
                    'grado' => $dato['grado']
                ]);
            }
        }
        return back()->with('success', 'Grados registrados correctamente');
    }

    public function storeFacultades(Request $request)
    {
        $request->validate(['facultades.*' => 'required|string|max:255']);
        foreach ($request->facultades as $facultad) {
            Facultad::create(['facultad' => $facultad]);
        }
        return back()->with('success', 'Facultades registradas correctamente');
    }
}