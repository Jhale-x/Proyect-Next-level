<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;
use Illuminate\Support\Facades\Storage;

class Pagina_InstitucionalController extends Controller
{
    public function index()
    {
        // Public page with active announcements
        $anuncios = Anuncio::where('estado', 'activo')
            ->orderBy('fecha_publicacion', 'desc')
            ->get();

        return view('pagina_institucional', compact('anuncios'));
    }

    public function adminIndex()
    {
        // View for admin to manage anuncios and other content
        $recientes = Anuncio::with('user')
            ->orderBy('fecha_publicacion', 'desc')
            ->take(3)
            ->get();
        $historial = Anuncio::with('user')->orderBy('fecha_publicacion', 'desc')->get();

        return view('Admin.pagina_institucional', [
            'recientes' => $recientes,
            'historial'  => $historial,
        ]);
    }

    /**
     * Store a newly created anuncio from the admin form.
     */
    public function storeAnuncio(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'contenido' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048',
            'fecha_publicacion' => 'required|date',
            'estado' => 'required|in:activo,inactivo,programado',
        ]);

        // associate with authenticated user if available
        if ($request->user()) {
            $validated['id_usuario'] = $request->user()->id_usuario;
        }

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('anuncios', 'public');
            $validated['imagen'] = $path;
        }

        Anuncio::create($validated);

        return redirect()->route('admin.pagina_institucional')
            ->with('success', 'Anuncio publicado correctamente.');
    }

    public function alumnoIndex()
    {
        // Vista para alumnos autenticados
        return view('Alumno.pagina_institucional');
    }
}
