<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Course;
use App\Models\User;
use App\Models\CursoSalon;
use Illuminate\Support\Facades\DB;
use App\Models\Alumno;

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

    public function buscarUsuarios(Request $request)
    {
        $q = $request->q ?? '';

        $cursoSalon = CursoSalon::find($request->id_curso_salon);

        if (!$cursoSalon) {
            return response()->json([]);
        }

        $idSalon = $cursoSalon->id_salon;

        // =========================================
        // 🎓 ALUMNOS DEL SALÓN
        // =========================================
        $alumnos = Alumno::where('id_salon', $idSalon)

            ->where(function ($query) use ($q) {

                $query->where('nombre', 'like', "%{$q}%")
                    ->orWhere('apellido', 'like', "%{$q}%");
            })

            ->limit(10)

            ->get()

            ->map(function ($a) {

                return [
                    'id' => $a->id_alumno,
                    'name' => $a->nombre . ' ' . $a->apellido,
                    'role' => 'alumno'
                ];
            });


        // =========================================
        // 👨‍🏫 DOCENTES
        // =========================================
        $docentes = User::where('rol', 'docente')

            ->where(function ($query) use ($q) {

                $query->where('nombre', 'like', "%{$q}%")
                    ->orWhere('apellido', 'like', "%{$q}%");
            })

            ->limit(10)

            ->get()

            ->map(function ($u) {

                return [
                    'id' => $u->id_usuario,
                    'name' => $u->nombre . ' ' . $u->apellido,
                    'role' => 'docente'
                ];
            });

        // =========================================
        // 🔥 UNIR TODO
        // =========================================
        return response()->json(

            $alumnos
                ->merge($docentes)
                ->values()

        );
    }
    public function storeAjax(Request $request)
    {
        $data = $request->isJson() ? $request->json()->all() : $request->all();

        $validated = validator($data, [
            'id_curso' => ['required', 'integer', 'exists:cursos,id_curso'],
            'id_curso_salon' => ['nullable', 'integer', 'exists:curso_salon,id_curso_salon'],
            'contenido' => ['required', 'string', 'max:2000'],
            'tipo' => ['required', 'in:individual,grupo'],
            'destinatario_id' => ['nullable', 'integer', 'exists:users,id_usuario'],
        ])->validate();

        $esAlumno = Auth::guard('alumno')->check();
        $miId = $esAlumno ? Auth::guard('alumno')->id() : Auth::id();

        if (!$miId) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuario no autenticado'
            ], 401);
        }

        if ($validated['tipo'] === 'individual' && empty($validated['destinatario_id'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Selecciona un destinatario válido.'
            ], 422);
        }

        $mensajeData = [
            'id_emisor' => $miId,
            'emisor_tipo' => $esAlumno ? 'alumno' : 'user',
            'id_emisor_usuario' => $esAlumno ? null : $miId,
            'id_emisor_alumno' => $esAlumno ? $miId : null,
            'id_curso'  => $validated['id_curso'],
            'id_curso_salon' => $validated['id_curso_salon'],
            'contenido' => $validated['contenido'],
        ];

        if ($validated['tipo'] === 'individual') {
            $mensajeData['id_receptor'] = $validated['destinatario_id'];
            $mensajeData['receptor_tipo'] = 'user';
            $mensajeData['id_receptor_usuario'] = $validated['destinatario_id'];
            $mensajeData['id_receptor_alumno'] = null;
        }

        $mensaje = Message::create($mensajeData);

        return response()->json([
            'status' => 'success',
            'data'   => [
                'contenido' => $mensaje->contenido,
                'fecha'     => $mensaje->created_at->format('H:i'),
                'es_mio'    => true
            ]
        ]);
    }

    public function responder(Request $request)
    {
        $validated = $request->validate([
            'id_mensaje' => ['required', 'integer', 'exists:messages,id'],
            'contenido'  => ['required', 'string', 'max:2000'],
        ]);

        $mensajePadre = Message::find($validated['id_mensaje']);

        if (!$mensajePadre) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mensaje no encontrado.'
            ], 404);
        }

        $esAlumno = Auth::guard('alumno')->check();
        $miId = $esAlumno ? Auth::guard('alumno')->id() : Auth::id();

        if (!$miId) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuario no autenticado.'
            ], 401);
        }

        $mensajeData = [
            'id_emisor' => $miId,
            'emisor_tipo' => $esAlumno ? 'alumno' : 'user',
            'id_emisor_usuario' => $esAlumno ? null : $miId,
            'id_emisor_alumno' => $esAlumno ? $miId : null,
            'id_curso' => $mensajePadre->id_curso,
            'id_curso_salon' => $mensajePadre->id_curso_salon,
            'contenido' => $validated['contenido'],
        ];

        $mensaje = Message::create($mensajeData);

        return response()->json([
            'status' => 'success',
            'data' => [
                'contenido' => $mensaje->contenido,
                'fecha' => $mensaje->created_at->format('H:i'),
                'es_mio' => true,
            ],
        ]);
    }

    public function salonesCurso(int $id_curso)
    {
        $salones = CursoSalon::with(['salon.grado', 'salon.seccion'])
            ->where('id_curso', $id_curso)
            ->get()
            ->map(function ($item) {

                $salon = $item->salon;

                return [
                    'id_curso_salon' => $item->id_curso_salon,
                    'salon' => [
                        'grado' => optional(optional($salon)->grado)->grado ?? 'N/A',
                        'seccion' => optional(optional($salon)->seccion)->seccion ?? 'N/A'
                    ]
                ];
            });

        return response()->json($salones);
    }
    public function conversaciones(int $idSalon)
    {
        $mensajes = Message::where('id_curso_salon', $idSalon)
            ->latest()
            ->take(20)
            ->get();

        return response()->json($mensajes);
    }
    public function chat(int $id)
    {
        $mensaje = Message::find($id);

        if (!$mensaje) {
            return response()->json([]);
        }

        $mensajes = Message::with(['emisorUsuario', 'emisorAlumno'])
            ->where('id_curso_salon', $mensaje->id_curso_salon)
            ->orderBy('created_at')
            ->get()
            ->map(function ($m) {
                $emisorId = $m->emisor_tipo === 'alumno'
                    ? $m->id_emisor_alumno
                    : $m->id_emisor_usuario;

                $emisorNombre = $m->emisor_tipo === 'alumno'
                    ? trim((optional($m->emisorAlumno)->nombre ?? '') . ' ' . (optional($m->emisorAlumno)->apellido ?? ''))
                    : trim((optional($m->emisorUsuario)->nombre ?? '') . ' ' . (optional($m->emisorUsuario)->apellido ?? ''));

                return [
                    'id' => $m->id,
                    'contenido' => $m->contenido,
                    'fecha' => $m->created_at->format('H:i'),
                    'emisor' => [
                        'name' => $emisorNombre ?: 'Desconocido',
                    ],
                    'emisor_tipo' => $m->emisor_tipo,
                    'id_emisor' => $emisorId,
                ];
            });

        return response()->json($mensajes);
    }
}
