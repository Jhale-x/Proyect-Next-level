<?php

namespace App\Http\Controllers;


use App\Models\Nivel;
use App\Models\Grado;
use App\Models\Seccion;
use App\Models\Facultad;
use App\Models\Salon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Alumno;
use App\Models\Course;
use App\Models\CursoActividad;
use App\Models\Nota;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

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
    public function export($idSalon, $idCurso)
    {
        // build same data as detalleSalon
        $salon = Salon::with(['nivel', 'grado', 'seccion'])->findOrFail($idSalon);
        $alumnos = Alumno::where('id_salon', $idSalon)->get();
        $curso = Course::findOrFail($idCurso);
        $actividades = CursoActividad::with('actividad')
            ->where('id_curso', $curso->id_curso)
            ->get();

        // prepare heading row
        $headings = ['Alumno'];
        foreach ($actividades as $act) {
            $headings[] = $act->actividad->actividad;
        }

        // prepare data rows
        $rows = [];
        foreach ($alumnos as $al) {
            $fila = [
                'alumno' => $al->apellido . ' ' . $al->nombre
            ];
            foreach ($actividades as $act) {
                $nota = Nota::where('id_alumno', $al->id_alumno)
                    ->where('id_curso_actividad', $act->id_curso_actividad)
                    ->first();
                $fila[] = $nota ? $nota->nota : '';
            }
            $rows[] = $fila;
        }

        // build filename with Curso + Nivel + Grado + Sección
        $nombreArchivo = sprintf(
            '%s %s %s %s',
            $curso->materia,
            $salon->nivel->nivel,
            $salon->grado->grado,
            $salon->seccion->seccion
        );
        $nombreArchivo = preg_replace('/[^A-Za-z0-9 _-]/', '', $nombreArchivo);
        $nombreArchivo = preg_replace('/\s+/', ' ', $nombreArchivo);
        $nombreArchivo = trim($nombreArchivo);
        $nombreArchivo = str_replace(' ', '_', $nombreArchivo);

        // download using Laravel Excel collection exporter
        return Excel::download(
            new \App\Exports\SalonExport($curso, $actividades, $rows),
            "{$nombreArchivo}.xlsx"
        );
    }

    public function import(Request $request, $idSalon)
    {
        $request->validate([
            'excel' => 'required|file|mimes:xlsx,xls',
        ]);

        $array = Excel::toArray([], $request->file('excel'));
        $sheet = $array[0] ?? [];
        if (empty($sheet)) {
            return back()->with('error', 'El archivo no contiene datos');
        }

        $headings = array_shift($sheet);
        $activityNames = array_slice($headings, 1);

        foreach ($sheet as $row) {
            $nombre = $row[0] ?? null;
            if (!$nombre) continue;
            $alumno = Alumno::firstOrCreate(
                ['nombre' => $nombre],
                ['id_salon' => $idSalon]
            );

            for ($i = 0; $i < count($activityNames); $i++) {
                $valor = $row[$i + 1] ?? null;
                if ($valor === null || $valor === '') continue;
                $actividadName = $activityNames[$i];
                $actividad = CursoActividad::whereHas('actividad', function ($q) use ($actividadName) {
                    $q->where('actividad', $actividadName);
                })->first();

                if ($actividad) {
                    Nota::updateOrCreate(
                        [
                            'id_alumno' => $alumno->id_alumno,
                            'id_curso_actividad' => $actividad->id_curso_actividad,
                        ],
                        ['nota' => $valor]
                    );
                }
            }
        }

        return back()->with('success', 'Datos importados correctamente');
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
