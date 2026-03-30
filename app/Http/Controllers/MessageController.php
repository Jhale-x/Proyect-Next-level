<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Course;

class MessageController extends Controller
{
    public function index()
    {
        $cursos = Course::all();

        if (Auth::guard('alumno')->check()) {
            return view('Alumno.messages', compact('cursos'));
        }

        $user = Auth::user();
        if ($user) {
            if ($user->rol === 'administrador') return view('Admin.messages', compact('cursos'));
            if ($user->rol === 'auxiliar') return view('auxiliar.messages', compact('cursos'));
        }

        return view('Docentes.messages', compact('cursos'));
    }

    public function getMessagesByCurso($id_curso = null) // Añadimos = null
    {
        // Si no hay ID de curso, devolvemos un array vacío para que el JS no falle
        if (!$id_curso) {
            return response()->json([]);
        }

        $miId = Auth::guard('alumno')->check() ? Auth::guard('alumno')->id() : Auth::id();

        $messages = Message::where('id_curso', $id_curso)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function($m) use ($miId) {
                return [
                    'id'        => $m->id,
                    'contenido' => $m->contenido,
                    'fecha'     => $m->created_at->format('H:i'),
                    'es_mio'    => ($m->id_emisor == $miId)
                ];
            });

        return response()->json($messages);
    }

    public function storeAjax(Request $request)
    {
        $miId = Auth::guard('alumno')->check() ? Auth::guard('alumno')->id() : Auth::id();

        $mensaje = Message::create([
            'id_emisor' => $miId,
            'id_curso'  => $request->id_curso,
            'contenido' => $request->contenido,
        ]);

        return response()->json([
            'status' => 'success',
            'data'   => [
                'contenido' => $mensaje->contenido,
                'fecha'     => $mensaje->created_at->format('H:i'),
                'es_mio'    => true
            ]
        ]);
    }
}