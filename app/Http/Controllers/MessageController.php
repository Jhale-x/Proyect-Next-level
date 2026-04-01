<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

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
        $esAlumno = Auth::guard('alumno')->check();
        $miId = $esAlumno ? Auth::guard('alumno')->id() : Auth::id();
        $miTipo = $esAlumno ? 'alumno' : 'user';
        // Si no hay ID de curso, devolvemos un array vacío para que el JS no falle
        if (!$id_curso) {
            return response()->json([]);
        }

        $miId = Auth::guard('alumno')->check() ? Auth::guard('alumno')->id() : Auth::id();

        $messages = Message::where('id_curso', $id_curso)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($m) use ($miId, $miTipo) {
                $emisorActual = $m->emisor_tipo === 'alumno'
                    ? $m->id_emisor_alumno
                    : $m->id_emisor_usuario;

                return [
                    'id'        => $m->id,
                    'contenido' => $m->contenido,
                    'fecha'     => $m->created_at->format('H:i'),
                    'es_mio'    => ($m->emisor_tipo === $miTipo && (int) $emisorActual === (int) $miId)
                ];
            });

        return response()->json($messages);
    }

    public function storeAjax(Request $request)
    {
        $data = $request->isJson() ? $request->json()->all() : $request->all();

        $validated = validator($data, [
            'id_curso' => ['required', 'integer', 'exists:cursos,id_curso'],
            'contenido' => ['required', 'string', 'max:2000'],
        ])->validate();

        $esAlumno = Auth::guard('alumno')->check();
        $miId = $esAlumno ? Auth::guard('alumno')->id() : Auth::id();

        if (!$miId) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuario no autenticado'
            ], 401);
        }

        $cursoSalonIds = DB::table('curso_salon')
            ->where('id_curso', $validated['id_curso'])
            ->pluck('id_curso_salon');

        $idCursoSalon = $cursoSalonIds->count() === 1
            ? $cursoSalonIds->first()
            : null;

        $mensaje = Message::create([
            'id_emisor' => $miId,
            'emisor_tipo' => $esAlumno ? 'alumno' : 'user',
            'id_emisor_usuario' => $esAlumno ? null : $miId,
            'id_emisor_alumno' => $esAlumno ? $miId : null,
            'id_curso'  => $validated['id_curso'],
            'id_curso_salon' => $idCursoSalon,
            'contenido' => $validated['contenido'],
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
