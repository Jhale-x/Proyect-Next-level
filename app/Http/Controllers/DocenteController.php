<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocenteController extends Controller
{
    public function asignarSalones(Request $request)
        {
            $docenteId = $request->docente_id;
            $salones = $request->salones ?? [];

            foreach ($salones as $id_salon) {
                DB::table('docente_salon')->updateOrInsert(
                    [
                        'id_usuario' => $docenteId,
                        'id_salon' => $id_salon
                    ],
                    []
                );
            }

            return response()->json(['ok' => true]);
        }

}
