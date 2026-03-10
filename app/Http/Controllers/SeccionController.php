<?php

namespace App\Http\Controllers;

use App\Models\Seccion;
use App\Models\Nivel;
use App\Models\Grado;
use App\Models\Salon;
use Illuminate\Http\Request;

class SeccionController extends Controller
{

    public function storeMultiple(Request $request)
    {
        $request->validate([
            'secciones.*' => 'required|string|max:255'
        ]);

        // Obtener todos los niveles y grados existentes
        $niveles = Nivel::all();
        $grado  = Grado::all();

        $niveles = Nivel::with('grados')->get();

        foreach ($request->secciones as $nombreSeccion) {

            $seccion = Seccion::create([
                'seccion' => $nombreSeccion
            ]);

            foreach ($niveles as $nivel) {

                foreach ($nivel->grados as $grado) {

                    $existe = Salon::where('id_nivel', $nivel->id_nivel)
                        ->where('id_grado', $grado->id_grado)
                        ->where('id_seccion', $seccion->id_seccion)
                        ->exists();

                    if (!$existe) {
                        Salon::create([
                            'id_nivel'   => $nivel->id_nivel,
                            'id_grado'   => $grado->id_grado,
                            'id_seccion' => $seccion->id_seccion,
                            'id_facultad' => null
                        ]);
                    }
                }
            }
        }

        return back()->with('success', 'Secciones y salones creados automáticamente 🔥');
    }
}
