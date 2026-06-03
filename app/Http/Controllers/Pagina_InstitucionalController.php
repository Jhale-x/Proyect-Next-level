<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;
use App\Models\Alumno;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Pagina_InstitucionalController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $rol = strtolower(Auth::user()->rol);
            if ($rol === 'docente') {
                return redirect()->route('docente.pagina_institucional');
            } elseif ($rol === 'administrador') {
                return redirect()->route('admin.pagina_institucional');
            } elseif ($rol === 'auxiliar') {
                return redirect()->route('auxiliar.pagina_institucional');
            }
        }

        if (Auth::guard('alumno')->check()) {
            return redirect()->route('alumno.pagina_institucional');
        }

        $anuncios = $this->anunciosPublicadosQuery()
            ->orderBy('fecha_publicacion', 'desc')
            ->get();

        return view('pagina_institucional', compact('anuncios'));
    }

    public function docenteIndex()
    {
        $anuncios = $this->anunciosPublicadosQuery()
            ->orderBy('fecha_publicacion', 'desc')
            ->get();

        return view('Docentes.pagina_institucional', compact('anuncios'));
    }

    public function docenteDashboard()
    {
        $user = Auth::user();

        $cursoIds = DB::table('docente_salon')
            ->where('id_usuario', $user->id_usuario)
            ->distinct()
            ->pluck('id_curso');

        $cursosAsignados = Course::whereIn('id_curso', $cursoIds)->get();
        $cantidadCursos = $cursosAsignados->count();

        $cantidadSalones = DB::table('docente_salon')
            ->where('id_usuario', $user->id_usuario)
            ->distinct()
            ->count('id_salon');

        $cantidadAlumnos = DB::table('alumnos')
            ->join('docente_salon', 'alumnos.id_salon', '=', 'docente_salon.id_salon')
            ->where('docente_salon.id_usuario', $user->id_usuario)
            ->distinct()
            ->count('alumnos.id_alumno');

        $cantidadActividades = DB::table('curso_actividades')
            ->whereIn('id_curso', $cursoIds)
            ->count();

        $cantidadMensajes = DB::table('messages')
            ->where(function ($query) use ($user) {
                $query->where('id_emisor_usuario', $user->id_usuario)
                    ->orWhere('id_receptor_usuario', $user->id_usuario);
            })
            ->count();

        $ultimasActividades = DB::table('curso_actividades as ca')
            ->join('actividades as a', 'ca.id_actividad', '=', 'a.id_actividad')
            ->join('cursos as c', 'ca.id_curso', '=', 'c.id_curso')
            ->whereIn('ca.id_curso', $cursoIds)
            ->select('a.actividad', 'c.materia', 'ca.fecha_entrega', 'ca.created_at')
            ->orderBy('ca.created_at', 'desc')
            ->limit(5)
            ->get();

        return view('Docentes.dashboard', compact(
            'cantidadCursos',
            'cantidadSalones',
            'cantidadAlumnos',
            'cantidadActividades',
            'cantidadMensajes',
            'ultimasActividades',
            'cursosAsignados'
        ));
    }

    public function adminIndex()
    {
        // 📊 Usuarios del sistema
        $totalUsuariosSistema = User::count();
        $totalAlumnos = Alumno::count();
        $totalUsuarios = $totalUsuariosSistema + $totalAlumnos;

        $admins = User::where('rol', 'administrador')->count();
        $docentes = User::where('rol', 'docente')->count();
        $auxiliares = User::where('rol', 'auxiliar')->count();

        $usuariosRecientes = User::orderBy('created_at', 'desc')->take(5)->get();

        // 🎓 ALUMNOS POR TIPO (según tu BD real)
        $alumnos = $totalAlumnos;

        $academia = DB::table('alumnos')
            ->join('salones', 'alumnos.id_salon', '=', 'salones.id_salon')
            ->join('niveles', 'salones.id_nivel', '=', 'niveles.id_nivel')
            ->whereRaw('LOWER(niveles.nivel) LIKE ?', ['%academia%'])
            ->count();

        $colegio = DB::table('alumnos')
            ->join('salones', 'alumnos.id_salon', '=', 'salones.id_salon')
            ->join('niveles', 'salones.id_nivel', '=', 'niveles.id_nivel')
            ->whereIn(DB::raw('LOWER(niveles.nivel)'), ['inicial', 'primaria', 'secundaria'])
            ->count();

        // 📰 Anuncios
        $recientes = Anuncio::with('user')
            ->orderBy('fecha_publicacion', 'desc')
            ->take(3)
            ->get();

        $historial = Anuncio::with('user')
            ->orderBy('fecha_publicacion', 'desc')
            ->get();

        return view('Admin.pagina_institucional', [
            'totalUsuarios' => $totalUsuarios,
            'admins' => $admins,
            'docentes' => $docentes,
            'auxiliares' => $auxiliares,
            'alumnos' => $alumnos,       // 🔥 IMPORTANTE (antes no estaba)
            'academia' => $academia,
            'colegio' => $colegio,
            'usuariosRecientes' => $usuariosRecientes,
            'recientes' => $recientes,
            'historial' => $historial,
        ]);
    }

    public function adminDashboard()
    {
        $totalUsuariosSistema = User::count();
        $totalAlumnos = Alumno::count();
        $totalUsuarios = $totalUsuariosSistema + $totalAlumnos;

        $admins = User::where('rol', 'administrador')->count();
        $docentes = User::where('rol', 'docente')->count();
        $auxiliares = User::where('rol', 'auxiliar')->count();

        $usuariosRecientes = User::orderBy('created_at', 'desc')->take(5)->get();

        $academia = DB::table('alumnos')
            ->join('salones', 'alumnos.id_salon', '=', 'salones.id_salon')
            ->join('niveles', 'salones.id_nivel', '=', 'niveles.id_nivel')
            ->whereRaw('LOWER(niveles.nivel) LIKE ?', ['%academia%'])
            ->count();

        $colegio = DB::table('alumnos')
            ->join('salones', 'alumnos.id_salon', '=', 'salones.id_salon')
            ->join('niveles', 'salones.id_nivel', '=', 'niveles.id_nivel')
            ->whereIn(DB::raw('LOWER(niveles.nivel)'), ['inicial', 'primaria', 'secundaria'])
            ->count();

        $cursosCount = DB::table('cursos')->count();

        $cursosActivosCount = DB::table('cursos as c')
            ->join('curso_salon as cs', 'c.id_curso', '=', 'cs.id_curso')
            ->distinct('c.id_curso')
            ->count('c.id_curso');

        $mensajesCount = DB::table('messages')->count();

        $recentUsersCount = User::where('created_at', '>=', now()->subDays(30))->count()
            + Alumno::where('created_at', '>=', now()->subDays(30))->count();

        $activeUsersPercent = $totalUsuarios > 0
            ? round(($recentUsersCount * 100) / $totalUsuarios)
            : 0;

        $actividadReciente = DB::table('curso_actividades as ca')
            ->join('actividades as a', 'ca.id_actividad', '=', 'a.id_actividad')
            ->join('cursos as c', 'ca.id_curso', '=', 'c.id_curso')
            ->select(
                'a.actividad as titulo',
                'a.descripcion',
                'c.materia as curso',
                'ca.fecha_entrega',
                'ca.created_at'
            )
            ->orderBy('ca.created_at', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($item) {
                return [
                    'titulo' => $item->titulo,
                    'descripcion' => $item->descripcion ?: "Curso: {$item->curso}",
                    'curso' => $item->curso,
                    'fecha_entrega' => $item->fecha_entrega,
                    'creado' => \Carbon\Carbon::parse($item->created_at)->diffForHumans(),
                ];
            });

        return view('Admin.dashboard', [
            'totalUsuarios' => $totalUsuarios,
            'admins' => $admins,
            'docentes' => $docentes,
            'auxiliares' => $auxiliares,
            'alumnos' => $totalAlumnos,
            'academia' => $academia,
            'colegio' => $colegio,
            'usuariosRecientes' => $usuariosRecientes,
            'cursos' => $cursosCount,
            'cursosActivos' => $cursosActivosCount,
            'mensajes' => $mensajesCount,
            'usuariosActivosPercent' => $activeUsersPercent,
            'actividadReciente' => $actividadReciente,
        ]);
    }
    public function auxiliarIndex()
    {
        $anuncios = $this->anunciosPublicadosQuery()
            ->orderBy('fecha_publicacion', 'desc')
            ->get();

        return view('auxiliar.pagina_institucional', compact('anuncios'));
    }

    public function alumnoIndex()
    {
        $anuncios = $this->anunciosPublicadosQuery()
            ->orderBy('fecha_publicacion', 'desc')
            ->get();

        $actividades = collect();

        if (Auth::guard('alumno')->check()) {
            $alumno = Auth::guard('alumno')->user();
            $cursoIds = DB::table('curso_salon')
                ->where('id_salon', $alumno->id_salon)
                ->pluck('id_curso');

            if ($cursoIds->isNotEmpty()) {
                $actividades = DB::table('curso_actividades as ca')
                    ->join('actividades as a', 'a.id_actividad', '=', 'ca.id_actividad')
                    ->join('cursos as c', 'c.id_curso', '=', 'ca.id_curso')
                    ->whereIn('ca.id_curso', $cursoIds)
                    ->select(
                        'ca.id_curso_actividad',
                        'a.actividad as titulo',
                        'a.descripcion',
                        'ca.fecha_entrega',
                        'ca.hora_entrega',
                        DB::raw("c.materia as curso")
                    )
                    ->orderBy('ca.fecha_entrega', 'desc')
                    ->get();
            }
        }

        return view('Alumno.pagina_institucional', compact('anuncios', 'actividades'));
    }

    public function apoderadoIndex()
    {
        $anuncios = $this->anunciosPublicadosQuery()
            ->orderBy('fecha_publicacion', 'desc')
            ->get();

        $actividades = collect();

        if (Auth::guard('alumno')->check()) {
            $alumno = Auth::guard('alumno')->user();
            $cursoIds = DB::table('curso_salon')
                ->where('id_salon', $alumno->id_salon)
                ->pluck('id_curso');

            if ($cursoIds->isNotEmpty()) {
                $actividades = DB::table('curso_actividades as ca')
                    ->join('actividades as a', 'a.id_actividad', '=', 'ca.id_actividad')
                    ->join('cursos as c', 'c.id_curso', '=', 'ca.id_curso')
                    ->whereIn('ca.id_curso', $cursoIds)
                    ->select(
                        'ca.id_curso_actividad',
                        'a.actividad as titulo',
                        'a.descripcion',
                        'ca.fecha_entrega',
                        'ca.hora_entrega',
                        DB::raw("c.materia as curso")
                    )
                    ->orderBy('ca.fecha_entrega', 'desc')
                    ->get();
            }
        }

        return view('Apoderado.pagina_institucional', compact('anuncios', 'actividades'));
    }

    public function storeAnuncio(Request $request)
    {
        $validated = $request->validate([
            'titulo'            => 'required|string|max:255',
            'descripcion'       => 'required|string',
            'contenido'         => 'nullable|string',
            'imagen'            => 'nullable|image|max:2048',
            'estado'            => 'required|in:activo,inactivo,programado',
        ]);

        // La fecha de publicación se maneja automáticamente desde el servidor.
        $validated['fecha_publicacion'] = now()->toDateString();

        if (Auth::check()) {
            $validated['id_usuario'] = Auth::user()->id_usuario;
        }

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('anuncios', 'public');
            $validated['imagen'] = $path;
        }

        Anuncio::create($validated);

        return redirect()->route('admin.pagina_institucional')
            ->with('success', 'Anuncio publicado correctamente.');
    }

    public function destroyAnuncio(int $id)
    {
        $anuncio = Anuncio::findOrFail($id);

        if ($anuncio->imagen) {
            Storage::disk('public')->delete($anuncio->imagen);
        }

        $anuncio->delete();

        return redirect()->route('admin.pagina_institucional')
            ->with('success', 'Anuncio eliminado correctamente.');
    }

    public function updateAnuncio(Request $request, int $id)
    {
        $anuncio = Anuncio::findOrFail($id);

        $validated = $request->validate([
            'titulo'      => 'required|string|max:255',
            'descripcion' => 'required|string',
            'contenido'   => 'nullable|string',
            'imagen'      => 'nullable|image|max:2048',
            'estado'      => 'required|in:activo,inactivo,programado',
        ]);

        if ($request->hasFile('imagen')) {
            if ($anuncio->imagen) {
                Storage::disk('public')->delete($anuncio->imagen);
            }

            $validated['imagen'] = $request->file('imagen')->store('anuncios', 'public');
        }

        $anuncio->update($validated);

        return redirect()->route('admin.pagina_institucional')
            ->with('success', 'Anuncio actualizado correctamente.');
    }

    private function anunciosPublicadosQuery()
    {
        return Anuncio::where(function ($query) {
            $query->where('estado', 'activo')
                ->orWhere(function ($subquery) {
                    $subquery->where('estado', 'programado')
                        ->where('fecha_publicacion', '<=', now());
                });
        });
    }
}
