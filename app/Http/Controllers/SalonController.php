<?php

namespace App\Http\Controllers;


use App\Models\Nivel;
use App\Models\Grado;
use App\Models\Seccion;
use App\Models\Facultad;
use App\Models\Salon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalonController extends Controller
{
    public function crearCompleto(Request $request)
    {
        $request->validate([
            'nivel'     => 'required',
            'grado'     => 'required',
            'seccion'   => 'required',
            'facultad'  => 'required',
        ]);

        // Crear cada uno
        $nivel = Nivel::create([
            'nivel' => $request->nivel
        ]);

        $grado = Grado::create([
            'grado' => $request->grado
        ]);

        $seccion = Seccion::create([
            'seccion' => $request->seccion
        ]);

        $facultad = Facultad::create([
            'facultad' => $request->facultad
        ]);

        // Crear salón automáticamente
        Salon::create([
            'id_nivel'     => $nivel->id_nivel,
            'id_grado'     => $grado->id_grado,
            'id_seccion'   => $seccion->id_seccion,
            'id_facultad'  => $facultad->id_facultad,
        ]);

        return back()->with('success', 'Salón creado correctamente 🔥');
    }
    public function index()
    {
        return view('Admin.salones');
    }
    public function porNivel()
    {
        $primaria = DB::table('salones')
            ->join('niveles', 'salones.id_nivel', '=', 'niveles.id_nivel')
            ->join('grados', 'salones.id_grado', '=', 'grados.id_grado')
            ->join('secciones', 'salones.id_seccion', '=', 'secciones.id_seccion')
            ->where('niveles.nivel', 'Primaria')
            ->select(
                'salones.id_salon as id',
                'grados.grado',
                'secciones.seccion'
            )
            ->get();

        $secundaria = DB::table('salones')
            ->join('niveles', 'salones.id_nivel', '=', 'niveles.id_nivel')
            ->join('grados', 'salones.id_grado', '=', 'grados.id_grado')
            ->join('secciones', 'salones.id_seccion', '=', 'secciones.id_seccion')
            ->where('niveles.nivel', 'Secundaria')
            ->select(
                'salones.id_salon as id',
                'grados.grado',
                'secciones.seccion'
            )
            ->get();

        return response()->json([
            'primaria' => $primaria,
            'secundaria' => $secundaria
        ]);
    }
}
