<?php

namespace App\Http\Controllers;

use App\Models\Facultad;
use App\Models\Salon;
use App\Models\Nivel;
use App\Models\Grado;
use App\Models\Seccion;
use Illuminate\Http\Request;

class FacultadController extends Controller
{
    public function storeMultiple(Request $request)
    {
        $request->validate([
            'facultades' => 'required|array',
            'facultades.*' => 'required|string|max:255',
        ]);

        foreach ($request->facultades as $texto) {

            $facultad = Facultad::firstOrCreate([
                'facultad' => trim($texto)
            ]);

            // 🔥 CREAR SALÓN SIEMPRE
            Salon::firstOrCreate([
                'id_nivel'    => 3,
                'id_grado'    => null,
                'id_seccion'  => null,
                'id_facultad' => $facultad->id_facultad,
            ]);
        }

        return back()->with('success', 'Facultades y salones creados 🔥');
    }
}
