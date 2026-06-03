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
            'niveles' => 'required|array',
            'niveles.*' => 'required|string|max:255',
        ]);

        foreach ($request->niveles as $nivelTexto) {
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

        return redirect()->back()->with('success', 'Nivel(es) registrado(s) correctamente ✅');
    }
}
