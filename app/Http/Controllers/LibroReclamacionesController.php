<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reclamacion;
use Illuminate\Support\Facades\Session;

class LibroReclamacionesController extends Controller
{
    public function index()
    {
        return view('libro_reclamaciones');
    }

    public function generarCaptcha()
    {
        $a = rand(1, 9);
        $b = rand(1, 9);
        Session::put('captcha_result', $a + $b);

        return response()->json([
            'pregunta' => "¿Cuánto es $a + $b?"
        ]);
    }

    public function submit(Request $request)
    {
        if ($request->captcha_input != Session::get('captcha_result')) {
            return back()->withErrors(['captcha' => 'La suma es incorrecta.'])->withInput();
        }

        $validated = $request->validate([
            'sede' => 'required',
            'nivel' => 'required',
            'nombres' => 'required|string|max:255',
            'dni' => 'required|digits:8',
            'celular' => 'required|string',
            'correo' => 'required|email',
            'direccion' => 'nullable|string',
            'monto' => 'nullable|numeric',
            'descripcion' => 'nullable|string',
            'tipo' => 'required|in:Reclamo,Queja',
            'detalle' => 'required|string',
            'pedido' => 'required|string',
            'declaracion' => 'accepted',
            'genero' => 'required|in:M,F',
            'grado' => 'nullable',
        ]);

        // Grado null for academia
        if ($request->nivel === 'ACADEMIA') {
            $validated['grado'] = null;
        }

        Reclamacion::create($validated);

        Session::forget('captcha_result');

        return back()->with('success', 'Reclamación enviada correctamente.');
    }
}

