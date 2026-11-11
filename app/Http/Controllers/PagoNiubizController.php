<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Services\NiubizService;
use Illuminate\Http\Request;

/**
 * Pago de matrícula con el Botón de Pago Web de Niubiz.
 *
 *  - sesion():    el navegador pide la configuración para abrir el formulario de Niubiz.
 *  - respuesta(): Niubiz hace POST aquí con el transactionToken; el servidor autoriza
 *                 el cobro con Niubiz y redirige a la página de resultado.
 *  - resultado(): muestra al padre si el pago se aprobó o no.
 */
class PagoNiubizController extends Controller
{
    public function __construct(protected NiubizService $niubiz)
    {
    }

    public function sesion(Request $request, string $codigo)
    {
        $matricula = $this->buscar($codigo);
        if (!$matricula) {
            return response()->json(['success' => false, 'mensaje' => 'No encontramos esa matrícula.'], 404);
        }

        $r = $this->niubiz->crearSesion(
            $matricula,
            $request->ip(),
            route('matricula.pago.niubiz.respuesta', $matricula->codigo),
            route('matricula.pago.niubiz.resultado', ['codigo' => $matricula->codigo, 'expirado' => 1])
        );

        if (!$r['ok']) {
            return response()->json(['success' => false, 'mensaje' => $r['mensaje']], 422);
        }

        return response()->json(['success' => true, 'script' => $this->niubiz->urlScript(), 'config' => $r['config']]);
    }

    public function respuesta(Request $request, string $codigo)
    {
        $matricula = $this->buscar($codigo);
        abort_unless($matricula, 404);

        $token = (string) $request->input('transactionToken', '');
        $canal = (string) $request->input('channel', 'web');

        if ($token === '' || strlen($token) > 100) {
            return $this->ir($matricula, false, 'El formulario de pago no devolvió la información de la transacción. No se realizó ningún cobro.');
        }

        // PagoEfectivo: Niubiz devuelve un código CIP para pagar en agente o banca; no se autoriza aquí.
        if ($canal === 'pagoefectivo') {
            return $this->ir($matricula, null, "Tu código de pago PagoEfectivo (CIP) es {$token}. Págalo en cualquier agente o banca por internet; confirmaremos tu matrícula al recibir el pago.");
        }

        $r = $this->niubiz->autorizar($matricula, $token);

        return $this->ir($matricula, $r['ok'], match (true) {
            !$r['ok'] => $r['mensaje'],
            $r['ya_pagada'] ?? false => 'Esta matrícula ya estaba pagada.',
            $r['correo_enviado'] ?? false => '¡Pago aprobado! Te enviamos la constancia y tus credenciales por correo.',
            default => 'Pago aprobado. En breve te enviaremos la constancia; si no te llega, escríbenos por WhatsApp.',
        });
    }

    public function resultado(Request $request, string $codigo)
    {
        $matricula = $this->buscar($codigo);
        abort_unless($matricula, 404);

        $resultado = session('pago_resultado');
        if (!$resultado && $request->boolean('expirado')) {
            $resultado = ['ok' => false, 'mensaje' => 'El tiempo para completar el pago terminó. No se realizó ningún cobro; puedes intentarlo nuevamente.'];
        }

        return view('matricula_pago_resultado', [
            'matricula' => $matricula,
            'ok' => $resultado['ok'] ?? ($matricula->estado === Matricula::ESTADO_PAGADA ? true : null),
            'mensaje' => $resultado['mensaje'] ?? null,
        ]);
    }

    private function buscar(string $codigo): ?Matricula
    {
        return Matricula::with('alumno.apoderado')->where('codigo', $codigo)->first();
    }

    /** Redirige (PRG) para que recargar la página no reenvíe el pago. */
    private function ir(Matricula $matricula, ?bool $ok, string $mensaje)
    {
        return redirect()
            ->route('matricula.pago.niubiz.resultado', $matricula->codigo)
            ->with('pago_resultado', ['ok' => $ok, 'mensaje' => $mensaje]);
    }
}
