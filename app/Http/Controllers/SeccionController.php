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
            'secciones' => 'required|string',
        ]);
        
        // Convertir el textarea a array (uno por línea)
        $seccionesArray = explode("\n", $request->secciones);
        
        // Obtener todos los niveles y grados existentes
        $niveles = Nivel::with('grados')->get();
        
        foreach ($seccionesArray as $nombreSeccion) {
            $nombreSeccion = trim($nombreSeccion);
            if (empty($nombreSeccion)) continue;
            
            // Verificar si la sección ya existe
            $seccionExistente = Seccion::where('seccion', $nombreSeccion)->first();
            
            if ($seccionExistente) {
                $seccion = $seccionExistente;
            } else {
                $seccion = Seccion::create([
                    'seccion' => $nombreSeccion
                ]);
            }
            
            // Crear salones para cada nivel y grado
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
        
        return redirect()->back()->with('success', 'Secciones y salones creados automáticamente 🔥');
    }
}