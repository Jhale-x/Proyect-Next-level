<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EtiController extends Controller
{
    public function etaIndex()
    {
        $user = Auth::user();
        
        if (!$user || $user->rol !== 'auxiliar') {
            return redirect('/intranet')->with('error', 'No tienes acceso');
        }
        
        // Traer todos los datos de las 4 tablas
        $niveles = DB::table('niveles_educativos')->get();
        $grados = DB::table('grados')->get();
        $secciones = DB::table('secciones')->get();
        $facultades = DB::table('facultades')->get();
        
        return view('Auxiliar.eta', compact('niveles', 'grados', 'secciones', 'facultades'));
    }
    
    public function getGradosByNivel($id_nivel)
    {
        $grados = DB::table('grados')
            ->where('id_nivel', $id_nivel)
            ->get();
        
        return response()->json($grados);
    }
    
    public function getAlumnos(Request $request)
    {
        try {
            $query = DB::table('alumnos as a')
                ->leftJoin('salones as s', 'a.id_salon', '=', 's.id_salon')
                ->leftJoin('niveles_educativos as n', 's.id_nivel', '=', 'n.id')
                ->leftJoin('grados as g', 's.id_grado', '=', 'g.id_grado')
                ->leftJoin('secciones as sec', 's.id_seccion', '=', 'sec.id_seccion')
                ->leftJoin('facultades as f', 's.id_facultad', '=', 'f.id_facultad')
                ->select(
                    'a.id_alumno as id',
                    'a.nombre',
                    'a.apellido',
                    'a.dni'
                );
            
            $alumnos = $query->get();
            
            return response()->json([
                'success' => true,
                'alumnos' => $alumnos
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    public function guardarPromedio(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Promedio guardado'
        ]);
    }
    
    public function guardarMultiplesPromedios(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Promedios guardados'
        ]);
    }
    
    public function getPromedios(Request $request)
    {
        return response()->json([
            'success' => true,
            'promedios' => []
        ]);
    }
    
    public function exportarPromedios(Request $request)
    {
        $csv = "Alumno,Promedio\nPrueba,15";
        
        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="promedios.csv"');
    }
}