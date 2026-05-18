<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use App\Models\Seccion;
use App\Models\Salon;
use Illuminate\Http\Request;

class GradoController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'grado' => 'required|string|max:255',
            'id_nivel' => 'required|exists:niveles,id_nivel'
        ]);

        $grado = Grado::create([
            'grado' => $request->grado,
            'id_nivel' => $request->id_nivel
        ]);

        // Buscar secciones existentes
        $secciones = Seccion::all();

        foreach ($secciones as $seccion) {

            $existe = Salon::where('id_nivel', $grado->id_nivel)
                ->where('id_grado', $grado->id_grado)
                ->where('id_seccion', $seccion->id_seccion)
                ->exists();

            if (!$existe) {
                Salon::create([
                    'id_nivel'   => $grado->id_nivel,
                    'id_grado'   => $grado->id_grado,
                    'id_seccion' => $seccion->id_seccion,
                    'id_facultad' => null
                ]);
            }
        }

        return back()->with('success', 'Grado y salones creados correctamente 🔥');
    }

    public function storeMultiple(Request $request)
    {
        $request->validate([
            'grados.*.grado' => 'required|string|max:255',
            'grados.*.id_nivel' => 'required|exists:niveles,id_nivel'
        ]);

        foreach ($request->grados as $gradoData) {

            $grado = Grado::create([
                'grado' => $gradoData['grado'],
                'id_nivel' => $gradoData['id_nivel']
            ]);

            // Buscar secciones existentes
            $secciones = Seccion::all();

            foreach ($secciones as $seccion) {

                $existe = Salon::where('id_nivel', $grado->id_nivel)
                    ->where('id_grado', $grado->id_grado)
                    ->where('id_seccion', $seccion->id_seccion)
                    ->exists();

                if (!$existe) {
                    Salon::create([
                        'id_nivel'   => $grado->id_nivel,
                        'id_grado'   => $grado->id_grado,
                        'id_seccion' => $seccion->id_seccion,
                        'id_facultad' => null
                    ]);
                }
            }
        }

        return back()->with('success', 'Grados y salones creados correctamente 🔥');
    }

    public function porNivel(int $id)
    {
        return response()->json(
            \App\Models\Grado::where('id_nivel', $id)->get()
        );
    }
}
