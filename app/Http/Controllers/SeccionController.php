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
            'secciones' => 'required|array',
            'secciones.*' => 'required|string|max:255',
        ]);

        $niveles = Nivel::with('grados')->get();

        foreach ($request->secciones as $nombreSeccion) {
            $nombreSeccion = trim($nombreSeccion);
            if (empty($nombreSeccion)) continue;

            $seccion = Seccion::firstOrCreate([
                'seccion' => $nombreSeccion
            ]);

            foreach ($niveles as $nivel) {
                foreach ($nivel->grados as $grado) {

                    $existe = Salon::where([
                        'id_nivel' => $nivel->id_nivel,
                        'id_grado' => $grado->id_grado,
                        'id_seccion' => $seccion->id_seccion,
                    ])->exists();

                    if (!$existe) {
                        Salon::create([
                            'id_nivel' => $nivel->id_nivel,
                            'id_grado' => $grado->id_grado,
                            'id_seccion' => $seccion->id_seccion,
                            'id_facultad' => null
                        ]);
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Secciones y salones creados automáticamente 🔥');
    }
}
