<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Matricula;
use App\Services\CorreoService;
use App\Services\MatriculaService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MatriculaAdminController extends Controller
{
    /** Carpeta de vistas y prefijo de rutas (el panel de matrículas los sobrescribe). */
    protected string $vistas = 'Admin.matriculas';
    protected string $rutas = 'admin.matriculas.';

    public function __construct(
        protected MatriculaService $matriculaService,
        protected CorreoService $correoService
    ) {
    }

    public function index(Request $request)
    {
        $matriculas = $this->filtrar($request)
            ->with(['alumno', 'ciclo'])
            ->orderByDesc('fecha_registro')
            ->paginate(20)
            ->withQueryString();

        $estadisticas = $this->matriculaService->getEstadisticas();
        $correo = $this->correoService->estado();

        return view("{$this->vistas}.index", compact('matriculas', 'estadisticas', 'correo'));
    }

    public function dashboard()
    {
        return redirect()->route($this->rutas . 'index');
    }

    public function show($id)
    {
        $matricula = Matricula::with(['alumno.apoderado', 'ciclo.cuotas', 'pagos', 'conversacion'])->findOrFail($id);
        $detallePago = $matricula->ciclo ? $this->matriculaService->calcularMonto($matricula->ciclo) : null;
        $credenciales = $matricula->alumno?->fecha_nacimiento ? $this->matriculaService->credenciales($matricula->alumno) : null;
        $correo = $this->correoService->estado();

        return view("{$this->vistas}.show", compact('matricula', 'detallePago', 'credenciales', 'correo'));
    }

    public function updateEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => ['required', Rule::in(Matricula::ESTADOS)],
            'comprobante' => 'nullable|string|max:255',
        ]);

        $matricula = Matricula::with(['ciclo', 'alumno'])->findOrFail($id);
        $tipo = 'success';

        if ($request->estado === Matricula::ESTADO_PAGADA) {
            $pago = $this->matriculaService->registrarPago($matricula, $request->comprobante, $this->verificadoPor());

            if ($pago['ya_pagada']) {
                $mensaje = "La matrícula {$matricula->codigo} ya estaba pagada.";
            } else {
                [$tipo, $mensaje] = $this->resultadoCorreo($matricula, $pago['correo_enviado'], 'Pago verificado. ');
            }
        } elseif ($request->estado === Matricula::ESTADO_PENDIENTE) {
            // Reactivar: se da un nuevo plazo de pago.
            $matricula->update([
                'estado' => Matricula::ESTADO_PENDIENTE,
                'fecha_expiracion' => now()->addHours(MatriculaService::HORAS_PARA_PAGAR),
            ]);
            $mensaje = "Matrícula {$matricula->codigo} reactivada con un nuevo plazo de pago.";
        } else {
            $matricula->update(['estado' => $request->estado]);
            $mensaje = "Matrícula {$matricula->codigo} actualizada a \"{$request->estado}\".";
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => $tipo === 'success', 'estado' => $matricula->fresh()->estado, 'mensaje' => $mensaje]);
        }

        return back()->with($tipo, $mensaje);
    }

    /** Reenvía la bienvenida con las credenciales. Solo para matrículas pagadas. */
    public function reenviarNotificaciones($id)
    {
        $matricula = Matricula::with('alumno')->findOrFail($id);

        if ($matricula->estado !== Matricula::ESTADO_PAGADA) {
            $enviado = false;
            $mensaje = 'El correo de bienvenida solo se envía cuando el pago está verificado.';
        } else {
            [$tipo, $mensaje] = $this->resultadoCorreo($matricula, $this->matriculaService->enviarBienvenida($matricula));
            $enviado = $tipo === 'success';
        }

        if (request()->expectsJson()) {
            return response()->json(['success' => $enviado, 'mensaje' => $mensaje]);
        }

        return back()->with($enviado ? 'success' : 'error', $mensaje);
    }

    /** Envía un correo de prueba para comprobar la configuración de .env. */
    public function correoPrueba(Request $request)
    {
        $request->validate(['email' => 'required|email|max:100']);
        $r = $this->correoService->enviarPrueba($request->email);

        return back()->with($r['ok'] ? 'success' : 'error', $r['mensaje']);
    }

    /** Nombre que queda guardado en el pago como responsable de la verificación. */
    protected function verificadoPor(): ?string
    {
        $user = auth()->user();

        return $user ? trim("Intranet: {$user->nombre} {$user->apellido}") : null;
    }

    /**
     * Mensaje para el panel según cómo terminó el envío de la bienvenida.
     *
     * @return array{0:string, 1:string} [tipo, mensaje]
     */
    private function resultadoCorreo(Matricula $matricula, bool $enviado, string $prefijo = ''): array
    {
        $alumno = $matricula->alumno()->first();
        $cred = $alumno?->fecha_nacimiento ? $this->matriculaService->credenciales($alumno) : null;
        $credTexto = $cred ? " Credenciales: usuario {$cred['usuario']} / contraseña {$cred['password']}." : '';

        if (!$enviado) {
            return ['error', $prefijo . 'NO se pudo enviar el correo de bienvenida: ' . ($this->matriculaService->ultimoErrorCorreo ?? 'error desconocido') . $credTexto];
        }

        $correo = $this->correoService->estado();
        if (!$correo['activo']) {
            return ['error', $prefijo . 'El correo NO salió porque el envío no está configurado (' . $correo['motivo'] . ')' . $credTexto . ' Entrégaselas al alumno o configura el correo y usa "Reenviar bienvenida".'];
        }

        return ['success', $prefijo . "Se envió el correo de bienvenida a {$alumno->email} con sus credenciales."];
    }

    public function exportar(Request $request)
    {
        $matriculas = $this->filtrar($request)->with('alumno')->orderByDesc('fecha_registro')->get();

        $callback = function () use ($matriculas) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF"); // BOM para que Excel lea tildes
            fputcsv($out, ['Código', 'Fecha', 'Alumno', 'DNI', 'Email', 'Teléfono', 'Modalidad', 'Elección', 'Ciclo/Grado', 'Turno', 'Monto', 'Estado']);
            foreach ($matriculas as $m) {
                fputcsv($out, [
                    $m->codigo,
                    $m->fecha_registro?->format('d/m/Y H:i'),
                    $m->alumno_nombre_completo,
                    $m->alumno?->dni,
                    $m->alumno?->email,
                    $m->alumno?->telefono,
                    $m->modalidad,
                    $m->eleccion,
                    $m->ciclo_grado,
                    $m->turno,
                    $m->monto_total,
                    $m->estado_visible,
                ]);
            }
            fclose($out);
        };

        return response()->streamDownload($callback, 'matriculas_' . now()->format('Ymd_His') . '.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function estadisticasJson()
    {
        return response()->json([
            'success' => true,
            'data' => ['matriculas' => $this->matriculaService->getEstadisticas()],
        ]);
    }

    private function filtrar(Request $request)
    {
        $query = Matricula::query();

        if ($request->filled('estado')) {
            if ($request->estado === 'vencida') {
                $query->where('estado', Matricula::ESTADO_PENDIENTE)->where('fecha_expiracion', '<=', now());
            } elseif ($request->estado === Matricula::ESTADO_PENDIENTE) {
                $query->where('estado', Matricula::ESTADO_PENDIENTE)
                    ->where(fn ($q) => $q->whereNull('fecha_expiracion')->orWhere('fecha_expiracion', '>', now()));
            } else {
                $query->where('estado', $request->estado);
            }
        }

        if ($request->filled('modalidad')) {
            $query->where('modalidad', $request->modalidad);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('codigo', 'LIKE', "%{$search}%")
                  ->orWhereHas('alumno', function ($a) use ($search) {
                      $a->where('dni', 'LIKE', "%{$search}%")
                        ->orWhere('nombre', 'LIKE', "%{$search}%")
                        ->orWhere('apellido', 'LIKE', "%{$search}%");
                  });
            });
        }

        return $query;
    }
}
