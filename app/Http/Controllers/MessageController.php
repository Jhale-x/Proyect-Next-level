<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Message;
use App\Models\Course;
use App\Models\User;
use App\Models\CursoSalon;
use App\Models\Alumno;

class MessageController extends Controller
{

    // =====================================================
    // 🔴 ADMIN SECTION
    // =====================================================

    // =====================================================
    // 🔴 ADMIN - PANTALLA PRINCIPAL (INBOX POR CURSO)
    // =====================================================
    public function adminIndex()
    {
        // Trae cursos para el panel principal
        $cursos = Course::all();

        return view('Admin.messages', compact('cursos'));
    }

    // =====================================================
    // 🔴 ADMIN - LISTA DE CONVERSACIONES POR CURSO
    // =====================================================
    public function adminInboxCurso(int $id_curso)
    {
        // Trae últimos mensajes agrupados por usuario
        return Message::with(['emisorUsuario', 'emisorAlumno'])
            ->where('id_curso', $id_curso)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($msg) {
                // agrupa por usuario que participa
                return $msg->id_emisor_usuario ?? $msg->id_emisor_alumno;
            })
            ->map(function ($mensajes, $userId) {

                $last = $mensajes->first();

                return [
                    'user_id' => $userId,
                    'curso' => $last->id_curso,
                    'nombre_usuario' => optional($last->emisorUsuario)->nombre
                        ?? optional($last->emisorAlumno)->nombre,
                    'ultimo_mensaje' => $last->contenido,
                    'fecha' => $last->created_at->format('d/m H:i'),
                ];
            })
            ->values();
    }

    // =====================================================
    // 🔴 ADMIN - CHAT COMPLETO (CONVERSACIÓN)
    // =====================================================
    public function adminChat(int $id_usuario, int $id_curso)
    {
        return Message::where('id_curso', $id_curso)
            ->where(function ($q) use ($id_usuario) {
                $q->where('id_emisor_usuario', $id_usuario)
                    ->orWhere('id_receptor_usuario', $id_usuario);
            })
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($m) {

                return [
                    'id' => $m->id,
                    'contenido' => $m->contenido,
                    'fecha' => $m->created_at->format('H:i'),
                    'emisor' => $m->id_emisor_usuario ? 'user' : 'alumno'
                ];
            });
    }

    // =====================================================
    // 🔴 ADMIN - ENVIAR MENSAJE
    // =====================================================
    public function adminSendMessage(Request $request)
    {
        Message::create([
            'id_curso' => $request->id_curso,
            'id_emisor_usuario' => Auth::user()?->id_usuario,
            'id_receptor_usuario' => $request->id_receptor,
            'contenido' => $request->contenido,
        ]);

        return response()->json(['ok' => true]);
    }

    // =====================================================
    // 🔴 ADMIN - BUSCAR USUARIOS (NUEVO MENSAJE MODAL)
    // =====================================================
    public function adminBuscarUsuarios(Request $request)
    {
        $q = $request->q;

        return User::where('nombre', 'like', "%$q%")
            ->orWhere('apellido', 'like', "%$q%")
            ->limit(10)
            ->get()
            ->map(function ($u) {
                return [
                    'id' => $u->id_usuario,
                    'nombre' => $u->nombre . ' ' . $u->apellido,
                ];
            });
    }

    public function adminCursosSalon(int $id_curso)
    {
        return $this->salonesCurso($id_curso);
    }

    public function adminConversaciones(int $idSalon)
    {
        return $this->conversaciones($idSalon);
    }


    public function adminStoreAjax(Request $request)
    {
        return $this->storeAjax($request);
    }

    public function cursosAdmin()
    {
        return Course::select('id_curso', 'materia')->get();
    }

    // =====================================================
    // 🟣 DOCENTE SECTION
    // =====================================================
    public function docenteIndex()
    {
        $user = Auth::user();

        $cursos = DB::table('cursos')
            ->join('docente_salon', 'cursos.id_curso', '=', 'docente_salon.id_curso')
            ->where('docente_salon.id_usuario', $user->id_usuario)
            ->select('cursos.*')
            ->distinct()
            ->get();

        return view('Docentes.messages', compact('cursos'));
    }

    public function docenteChat(int $id_curso)
    {
        return Message::where('id_curso', $id_curso)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function docenteInboxCurso(int $id_curso)
    {
        // Trae últimos mensajes agrupados por usuario
        return Message::with(['emisorUsuario', 'emisorAlumno'])
            ->where('id_curso', $id_curso)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($msg) {
                // agrupa por usuario que participa
                return $msg->id_emisor_usuario ?? $msg->id_emisor_alumno;
            })
            ->map(function ($mensajes, $userId) {

                $last = $mensajes->first();

                return [
                    'user_id' => $userId,
                    'curso' => $last->id_curso,
                    'nombre_usuario' => optional($last->emisorUsuario)->nombre
                        ?? optional($last->emisorAlumno)->nombre,
                    'ultimo_mensaje' => $last->contenido,
                    'fecha' => $last->created_at->format('d/m H:i'),
                ];
            })
            ->values();
    }

    public function docenteSendMessage(Request $request)
    {
        Message::create([
            'id_curso' => $request->id_curso,
            'id_emisor_usuario' => Auth::user()?->id_usuario,
            'id_receptor_usuario' => $request->id_receptor,
            'contenido' => $request->contenido,
        ]);

        return response()->json(['ok' => true]);
    }

    public function docenteBuscarUsuarios(Request $request)
    {
        $q = $request->q;

        return User::where('nombre', 'like', "%$q%")
            ->orWhere('apellido', 'like', "%$q%")
            ->limit(10)
            ->get()
            ->map(function ($u) {
                return [
                    'id' => $u->id_usuario,
                    'nombre' => $u->nombre . ' ' . $u->apellido,
                ];
            });
    }

    public function docenteCursosSalon(int $id_curso)
    {
        return $this->salonesCurso($id_curso);
    }

    public function docenteConversaciones(int $idSalon)
    {
        return $this->conversaciones($idSalon);
    }


    public function docenteStoreAjax(Request $request)
    {
        return $this->storeAjax($request);
    }

    public function cursosDocente()
    {
        return Course::select('id_curso', 'materia')->get();
    }

    // =====================================================
    // 🟠 AUXILIAR SECTION
    // =====================================================

    public function auxiliarIndex()
    {
        $user = Auth::user();

        $cursos = DB::table('cursos')
            ->join('docente_salon', 'cursos.id_curso', '=', 'docente_salon.id_curso')
            ->where('docente_salon.id_usuario', $user->id_usuario)
            ->select('cursos.*')
            ->distinct()
            ->get();

        return view('Auxiliar.messages', compact('cursos'));
    }

    public function auxiliarChat(int $id_curso)
    {
        return Message::where('id_curso', $id_curso)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function auxiliarInboxCurso(int $id_curso)
    {
        // Trae últimos mensajes agrupados por usuario
        return Message::with(['emisorUsuario', 'emisorAlumno'])
            ->where('id_curso', $id_curso)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($msg) {
                // agrupa por usuario que participa
                return $msg->id_emisor_usuario ?? $msg->id_emisor_alumno;
            })
            ->map(function ($mensajes, $userId) {

                $last = $mensajes->first();

                return [
                    'user_id' => $userId,
                    'curso' => $last->id_curso,
                    'nombre_usuario' => optional($last->emisorUsuario)->nombre
                        ?? optional($last->emisorAlumno)->nombre,
                    'ultimo_mensaje' => $last->contenido,
                    'fecha' => $last->created_at->format('d/m H:i'),
                ];
            })
            ->values();
    }

    public function auxiliarSendMessage(Request $request)
    {
        Message::create([
            'id_curso' => $request->id_curso,
            'id_emisor_usuario' => Auth::user()?->id_usuario,
            'id_receptor_usuario' => $request->id_receptor,
            'contenido' => $request->contenido,
        ]);

        return response()->json(['ok' => true]);
    }

    public function auxiliarBuscarUsuarios(Request $request)
    {
        $q = $request->q;

        return User::where('nombre', 'like', "%$q%")
            ->orWhere('apellido', 'like', "%$q%")
            ->limit(10)
            ->get()
            ->map(function ($u) {
                return [
                    'id' => $u->id_usuario,
                    'nombre' => $u->nombre . ' ' . $u->apellido,
                ];
            });
    }

    public function auxiliarCursosSalon(int $id_curso)
    {
        return $this->salonesCurso($id_curso);
    }

    public function auxiliarConversaciones(int $idSalon)
    {
        return $this->conversaciones($idSalon);
    }


    public function auxiliarStoreAjax(Request $request)
    {
        return $this->storeAjax($request);
    }

    public function cursosAuxiliar()
    {
        return Course::select('id_curso', 'materia')->get();
    }

    // =====================================================
    // 🟢 ALUMNO SECTION
    // =====================================================

    public function alumnoIndex()
    {
        $alumno = Auth::guard('alumno')->user();

        $cursos = DB::table('curso_salon')
            ->join('cursos', 'curso_salon.id_curso', '=', 'cursos.id_curso')
            ->where('curso_salon.id_salon', $alumno->id_salon)
            ->select('cursos.*')
            ->distinct()
            ->get();

        return view('Alumno.messages', compact('cursos'));
    }

    public function alumnoChat(int $id_curso)
    {
        return Message::where('id_curso', $id_curso)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function alumnoInboxCurso(int $id_curso)
    {
        // Trae últimos mensajes agrupados por usuario
        return Message::with(['emisorUsuario', 'emisorAlumno'])
            ->where('id_curso', $id_curso)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($msg) {
                // agrupa por usuario que participa
                return $msg->id_emisor_usuario ?? $msg->id_emisor_alumno;
            })
            ->map(function ($mensajes, $userId) {

                $last = $mensajes->first();

                return [
                    'user_id' => $userId,
                    'curso' => $last->id_curso,
                    'nombre_usuario' => optional($last->emisorUsuario)->nombre
                        ?? optional($last->emisorAlumno)->nombre,
                    'ultimo_mensaje' => $last->contenido,
                    'fecha' => $last->created_at->format('d/m H:i'),
                ];
            })
            ->values();
    }

    public function alumnoSendMessage(Request $request)
    {
        Message::create([
            'id_curso' => $request->id_curso,
            'id_emisor_usuario' => Auth::user()?->id_usuario,
            'id_receptor_usuario' => $request->id_receptor,
            'contenido' => $request->contenido,
        ]);

        return response()->json(['ok' => true]);
    }

    public function alumnoBuscarUsuarios(Request $request)
    {
        $q = $request->q;

        return User::where('nombre', 'like', "%$q%")
            ->orWhere('apellido', 'like', "%$q%")
            ->limit(10)
            ->get()
            ->map(function ($u) {
                return [
                    'id' => $u->id_usuario,
                    'nombre' => $u->nombre . ' ' . $u->apellido,
                ];
            });
    }

    public function alumnoCursosSalon(int $id_curso)
    {
        return $this->salonesCurso($id_curso);
    }

    public function alumnoConversaciones(int $idSalon)
    {
        return $this->conversaciones($idSalon);
    }


    public function alumnoStoreAjax(Request $request)
    {
        return $this->storeAjax($request);
    }

    public function cursosAlumno()
    {
        $alumno = Auth::guard('alumno')->user();

        return DB::table('curso_salon')
            ->join('cursos', 'curso_salon.id_curso', '=', 'cursos.id_curso')
            ->where('curso_salon.id_salon', $alumno->id_salon)
            ->select('cursos.id_curso', 'cursos.materia')
            ->distinct()
            ->get();
    }

    // =====================================================
    // 📚 CURSOS DEL ALUMNO (SIDEBAR / GRID)
    // =====================================================

    public function usuariosSalon(int $idCursoSalon)
    {
        $cursoSalon = CursoSalon::findOrFail($idCursoSalon);
        $q = request('q', '');

        $alumnos = Alumno::where('id_salon', $cursoSalon->id_salon)
            ->when($q, function ($query) use ($q) {
                return $query->where('nombre', 'like', "%$q%")
                    ->orWhere('apellido', 'like', "%$q%");
            })
            ->get()
            ->map(fn($a) => [
                'id' => $a->id_alumno,
                'nombre' => $a->nombre . ' ' . $a->apellido,
                'rol' => 'alumno',
                'tipo' => 'alumno'
            ]);

        $docentes = User::join(
            'docente_salon',
            'users.id_usuario',
            '=',
            'docente_salon.id_usuario'
        )
            ->where('docente_salon.id_salon', $cursoSalon->id_salon)
            ->where('docente_salon.id_curso', $cursoSalon->id_curso)
            ->when($q, function ($query) use ($q) {
                return $query->where('users.nombre', 'like', "%$q%")
                    ->orWhere('users.apellido', 'like', "%$q%");
            })
            ->select('users.*')
            ->get()
            ->map(fn($u) => [
                'id' => $u->id_usuario,
                'nombre' => $u->nombre . ' ' . $u->apellido,
                'rol' => $u->rol,
                'tipo' => 'user'
            ]);

        return response()->json(
            $docentes->concat($alumnos)->values()
        );
    }

    // public function cursosAlumno()
    // {
    //     $alumno = Auth::guard('alumno')->user();

    //     return DB::table('cursos as c')
    //         ->join('curso_salon as cs', 'cs.id_curso', '=', 'c.id_curso')
    //         ->where('cs.id_salon', $alumno->id_salon)
    //         ->select('c.id_curso', 'c.materia')
    //         ->distinct()
    //         ->get();
    // }
    // public function alumnoChat(int $id_curso)
    // {
    //     $alumno = auth()->guard('alumno')->user();

    //     return Message::where('id_curso', $id_curso)
    //         ->where(function ($q) use ($alumno) {
    //             $q->where('id_emisor_alumno', $alumno->id_alumno)
    //                 ->orWhere('id_receptor_alumno', $alumno->id_alumno);
    //         })
    //         ->orderBy('created_at', 'asc')
    //         ->get();
    // }

    // =====================================================
    // 💬 INBOX (CONVERSACIONES REALES)
    // =====================================================

    public function inboxAlumno()
    {
        $alumno = Auth::guard('alumno')->user();

        $mensajes = Message::where(function ($q) use ($alumno) {
            $q->where('id_emisor_alumno', $alumno->id_alumno)
                ->orWhere('id_receptor_alumno', $alumno->id_alumno);
        })
            ->whereNotNull('id_emisor_usuario')
            ->orWhereNotNull('id_receptor_usuario')
            ->orderBy('created_at', 'desc')
            ->get();

        $grouped = $mensajes->groupBy(function ($m) use ($alumno) {

            return $m->id_emisor_usuario == null
                ? $m->id_receptor_usuario
                : $m->id_emisor_usuario;
        });

        return $grouped->map(function ($msgs, $userId) {

            $last = $msgs->first();
            $user = User::find($userId);

            return [
                'id_usuario' => $userId,
                'nombre' => $user?->nombre . ' ' . $user?->apellido,
                'ultimo_mensaje' => $last->contenido,
                'fecha' => $last->created_at->format('H:i')
            ];
        })->values();
    }

    // =====================================================
    // 💬 CHAT PRIVADO (2 PERSONAS)
    // =====================================================

    public function chatPrivateAlumno(int $id_usuario)
    {
        $alumno = Auth::guard('alumno')->user();

        $mensajes = Message::where(function ($q) use ($alumno, $id_usuario) {

            $q->where('id_emisor_alumno', $alumno->id_alumno)
                ->where('id_receptor_usuario', $id_usuario);
        })
            ->orWhere(function ($q) use ($alumno, $id_usuario) {

                $q->where('id_emisor_usuario', $id_usuario)
                    ->where('id_receptor_alumno', $alumno->id_alumno);
            })
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($m) use ($alumno) {

                return [
                    'contenido' => $m->contenido,
                    'fecha' => $m->created_at->format('H:i'),
                    'es_mio' => $m->id_emisor_alumno == $alumno->id_alumno,
                    'nombre' => $m->emisor_tipo === 'alumno'
                        ? 'Yo'
                        : optional($m->emisorUsuario)->nombre
                ];
            });

        return response()->json($mensajes);
    }

    // =====================================================
    // 📤 ENVIAR MENSAJE (ALUMNO)
    // =====================================================

    public function storeAlumno(Request $request)
    {
        $alumno = Auth::guard('alumno')->user();

        $request->validate([
            'contenido' => 'required|string',
            'id_receptor_usuario' => 'required|integer',
            'id_curso' => 'nullable|integer',
        ]);

        Message::create([
            'id_emisor_alumno' => $alumno->id_alumno,
            'emisor_tipo' => 'alumno',
            'id_receptor_usuario' => $request->id_receptor_usuario,
            'id_emisor_usuario' => null,
            'contenido' => $request->contenido,
            'id_curso' => $request->id_curso,
        ]);

        return response()->json(['status' => 'success']);
    }

    // =====================================================
    // 🔥 SHARED CORE (USADO POR TODOS)
    // =====================================================

    private function buildChatQuery(\Illuminate\Database\Eloquent\Builder $query)
    {
        return $query
            ->with(['emisorUsuario', 'emisorAlumno'])
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($m) {

                $emisorId = $m->emisor_tipo === 'alumno'
                    ? $m->id_emisor_alumno
                    : $m->id_emisor_usuario;

                $nombre = $m->emisor_tipo === 'alumno'
                    ? trim(optional($m->emisorAlumno)->nombre . ' ' . optional($m->emisorAlumno)->apellido)
                    : trim(optional($m->emisorUsuario)->nombre . ' ' . optional($m->emisorUsuario)->apellido);

                return [
                    'id' => $m->id,
                    'contenido' => $m->contenido,
                    'fecha' => $m->created_at->format('H:i'),
                    'emisor' => [
                        'id' => $emisorId,
                        'name' => $nombre ?: 'Desconocido',
                        'tipo' => $m->emisor_tipo,
                    ]
                ];
            });
    }

    public function salonesCurso(int $id_curso)
    {
        return response()->json(
            CursoSalon::with(['salon.grado', 'salon.seccion'])
                ->where('id_curso', $id_curso)
                ->get()
                ->map(function ($item) {

                    return [
                        'id_curso_salon' => $item->id_curso_salon,
                        'salon' => [
                            'grado' => optional($item->salon->grado)->grado ?? 'N/A',
                            'seccion' => optional($item->salon->seccion)->seccion ?? 'N/A'
                        ]
                    ];
                })
        );
    }

    public function conversaciones(int $idSalon)
    {
        $adminId = Auth::user()->id_usuario;

        $mensajes = Message::where('id_curso_salon', $idSalon)
            ->orderByDesc('created_at')
            ->get();

        $conversaciones = [];

        foreach ($mensajes as $m) {

            if (
                $m->id_emisor_usuario == $adminId &&
                $m->id_receptor_usuario
            ) {

                $key = 'user_' . $m->id_receptor_usuario;

                if (!isset($conversaciones[$key])) {

                    $usuario = User::find($m->id_receptor_usuario);

                    $conversaciones[$key] = [
                        'id' => $usuario?->id_usuario,
                        'tipo' => 'user',
                        'nombre' => trim(
                            ($usuario?->nombre ?? '') . ' ' .
                                ($usuario?->apellido ?? '')
                        ),
                        'contenido' => $m->contenido,
                        'fecha' => $m->created_at->format('d/m H:i')
                    ];
                }
            } elseif (
                $m->id_emisor_usuario == $adminId &&
                $m->id_receptor_alumno
            ) {

                $key = 'alumno_' . $m->id_receptor_alumno;

                if (!isset($conversaciones[$key])) {

                    $alumno = Alumno::find($m->id_receptor_alumno);

                    $conversaciones[$key] = [
                        'id' => $alumno?->id_alumno,
                        'tipo' => 'alumno',
                        'nombre' => trim(
                            ($alumno?->nombre ?? '') . ' ' .
                                ($alumno?->apellido ?? '')
                        ),
                        'contenido' => $m->contenido,
                        'fecha' => $m->created_at->format('d/m H:i')
                    ];
                }
            } elseif (
                $m->id_receptor_usuario == $adminId &&
                $m->id_emisor_usuario
            ) {

                $key = 'user_' . $m->id_emisor_usuario;

                if (!isset($conversaciones[$key])) {

                    $usuario = User::find($m->id_emisor_usuario);

                    $conversaciones[$key] = [
                        'id' => $usuario?->id_usuario,
                        'tipo' => 'user',
                        'nombre' => trim(
                            ($usuario?->nombre ?? '') . ' ' .
                                ($usuario?->apellido ?? '')
                        ),
                        'contenido' => $m->contenido,
                        'fecha' => $m->created_at->format('d/m H:i')
                    ];
                }
            } elseif (
                $m->id_receptor_usuario == $adminId &&
                $m->id_emisor_alumno
            ) {

                $key = 'alumno_' . $m->id_emisor_alumno;

                if (!isset($conversaciones[$key])) {

                    $alumno = Alumno::find($m->id_emisor_alumno);

                    $conversaciones[$key] = [
                        'id' => $alumno?->id_alumno,
                        'tipo' => 'alumno',
                        'nombre' => trim(
                            ($alumno?->nombre ?? '') . ' ' .
                                ($alumno?->apellido ?? '')
                        ),
                        'contenido' => $m->contenido,
                        'fecha' => $m->created_at->format('d/m H:i')
                    ];
                }
            }
        }

        return response()->json(array_values($conversaciones));
    }

    public function chat(
        Request $request,
        int $idCursoSalon
    ) {
        $admin = Auth::user();

        $tipo = $request->tipo;
        $idUsuario = $request->usuario;

        $query = Message::where(
            'id_curso_salon',
            $idCursoSalon
        );

        if ($tipo === 'alumno') {

            $query->where(function ($q) use ($admin, $idUsuario) {

                $q->where(function ($sub) use ($admin, $idUsuario) {

                    $sub->where('id_emisor_usuario', $admin->id_usuario)
                        ->where('id_receptor_alumno', $idUsuario);
                })->orWhere(function ($sub) use ($admin, $idUsuario) {

                    $sub->where('id_emisor_alumno', $idUsuario)
                        ->where('id_receptor_usuario', $admin->id_usuario);
                });
            });
        } else {

            $query->where(function ($q) use ($admin, $idUsuario) {

                $q->where(function ($sub) use ($admin, $idUsuario) {

                    $sub->where('id_emisor_usuario', $admin->id_usuario)
                        ->where('id_receptor_usuario', $idUsuario);
                })->orWhere(function ($sub) use ($admin, $idUsuario) {

                    $sub->where('id_emisor_usuario', $idUsuario)
                        ->where('id_receptor_usuario', $admin->id_usuario);
                });
            });
        }

        return response()->json(
            $this->buildChatQuery($query)
        );
    }
    public function buscarUsuarios(Request $request)
    {
        $q = $request->q ?? '';

        $cursoSalon = CursoSalon::find($request->id_curso_salon);
        if (!$cursoSalon) return response()->json([]);

        $idSalon = $cursoSalon->id_salon;

        $alumnos = Alumno::where('id_salon', $idSalon)
            ->where(function ($q2) use ($q) {
                $q2->where('nombre', 'like', "%$q%")
                    ->orWhere('apellido', 'like', "%$q%");
            })
            ->limit(10)
            ->get()
            ->map(fn($a) => [
                'id' => $a->id_alumno,
                'nombre' => $a->nombre . ' ' . $a->apellido,
                'role' => 'alumno'
            ]);

        $docentes = User::where('rol', 'docente')
            ->where(function ($q2) use ($q) {
                $q2->where('nombre', 'like', "%$q%")
                    ->orWhere('apellido', 'like', "%$q%");
            })
            ->limit(10)
            ->get()
            ->map(fn($u) => [
                'id' => $u->id_usuario,
                'name' => $u->nombre . ' ' . $u->apellido,
                'role' => 'docente'
            ]);

        return $alumnos->merge($docentes)->values();
    }

    public function storeAjax(Request $request)
    {
        $validated = $request->validate([
            'id_curso' => 'required|integer',
            'id_curso_salon' => 'nullable|integer',
            'contenido' => 'required|string|max:2000',
            'tipo' => 'required|in:individual,grupo',
            'destinatario_id' => 'nullable|integer',
        ]);

        $user = Auth::user();
        $alumno = Auth::guard('alumno')->user();

        $miId = $alumno ? $alumno->id_alumno : $user->id_usuario;
        $miTipo = $alumno ? 'alumno' : 'user';

        $msg = [
            'id_emisor' => $miId,
            'emisor_tipo' => $miTipo,
            'id_emisor_usuario' => $alumno ? null : $miId,
            'id_emisor_alumno' => $alumno ? $miId : null,
            'id_curso' => $validated['id_curso'],
            'id_curso_salon' => $validated['id_curso_salon'],
            'contenido' => $validated['contenido'],
        ];

        if ($validated['tipo'] === 'individual') {
            $msg['id_receptor'] = $validated['destinatario_id'];
            $msg['receptor_tipo'] = 'user';
            $msg['id_receptor_usuario'] = $validated['destinatario_id'];
        }

        Message::create($msg);

        return response()->json(['status' => 'success']);
    }

    public function iniciarConversacion(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|integer',
            'tipo' => 'required|in:user,alumno',
            'id_curso_salon' => 'required|integer'
        ]);

        return response()->json([
            'success' => true,
            'id_usuario' => $request->id_usuario,
            'tipo' => $request->tipo
        ]);
    }
    public function responder(Request $request)
    {
        $request->validate([
            'id_usuario'      => 'required|integer',
            'tipo'            => 'required|in:user,alumno',
            'id_curso'        => 'required|integer',
            'id_curso_salon'  => 'required|integer',
            'contenido'       => 'required|string|max:2000'
        ]);

        $admin = Auth::user();

        $data = [
            'id_emisor'          => $admin->id_usuario,
            'emisor_tipo'        => 'user',
            'id_emisor_usuario'  => $admin->id_usuario,
            'id_emisor_alumno'   => null,

            'id_curso'           => $request->id_curso,
            'id_curso_salon'     => $request->id_curso_salon,
            'contenido'          => $request->contenido,
        ];

        if ($request->tipo === 'alumno') {

            $data['id_receptor'] = $request->id_usuario;
            $data['receptor_tipo'] = 'alumno';
            $data['id_receptor_alumno'] = $request->id_usuario;
            $data['id_receptor_usuario'] = null;
        } else {

            $data['id_receptor'] = $request->id_usuario;
            $data['receptor_tipo'] = 'user';
            $data['id_receptor_usuario'] = $request->id_usuario;
            $data['id_receptor_alumno'] = null;
        }

        $mensaje = Message::create($data);

        return response()->json([
            'success' => true,
            'message_id' => $mensaje->id
        ]);
    }

    public function responderAlumno(Request $request)
    {
        $request->validate([
            'id_usuario'      => 'required|integer',
            'tipo'            => 'required|in:user,alumno',
            'id_curso'        => 'required|integer',
            'id_curso_salon'  => 'required|integer',
            'contenido'       => 'required|string|max:2000'
        ]);

        $alumno = Auth::guard('alumno')->user();

        $data = [
            'id_emisor'         => $alumno->id_alumno,
            'emisor_tipo'       => 'alumno',

            'id_emisor_usuario' => null,
            'id_emisor_alumno'  => $alumno->id_alumno,

            'id_curso'          => $request->id_curso,
            'id_curso_salon'    => $request->id_curso_salon,
            'contenido'         => $request->contenido,
        ];

        if ($request->tipo === 'alumno') {

            $data['id_receptor'] = $request->id_usuario;
            $data['receptor_tipo'] = 'alumno';
            $data['id_receptor_alumno'] = $request->id_usuario;
            $data['id_receptor_usuario'] = null;
        } else {

            $data['id_receptor'] = $request->id_usuario;
            $data['receptor_tipo'] = 'user';
            $data['id_receptor_usuario'] = $request->id_usuario;
            $data['id_receptor_alumno'] = null;
        }

        $mensaje = Message::create($data);

        return response()->json([
            'success' => true,
            'message_id' => $mensaje->id_mensaje
        ]);
    }
}
