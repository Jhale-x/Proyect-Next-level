<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;
use Illuminate\Support\Facades\Auth;
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
        return view('pagina_institucional');
    }

    public function docenteIndex()
    {
        $anuncios = Anuncio::where('estado', 'activo')
            ->orderBy('fecha_publicacion', 'desc')
            ->get();

        return view('Docentes.pagina_institucional', compact('anuncios'));
    }

    public function adminIndex()
    {
        $recientes = Anuncio::with('user')
            ->orderBy('fecha_publicacion', 'desc')
            ->take(3)
            ->get();

        $historial = Anuncio::with('user')
            ->orderBy('fecha_publicacion', 'desc')
            ->get();

        return view('Admin.pagina_institucional', [
            'recientes' => $recientes,
            'historial' => $historial,
        ]);
    }

    public function alumnoIndex()
    {
        $anuncios = Anuncio::where('estado', 'activo')
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
            'fecha_publicacion' => 'required|date',
            'estado'            => 'required|in:activo,inactivo,programado',
        ]);

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
}
