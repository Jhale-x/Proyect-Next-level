<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacultadController extends Controller
{
    public function storeMultiple(Request $request)
    {
        $request->validate([
            'facultades.*' => 'required|string|max:255'
        ]);

        foreach ($request->facultades as $facultad) {

            \App\Models\Facultad::create([
                'facultad' => $facultad
            ]);
        }

        return back()->with('success', 'Facultades registradas correctamente 🔥');
    }
}
