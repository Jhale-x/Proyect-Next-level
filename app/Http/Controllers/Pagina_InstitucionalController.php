<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;
use App\Models\Alumno;
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

    public function alumnoIndex()
    {
        $anuncios = $this->anunciosPublicadosQuery()
            ->orderBy('fecha_publicacion', 'desc')
            ->get();

        return view('Alumno.pagina_institucional', compact('anuncios'));
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

    public function destroyAnuncio($id)
    {
        $anuncio = Anuncio::findOrFail($id);

        if ($anuncio->imagen) {
            Storage::disk('public')->delete($anuncio->imagen);
        }

        $anuncio->delete();

        return redirect()->route('admin.pagina_institucional')
            ->with('success', 'Anuncio eliminado correctamente.');
    }

    public function updateAnuncio(Request $request, $id)
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
