<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\DniService;
use App\Services\MatriculaService;
use App\Models\Matricula;
use App\Models\Ciclo;

class MatriculaController extends Controller
{
    public function __construct(
        protected MatriculaService $matriculaService,
        protected DniService $dniService
    ) {
    }

    /**
     * Portada de matrícula (verificación de DNI)
     */
    public function index()
    {
        return view('matricula', [
            'desdeColegio' => $this->matriculaService->montoDesde('colegio'),
            'desdeAcademia' => $this->matriculaService->montoDesde('academia'),
            'sedes' => $this->matriculaService->sedes(),
        ]);
    }

    /**
     * Formulario de matrícula
     */
    public function mostrarFormulario()
    {
        $datos = session('alumno_datos');
        if (!$datos) {
            return redirect()->route('matricula')->with('error', 'Primero verifica tu DNI.');
        }

        $s = $this->matriculaService;

        return view('matricula_formulario', [
            'datos' => $datos,
            'sedes' => $s->sedes(),
            'entornos' => $s->entornos(),
            'turnos' => $s->turnos(),
            'niveles' => $s->niveles(),
            'universidades' => $s->universidades(),
            'tiposCiclo' => $s->tiposCiclo(),
            'secciones' => $s->secciones(),
            'desdeColegio' => $s->montoDesde('colegio'),
            'desdeAcademia' => $s->montoDesde('academia'),
        ]);
    }

    /**
     * Verificar DNI + CV con RENIEC
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo_doc' => 'required|in:dni',
            'documento' => 'required|digits:8',
            'codigo' => 'required|digits:1',
        ], [
            'tipo_doc.in' => 'Por ahora, la matrícula online solo está disponible para DNI.',
            'documento.digits' => 'El DNI debe tener 8 dígitos.',
            'codigo.digits' => 'El código de verificación (CV) es un solo dígito.',
        ]);

        $resultado = $this->dniService->verificar($request->documento, $request->codigo, $request->ip());

        if (!$resultado['ok']) {
            return back()->with('error', $resultado['error'])->withInput();
        }

        $request->session()->regenerate();
        session(['alumno_datos' => $resultado['datos']]);

        return redirect()->route('matricula.formulario');
    }

    /**
     * Procesar la matrícula (formulario web)
     */
    public function procesarMatricula(Request $request)
    {
        $verificado = session('alumno_datos');
        if (!$verificado) {
            return response()->json([
                'success' => false,
                'error' => 'Tu sesión expiró. Vuelve a verificar tu DNI.',
                'redirect' => route('matricula'),
            ], 419);
        }

        $data = $request->all();
        $validated = Validator::make($data, $this->matriculaService->reglas($data), $this->matriculaService->mensajes())->validate();

        if ($error = $this->matriculaService->validarNegocio($validated, $verificado['dni'])) {
            return response()->json(['success' => false, 'error' => $error], 422);
        }

        $resultado = $this->matriculaService->procesarMatricula($validated);

        if ($resultado['success']) {
            session()->forget('alumno_datos');
            return response()->json($resultado);
        }

        return response()->json($resultado, ($resultado['duplicada'] ?? false) ? 409 : 400);
    }

    // ======================================================
    // API para los selects del formulario
    // ======================================================

    public function getSedes()
    {
        return response()->json($this->matriculaService->sedes());
    }

    public function getEntornos()
    {
        return response()->json($this->matriculaService->entornos());
    }

    public function getNiveles()
    {
        return response()->json($this->matriculaService->niveles());
    }

    public function getSecciones()
    {
        return response()->json($this->matriculaService->secciones());
    }

    public function getTurnos()
    {
        return response()->json($this->matriculaService->turnos());
    }

    public function getUniversidades()
    {
        return response()->json($this->matriculaService->universidades());
    }

    public function getTiposCiclo()
    {
        return response()->json($this->matriculaService->tiposCiclo());
    }

    public function getGrados($nivel_id)
    {
        return response()->json($this->matriculaService->grados($nivel_id));
    }

    public function getCiclos(Request $request)
    {
        return response()->json($this->matriculaService->ciclos($request->only([
            'modalidad', 'id_sede', 'id_entorno', 'id_universidad', 'id_tipo_ciclo', 'id_turno', 'id_nivel',
        ])));
    }

    /**
     * Concepto a pagar por la matrícula de un ciclo (pago único al contado)
     */
    public function getCuotas($id_ciclo)
    {
        $ciclo = Ciclo::find($id_ciclo);
        if (!$ciclo) {
            return response()->json(['error' => 'Ciclo no encontrado'], 404);
        }

        $monto = $this->matriculaService->calcularMonto($ciclo);

        return response()->json($monto ? [$monto] : []);
    }

    /**
     * Estado de una matrícula por su código
     */
    public function verificarPago($codigo)
    {
        $matricula = Matricula::where('codigo', $codigo)->first();
        if (!$matricula) {
            return response()->json(['success' => false, 'error' => 'Código no encontrado'], 404);
        }

        return response()->json([
            'success' => true,
            'codigo' => $matricula->codigo,
            'estado' => $matricula->estado_visible,
            'monto_total' => $matricula->monto_total,
            'fecha_expiracion' => $matricula->fecha_expiracion?->format('d/m/Y H:i'),
        ]);
    }
}
