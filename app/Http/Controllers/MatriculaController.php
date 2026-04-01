<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MatriculaController extends Controller
{
    public function index()
    {
        return view('matricula'); 
    }

    public function mostrarFormulario()
    {
        // Recuperamos los datos que guardamos en la sesión tras validar el DNI
        $datos = session('alumno_datos');

        if (!$datos) {
            return redirect()->route('matricula')->with('error', 'Debe validar su DNI primero.');
        }

        return view('matricula_formulario', compact('datos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'documento' => 'required|numeric|digits:8',
            'codigo'    => 'required|numeric|digits:1',
        ]);

        $dni = $request->input('documento');
        $codigoUsuario = $request->input('codigo');
        
        // Llamamos al token desde el archivo .env
        $token = env('APIS_PERU_TOKEN');

        try {
            // La URL queda más limpia usando la variable
            $url = "https://dniruc.apisperu.com/api/v1/dni/{$dni}?token={$token}";

            $response = Http::timeout(10)->get($url);
            $datos = $response->json();

            if ($response->successful() && isset($datos['success']) && $datos['success']) {
                $cvReal = $datos['codVerifica'] ?? $datos['codigo_verificacion'] ?? null;

                if ($cvReal !== null && $codigoUsuario == $cvReal) {
                    session(['alumno_datos' => $datos]);
                    return redirect()->route('matricula.formulario');
                } else {
                    return redirect()->back()
                        ->with('error', 'El código de verificación (CV) es incorrecto.')
                        ->withInput();
                }
            }

            return redirect()->back()
                ->with('error', 'DNI no encontrado o error en APIs PERU.')
                ->withInput();

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error de conexión: ' . $e->getMessage());
        }
    }
}