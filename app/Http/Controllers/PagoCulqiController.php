<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Services\CulqiService;
use Illuminate\Http\Request;

/** Recibe el token del formulario de Culqi y cobra la matrícula. */
class PagoCulqiController extends Controller
{
    public function __construct(protected CulqiService $culqi)
    {
    }

    public function pagar(Request $request, string $codigo)
    {
        $datos = $request->validate([
            'token' => 'required|string|max:100',
            'email' => 'required|email|max:100',
        ]);

        $matricula = Matricula::with('alumno')->where('codigo', $codigo)->first();
        if (!$matricula) {
            return response()->json(['success' => false, 'mensaje' => 'No encontramos esa matrícula.'], 404);
        }

        $r = $this->culqi->cobrar($matricula, $datos['token'], $datos['email']);

        if (!$r['ok']) {
            return response()->json(['success' => false, 'mensaje' => $r['mensaje']], 422);
        }

        $email = $matricula->alumno?->email;

        return response()->json([
            'success' => true,
            'ya_pagada' => $r['ya_pagada'] ?? false,
            'correo_enviado' => $r['correo_enviado'] ?? false,
            'mensaje' => match (true) {
                $r['ya_pagada'] ?? false => 'Esta matrícula ya estaba pagada.',
                $r['correo_enviado'] ?? false => "¡Pago aprobado! Enviamos tu usuario y contraseña a {$email}.",
                default => 'Pago aprobado. En breve te enviaremos tus credenciales; si no te llegan, escríbenos por WhatsApp.',
            },
        ]);
    }
}
