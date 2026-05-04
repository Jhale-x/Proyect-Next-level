<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use App\Models\Seccion;
use App\Models\Salon;
use App\Models\Nivel;
use Illuminate\Http\Request;

class GradoController extends Controller
{
    public function storeMultiple(Request $request)
    {
        $request->validate([
            'id_nivel' => 'required|exists:niveles,id_nivel',
            'grados' => 'required|string',
        ]);
        
        // Convertir el textarea a array (uno por línea)
        $gradosArray = explode("\n", $request->grados);
        
        foreach ($gradosArray as $gradoTexto) {
            $gradoTexto = trim($gradoTexto);
            if (empty($gradoTexto)) continue;
            
            // Verificar si ya existe
            $gradoExistente = Grado::where('grado', $gradoTexto)
                ->where('id_nivel', $request->id_nivel)
                ->first();
            
            if ($gradoExistente) {
                continue;
            }
            
            $grado = Grado::create([
                'grado' => $gradoTexto,
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
        }
        
        return redirect()->back()->with('success', 'Grados y salones creados correctamente 🔥');
    }
    
    public function porNivel($id)
    {
        return response()->json(
            Grado::where('id_nivel', $id)->get()
        );
    }
}