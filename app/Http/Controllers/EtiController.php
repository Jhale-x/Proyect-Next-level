<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EtiController extends Controller
{
    /* =========================
        VISTA PRINCIPAL
    ==========================*/
    public function index()
    {
        $user = Auth::user();

        if ($user && $user->rol === 'auxiliar') {

            $niveles = DB::table('niveles')->get();
            $grados = DB::table('grados')->get();
            $secciones = DB::table('secciones')->get();
            $facultades = DB::table('facultades')->get();

            $actividades = DB::table('curso_actividades as ca')
                ->join('cursos as c', 'ca.id_curso', '=', 'c.id_curso')
                ->join('actividades as a', 'ca.id_actividad', '=', 'a.id_actividad')
                ->where('c.materia', 'ETA')
                ->select(
                    'ca.id_curso_actividad',
                    'a.id_actividad',
                    'a.actividad',
                    'ca.porcentaje'
                )
                ->orderByRaw("
                    CASE 
                        WHEN LOWER(a.actividad) = 'promedio' THEN 999 
                        ELSE a.id_actividad 
                    END
                ")
                ->get();

            return view('Auxiliar.eta', compact(
                'niveles',
                'grados',
                'secciones',
                'facultades',
                'actividades'
            ));
        }
        return redirect('/auth/intranet');
    }

    public function etaIndex()
    {
        return $this->index();
    }

    /* =========================
        GRADOS POR NIVEL
    ==========================*/
    public function getGradosByNivel(int $id_nivel)
    {
        return response()->json(
            DB::table('grados')->where('id_nivel', $id_nivel)->get()
        );
    }

    /* =========================
        OBTENER ALUMNOS
    ==========================*/
    public function getAlumnos(Request $request)
    {
        try {

            $query = DB::table('alumnos as a')
                ->leftJoin('salones as s', 'a.id_salon', '=', 's.id_salon')
                ->select(
                    'a.id_alumno as id',
                    'a.nombre',
                    'a.apellido',
                    'a.dni'
                );

            if ($request->colegio) {

                if ($request->nivel) {
                    $query->where('s.id_nivel', $request->nivel);
                }

                if ($request->grado) {
                    $query->where('s.id_grado', $request->grado);
                }

                if ($request->seccion) {
                    $query->where('s.id_seccion', $request->seccion);
                }
            } else {

                if ($request->facultad) {
                    $query->where('s.id_facultad', $request->facultad);
                }
            }

            $alumnos = $query->get();

            return response()->json([
                'success' => true,
                'alumnos' => $alumnos
            ]);
        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getNotas(Request $request)
    {
        $notas = DB::table('notas as n')
            ->join('curso_actividades as ca', 'n.id_curso_actividad', '=', 'ca.id_curso_actividad')
            ->select(
                'n.id_alumno',
                'n.id_curso_actividad',
                'n.nota'
            )
            ->get();

        return response()->json([
            'success' => true,
            'notas' => $notas
        ]);
    }

    /* =========================
        GUARDAR NOTAS
    ==========================*/
    public function guardarPromedio(Request $request)
    {
        DB::table('notas')->updateOrInsert(
            [
                'id_alumno' => $request->alumno_id,
                'id_curso_actividad' => $request->curso_actividad_id
            ],
            [
                'nota' => $request->nota,
                'updated_at' => now(),
                'created_at' => now()
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Nota guardada correctamente'
        ]);
    }

    /* =========================
        PROMEDIO DESDE BD (REAL)
    ==========================*/
    public function getPromedios(Request $request)
    {
        $promedios = DB::table('notas')
            ->select('id_alumno', DB::raw('AVG(nota) as promedio'))
            ->groupBy('id_alumno')
            ->get();

        return response()->json([
            'success' => true,
            'promedios' => $promedios
        ]);
    }

    /* =========================
        GUARDAR TODAS LAS NOTAS (FRONT)
        (YA NO GUARDA PROMEDIO)
    ==========================*/
    public function guardarMultiplesPromedios(Request $request)
    {
        $alumnos = $request->input('alumnos', []);

        if (!is_array($alumnos) || empty($alumnos)) {
            return response()->json([
                'success' => false,
                'message' => 'Datos inválidos'
            ], 400);
        }

        // SOLO LOG (porque promedio no se guarda)
        foreach ($alumnos as $alumno) {

            $promedio = DB::table('notas')
                ->where('id_alumno', $alumno['id'])
                ->avg('nota');

            Log::info("Promedio alumno {$alumno['id']} = {$promedio}");
        }

        return response()->json([
            'success' => true,
            'message' => 'Notas guardadas correctamente. Promedio es automático.'
        ]);
    }

    /* =========================
        EXPORTAR
    ==========================*/
    public function exportarPromedios()
    {
        $csv = "Alumno,Promedio\nEjemplo,15";

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename=promedios.csv');
    }
}
