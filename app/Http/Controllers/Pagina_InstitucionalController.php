<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;
use App\Models\Alumno;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
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
        $totalUsuariosSistema = User::count();
        $totalAlumnos = Alumno::count();
        $totalUsuarios = $totalUsuariosSistema + $totalAlumnos;
        $admins = User::where('rol', 'administrador')->count();
        $docentes = User::where('rol', 'docente')->count();
        $auxiliares = User::where('rol', 'auxiliar')->count();
        $usuariosRecientes = User::orderBy('created_at', 'desc')->take(5)->get();

        $academia = 0;
        $colegio = 0;

        if (Schema::hasColumn('alumnos', 'tipo')) {
            $academia = Alumno::where('tipo', 'academia')->count();
            $colegio = Alumno::where('tipo', 'colegio')->count();
        } elseif (
            Schema::hasTable('salones')
            && Schema::hasTable('niveles')
            && Schema::hasColumn('alumnos', 'id_salon')
            && Schema::hasColumn('niveles', 'nivel')
        ) {
            $academia = DB::table('alumnos')
                ->join('salones', 'alumnos.id_salon', '=', 'salones.id_salon')
                ->join('niveles', 'salones.id_nivel', '=', 'niveles.id_nivel')
                ->whereRaw('LOWER(niveles.nivel) LIKE ?', ['%academia%'])
                ->count();

            $colegio = DB::table('alumnos')
                ->join('salones', 'alumnos.id_salon', '=', 'salones.id_salon')
                ->join('niveles', 'salones.id_nivel', '=', 'niveles.id_nivel')
                ->whereRaw('LOWER(niveles.nivel) LIKE ?', ['%colegio%'])
                ->count();
        }

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
            'fecha_publicacion' => 'required|date_format:Y-m-d\TH:i',
            'estado'            => 'required|in:activo,inactivo,programado',
        ]);

        $validated['fecha_publicacion'] = Carbon::createFromFormat('Y-m-d\TH:i', $validated['fecha_publicacion']);

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
