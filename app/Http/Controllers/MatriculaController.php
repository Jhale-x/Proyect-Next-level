<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Apoderado;
use App\Models\Alumno;
use App\Models\Matricula;
use App\Models\Sede;
use App\Models\Entorno;
use App\Models\NivelEducativo;
use App\Models\Grado;
use App\Models\Seccion;
use App\Models\Turno;
use App\Models\Universidade;
use App\Models\TipoCiclo;
use App\Models\Ciclo;
use App\Models\Cuota;

class MatriculaController extends Controller
{
    public function index()
    {
        return view('matricula');
    }

    public function mostrarFormulario()
    {
        $datos = session('alumno_datos');
        if (!$datos) {
            return redirect()->route('matricula')->with('error', 'Debe validar su DNI primero.');
        }
        return view('matricula_formulario', compact('datos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'documento' => 'required|numeric|digits:8',
            'codigo'    => 'required|numeric|digits:1',
        ]);

        $dni = $request->input('documento');
        $codigoUsuario = $request->input('codigo');
        $token = env('APIS_PERU_TOKEN');

        try {
            $url = "https://dniruc.apisperu.com/api/v1/dni/{$dni}?token={$token}";
            $response = Http::timeout(10)->get($url);
            $datos = $response->json();

            if ($response->successful() && isset($datos['success']) && $datos['success']) {
                $cvReal = $datos['codVerifica'] ?? $datos['codigo_verificacion'] ?? null;

                if ($cvReal !== null && $codigoUsuario == $cvReal) {
                    session(['alumno_datos' => $datos]);
                    return redirect()->route('matricula.formulario');
                } else {
                    return redirect()->back()->with('error', 'El cÃ³digo de verificaciÃ³n (CV) es incorrecto.')->withInput();
                }
            }
            return redirect()->back()->with('error', 'DNI no encontrado.')->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error de conexiÃ³n con RENIEC.');
        }
    }

    // ======================================================
    // API ENDPOINTS PARA CARGAR DATOS EN EL FORMULARIO
    // ======================================================

    public function getSedes()
    {
        $sedes = Sede::where('activo', 1)->get(['id', 'nombre']);
        return response()->json($sedes);
    }

    public function getEntornos()
    {
        $entornos = Entorno::where('activo', 1)->get(['id', 'nombre']);
        return response()->json($entornos);
    }

    public function getNiveles()
    {
        $niveles = NivelEducativo::orderBy('orden')->get(['id', 'nombre']);
        return response()->json($niveles);
    }

    public function getGrados(int $nivel_id)
    {
        $grados = Grado::where('nivel_id', $nivel_id)
            ->where('activo', 1)
            ->orderBy('orden')
            ->get(['id', 'nombre', 'numero']);
        return response()->json($grados);
    }

    public function getSecciones()
    {
        $secciones = Seccion::get(['id', 'letra', 'nombre']);
        return response()->json($secciones);
    }

    public function getTurnos()
    {
        $turnos = Turno::get(['id_turno as id', 'nombre', 'hora_texto']);
        return response()->json($turnos);
    }

    public function getUniversidades()
    {
        $universidades = Universidade::get(['id_universidad as id', 'nombre', 'slug']);
        return response()->json($universidades);
    }

    public function getTiposCiclo()
    {
        $tipos = TipoCiclo::get(['id_tipo_ciclo as id', 'nombre']);
        return response()->json($tipos);
    }

    public function getCiclos(Request $request)
    {
        $ciclos = Ciclo::where('activo', 1)
            ->where('id_modalidad', 2)
            ->get(['id_ciclo as id', 'codigo', 'nombre', 'fecha_inicio', 'fecha_fin']);

        return response()->json($ciclos);
    }

    public function getCuotas(int $ciclo_id)
    {
        $cuotas = Cuota::where('ciclo_id', $ciclo_id)
            ->where('activo', 1)
            ->orderBy('orden')
            ->get(['id', 'numero', 'nombre', 'fecha_vencimiento', 'monto']);

        return response()->json($cuotas);
    }

    // ======================================================
    // PROCESAR MATRÃCULA
    // ======================================================

