<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ChatbotService;
use App\Models\ConversacionChatbot;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    protected ChatbotService $chatbotService;

    public function __construct(ChatbotService $chatbotService)
    {
        $this->chatbotService = $chatbotService;
    }

    public function procesar(Request $request)
    {
        try {
            $request->validate(['mensaje' => 'required|string|max:500']);

            $sessionId = $request->session()->getId();
            $mensaje = $request->input('mensaje');

            $resultado = $this->chatbotService->procesarMensaje($mensaje, $sessionId);

            return response()->json([
                'success' => true,
                'respuesta' => $resultado['mensaje'],
                'paso' => $resultado['paso'],
                'intencion' => $resultado['intencion'],
                'opciones' => $resultado['opciones'] ?? [],
                'entrada' => $resultado['entrada'] ?? null,
                'tarjeta' => $resultado['tarjeta'] ?? null,
            ]);
        } catch (\Exception $e) {
            Log::error('Error ChatbotController: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'No pudimos procesar tu mensaje. Inténtalo nuevamente.',
            ], 500);
        }
    }

    public function historial(Request $request)
    {
        $sessionId = $request->session()->getId();
        $conversacion = ConversacionChatbot::where('session_id', $sessionId)
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$conversacion) {
            return response()->json(['success' => false, 'error' => 'Sin conversación'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $conversacion->id,
                'estado' => $conversacion->estado,
                'paso_actual' => $conversacion->paso_actual,
                'mensajes' => $conversacion->mensajes,
                'datos' => $conversacion->datos_recolectados,
            ],
        ]);
    }

    /** Reinicia el chat: la conversación activa se marca como abandonada. */
    public function cerrar(Request $request)
    {
        ConversacionChatbot::where('session_id', $request->session()->getId())
            ->where('estado', 'activa')
            ->update(['estado' => 'abandonada']);

        return response()->json(['success' => true]);
    }
}
