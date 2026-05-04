<?php

namespace App\Http\Controllers;

use App\Models\Facultad;
use Illuminate\Http\Request;

class FacultadController extends Controller
{
    public function storeMultiple(Request $request)
    {
        $request->validate([
            'facultades' => 'required|string',
        ]);
        
        // Convertir el textarea a array (uno por línea)
        $facultadesArray = explode("\n", $request->facultades);
        
        foreach ($facultadesArray as $facultadTexto) {
            $facultadTexto = trim($facultadTexto);
            if (empty($facultadTexto)) continue;
            
            // Verificar si ya existe
            $existe = Facultad::where('facultad', $facultadTexto)->first();
            
            if (!$existe) {
                Facultad::create([
                    'facultad' => $facultadTexto
                ]);
            }
        }
        
        return redirect()->back()->with('success', 'Facultades registradas correctamente 🔥');
    }
}