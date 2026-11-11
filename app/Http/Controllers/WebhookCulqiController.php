<?php

namespace App\Http\Controllers;

use App\Models\WebhookEvento;
use App\Services\CulqiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * URL que Culqi llama de servidor a servidor cuando cambia un pago
 * (POST /webhooks/culqi). No depende de que el padre vuelva a la web.
 *
 * Seguridad:
 *  - Si CULQI_WEBHOOK_USUARIO y CULQI_WEBHOOK_CLAVE están en el .env, se exige
 *    autenticación básica (se configura igual en el panel de Culqi).
 *  - El contenido nunca se usa tal cual: CulqiService vuelve a consultar el cargo u
 *    orden en Culqi con la llave secreta antes de marcar nada como pagado.
 *
 * Respuestas: 200 = recibido (Culqi deja de reintentar); 500 = error temporal (Culqi reintenta).
 */
class WebhookCulqiController extends Controller
{
    /** Resultados definitivos: si el evento ya tiene uno, no se vuelve a procesar. */
    private const FINALES = ['pagado', 'duplicado', 'fallido', 'ignorado', 'monto_incorrecto'];

    public function __construct(protected CulqiService $culqi)
    {
    }

    public function __invoke(Request $request)
    {
        if (!$this->autorizado($request)) {
            return response()->json(['ok' => false], 401);
        }
        if (!$this->culqi->activo()) {
            return response()->json(['ok' => false, 'mensaje' => 'Pasarela no configurada.'], 503);
        }

        $payload = $request->json()->all();
        $data = is_string($payload['data'] ?? null) ? json_decode($payload['data'], true) : ($payload['data'] ?? []);
        $idEvento = (string) ($payload['id'] ?? 'sin-id-' . sha1($request->getContent()));

        $evento = WebhookEvento::firstOrCreate(
            ['id_evento' => mb_substr($idEvento, 0, 100)],
            [
                'pasarela' => 'culqi',
                'tipo' => mb_substr((string) ($payload['type'] ?? ''), 0, 100),
                'id_objeto' => is_array($data) ? mb_substr((string) ($data['id'] ?? ''), 0, 100) : null,
                'payload' => $payload,
            ]
        );

        if (in_array($evento->resultado, self::FINALES, true)) {
            return response()->json(['ok' => true, 'resultado' => $evento->resultado, 'repetido' => true]);
        }

        $r = $this->culqi->procesarWebhook($payload);

        $evento->update([
            'resultado' => $r['resultado'],
            'detalle' => mb_substr($r['detalle'], 0, 255),
            'id_matricula' => $r['id_matricula'],
        ]);

        Log::info('Webhook Culqi', ['evento' => $idEvento, 'tipo' => $evento->tipo] + $r);

        return response()->json(['ok' => $r['resultado'] !== 'error', 'resultado' => $r['resultado']], $r['resultado'] === 'error' ? 500 : 200);
    }

    private function autorizado(Request $request): bool
    {
        $usuario = config('services.culqi.webhook_usuario');
        $clave = config('services.culqi.webhook_clave');

        if (blank($usuario) || blank($clave)) {
            return true; // Sin credenciales configuradas, la seguridad recae en la reconsulta a Culqi.
        }

        return hash_equals((string) $usuario, (string) $request->getUser())
            && hash_equals((string) $clave, (string) $request->getPassword());
    }
}
