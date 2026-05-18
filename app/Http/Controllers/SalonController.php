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
    public function export(int $idSalon, int $idCurso)
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

    public function import(Request $request, int $idSalon)
    {
        $request->validate([
            'excel' => 'required|file|mimes:xlsx,xls',
            'id_curso' => 'required|integer|exists:cursos,id_curso',
        ]);

        $idCurso = (int) $request->input('id_curso');

        $array = Excel::toArray([], $request->file('excel'));
        $sheet = $array[0] ?? [];
        if (empty($sheet)) {
            return back()->with('error', 'El archivo no contiene datos');
        }

        $normalizar = function ($texto) {
            $texto = trim((string) $texto);
            $texto = mb_strtolower($texto);
            $texto = strtr($texto, [
                'á' => 'a',
                'é' => 'e',
                'í' => 'i',
                'ó' => 'o',
                'ú' => 'u',
                'ü' => 'u',
                'ñ' => 'n',
            ]);
            return preg_replace('/\s+/', ' ', $texto);
        };

        $headerRowIndex = null;
        $nameColumnIndex = null;

        foreach ($sheet as $idx => $row) {
            if (!is_array($row)) {
                continue;
            }

            foreach ($row as $colIdx => $cell) {
                $valor = $normalizar($cell);
                if ($valor === 'apellidos y nombres' || $valor === 'alumno' || $valor === 'apellido y nombre') {
                    $headerRowIndex = $idx;
                    $nameColumnIndex = $colIdx;
                    break 2;
                }
            }
        }

        if ($headerRowIndex === null || $nameColumnIndex === null) {
            return back()->with('error', 'No se detecto la fila de encabezados en el Excel. Usa el archivo exportado por el sistema.');
        }

        $headings = array_map(function ($value) {
            return trim((string) $value);
        }, $sheet[$headerRowIndex]);

        $filasDatos = array_slice($sheet, $headerRowIndex + 1);

        $actividadesCurso = CursoActividad::with('actividad')
            ->where('id_curso', $idCurso)
            ->get();

        $actividadesPorNombre = [];
        foreach ($actividadesCurso as $ca) {
            $nombreActividad = trim((string) optional($ca->actividad)->actividad);
            if ($nombreActividad === '') {
                continue;
            }
            $actividadesPorNombre[$normalizar($nombreActividad)] = $ca;
        }

        if (empty($actividadesPorNombre)) {
            return back()->with('error', 'El curso no tiene actividades asignadas para importar notas.');
        }

        $columnasActividad = [];
        foreach ($headings as $colIdx => $heading) {
            if ($colIdx <= $nameColumnIndex) {
                continue;
            }

            $headingNormalizado = $normalizar($heading);
            if ($headingNormalizado === '' || $headingNormalizado === 'promedio' || $headingNormalizado === 'merito') {
                continue;
            }

            if (isset($actividadesPorNombre[$headingNormalizado])) {
                $columnasActividad[$colIdx] = $actividadesPorNombre[$headingNormalizado];
            }
        }

        if (empty($columnasActividad)) {
            return back()->with('error', 'No se encontraron columnas de actividades validas en el Excel para este curso.');
        }

        $alumnosNoEncontrados = [];
        $notasRegistradas = 0;

        foreach ($filasDatos as $row) {
            $nombreCompleto = trim((string) ($row[$nameColumnIndex] ?? ''));
            if ($nombreCompleto === '') {
                continue;
            }

            // Evita procesar filas de totales o cabeceras repetidas.
            $nombreNormalizado = $normalizar($nombreCompleto);
            if ($nombreNormalizado === 'apellidos y nombres' || $nombreNormalizado === 'alumno') {
                continue;
            }

            // The export format uses "apellido nombre" in the first column.
            // We only map to existing students in the same salón to avoid invalid inserts.
            $alumno = Alumno::where('id_salon', $idSalon)
                ->where(function ($q) use ($nombreCompleto) {
                    $q->whereRaw("LOWER(CONCAT(apellido, ' ', nombre)) = ?", [mb_strtolower($nombreCompleto)])
                        ->orWhereRaw("LOWER(CONCAT(nombre, ' ', apellido)) = ?", [mb_strtolower($nombreCompleto)]);
                })
                ->first();

            if (!$alumno) {
                $alumnosNoEncontrados[] = $nombreCompleto;
                continue;
            }

            foreach ($columnasActividad as $colIdx => $actividad) {
                $valor = $row[$colIdx] ?? null;
                if ($valor === null || $valor === '') {
                    continue;
                }

                $notaNormalizada = trim((string) $valor);
                $notaNormalizada = str_replace(',', '.', $notaNormalizada);
                if (!is_numeric($notaNormalizada)) {
                    continue;
                }

                Nota::updateOrCreate(
                    [
                        'id_alumno' => $alumno->id_alumno,
                        'id_curso_actividad' => $actividad->id_curso_actividad,
                    ],
                    ['nota' => $notaNormalizada]
                );

                $notasRegistradas++;
            }
        }

        if ($notasRegistradas === 0) {
            return back()->with('warning', 'No se registraron notas. Verifica que el Excel corresponda al curso y que los nombres de alumnos coincidan.');
        }

        if (!empty($alumnosNoEncontrados)) {
            $alumnosNoEncontrados = array_values(array_unique($alumnosNoEncontrados));

            return back()
                ->with('success', 'Datos importados correctamente')
                ->with('warning', 'No se encontraron alumnos para: ' . implode(', ', $alumnosNoEncontrados));
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