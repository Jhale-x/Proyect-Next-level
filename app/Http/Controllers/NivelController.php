<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NivelController extends Controller
{
    public function storeMultiple(Request $request)
    {
        $request->validate([
            'niveles.*' => 'required|string|max:255'
        ]);

        foreach ($request->niveles as $nivel) {
            \App\Models\Nivel::create([
                'nivel' => $nivel
            ]);
        }

        return back()->with('success', 'Niveles registrados correctamente 🔥');
    }
}
