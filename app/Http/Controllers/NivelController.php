<?php

namespace App\Http\Controllers;

use App\Models\Nivel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NivelController extends Controller
{
    public function storeMultiple(Request $request)
    {
        $request->validate([
            'nivel' => 'nullable|string|max:255',
            'niveles' => 'nullable|string',
        ]);
        
        // Si viene un solo nivel
        if ($request->filled('nivel')) {
            $existe = Nivel::where('nivel', $request->nivel)->first();
            if (!$existe) {
                Nivel::create([
                    'nivel' => $request->nivel
                ]);
            }
        }
        
        // Si vienen múltiples niveles (uno por línea)
        if ($request->filled('niveles')) {
            $nivelesArray = explode("\n", $request->niveles);
            foreach ($nivelesArray as $nivelTexto) {
                $nivelTexto = trim($nivelTexto);
                if (!empty($nivelTexto)) {
                    $existe = Nivel::where('nivel', $nivelTexto)->first();
                    if (!$existe) {
                        Nivel::create([
                            'nivel' => $nivelTexto
                        ]);
                    }
                }
            }
        }
        
        return redirect()->back()->with('success', 'Nivel(es) registrado(s) correctamente ✅');
    }
}