    public function procesarMatricula(Request $request)
    {
        $validated = $request->validate([
            'modalidad' => 'required|in:colegio,academia',
            'id_ciclo' => 'required|exists:ciclos,id_ciclo',
            'modalidad_pago' => 'required|in:c,co',
            'monto_total' => 'required|numeric',
            'alumno_nombres' => 'required|string|max:100',
            'alumno_ape_paterno' => 'required|string|max:100',
            'alumno_ape_materno' => 'nullable|string|max:100',
            'alumno_dni' => 'required|string|min:8|max:8',
            'alumno_email' => 'required|email|max:100',
            'alumno_celular' => 'nullable|string|max:15',
            'alumno_genero' => 'nullable|in:M,F',
            'alumno_fecha_nac' => 'nullable|date',
            'es_mayor' => 'nullable|in:si,no',
            'apoderado_nombres' => 'required_if:es_mayor,no|nullable|string|max:100',
            'apoderado_ape_paterno' => 'required_if:es_mayor,no|nullable|string|max:100',
            'apoderado_ape_materno' => 'nullable|string|max:100',
            'apoderado_dni' => 'required_if:es_mayor,no|nullable|string|min:8|max:8',
            'apoderado_email' => 'nullable|email|max:100',
            'apoderado_celular' => 'nullable|string|max:15',
            'apoderado_fecha_nac' => 'nullable|date',
            'terminos_aceptados' => 'accepted',
            'politicas_aceptadas' => 'accepted',
        ]);

        try {
            return DB::transaction(function () use ($request) {

                // Obtener el ciclo para obtener la informaciÃ³n
                $ciclo = Ciclo::find($request->input('id_ciclo'));

                $id_apoderado = null;
                if ($request->input('es_mayor') !== 'si') {
                    $apoderado = Apoderado::updateOrCreate(
                        ['dni' => $request->input('apoderado_dni')],
                        [
                            'nombre'   => $request->input('apoderado_nombres'),
                            'apellido' => $request->input('apoderado_ape_paterno') . ' ' . $request->input('apoderado_ape_materno'),
                            'telefono' => $request->input('apoderado_celular'),
                            'correo'   => $request->input('apoderado_email'),
                        ]
                    );
                    $id_apoderado = $apoderado->id_apoderado;
                }

                // Crear alumno
                $alumno = Alumno::create([
                    'id_apoderado'     => $id_apoderado,
                    'nombre'           => $request->input('alumno_nombres'),
                    'apellido'         => $request->input('alumno_ape_paterno') . ' ' . $request->input('alumno_ape_materno'),
                    'dni'              => $request->input('alumno_dni'),
                    'fecha_nacimiento' => $request->input('alumno_fecha_nac'),
                    'usuario'          => $request->input('alumno_dni'),
                    'contrasena'       => Hash::make($request->input('alumno_dni')),
                ]);

                // Crear matrÃ­cula con las columnas correctas de la tabla
                $matricula = Matricula::create([
                    'id_alumno'      => $alumno->id_alumno,
                    'aÃ±o_academico'  => date('Y'),
                    'modalidad'      => $request->input('modalidad'),
                    'eleccion'       => $request->input('modalidad') === 'colegio'
                        ? $request->input('nivel_escolar')
                        : ($ciclo ? $ciclo->nombre : ''),
                    'ciclo_grado'    => $request->input('modalidad') === 'colegio'
                        ? $request->input('grado_escolar')
                        : ($ciclo ? $ciclo->nombre : ''),
                    'sede'           => $request->input('modalidad') === 'colegio'
                        ? $request->input('col_sede')
                        : $request->input('aca_sede'),
                    'entorno'        => $request->input('modalidad') === 'colegio'
                        ? $request->input('col_entorno')
                        : $request->input('aca_entorno'),
                    'turno'          => $request->input('modalidad') === 'colegio'
                        ? $request->input('turno_escolar')
                        : $request->input('turno_academia'),
                    'fecha_registro' => now(),
                ]);

                $codigoPago = 'NL-' . date('Y') . '-' . strtoupper(Str::random(6));

                session()->forget('alumno_datos');

                return response()->json([
                    'success' => true,
                    'message' => 'MatrÃ­cula procesada correctamente',
                    'codigo'  => $codigoPago,
                    'id_matricula' => $matricula->id_matricula
                ]);
            });
        } catch (\Exception $e) {
            Log::error("Error Matricula: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'error'   => 'Error al guardar datos: ' . $e->getMessage()
            ], 500);
        }
    }
}
