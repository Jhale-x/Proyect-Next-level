<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

/** Inicio y cierre de sesión del panel de matrículas. */
class AuthController extends Controller
{
    private const MAX_INTENTOS = 5;

    public function showLogin()
    {
        if (Auth::guard('matricula')->check()) {
            return redirect()->route('panel.index');
        }

        return view('panel.login');
    }

    public function login(Request $request)
    {
        $datos = $request->validate([
            'usuario' => 'required|string|max:50',
            'password' => 'required|string|max:255',
        ], [
            'usuario.required' => 'Escribe tu usuario.',
            'password.required' => 'Escribe tu contraseña.',
        ]);

        $clave = 'panel-login:' . Str::lower($datos['usuario']) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($clave, self::MAX_INTENTOS)) {
            $segundos = RateLimiter::availableIn($clave);
            return back()->withInput($request->only('usuario'))
                ->with('error', "Demasiados intentos. Vuelve a intentarlo en {$segundos} segundos.");
        }

        $ok = Auth::guard('matricula')->attempt(
            ['usuario' => $datos['usuario'], 'password' => $datos['password'], 'activo' => true],
            $request->boolean('recordar')
        );

        if (!$ok) {
            RateLimiter::hit($clave, 60);
            return back()->withInput($request->only('usuario'))
                ->with('error', 'Usuario o contraseña incorrectos, o la cuenta está desactivada.');
        }

        RateLimiter::clear($clave);
        $request->session()->regenerate();
        Auth::guard('matricula')->user()->forceFill(['ultimo_acceso' => now()])->save();

        return redirect()->intended(route('panel.index'));
    }

    public function logout(Request $request)
    {
        Auth::guard('matricula')->logout();
        // Solo se cierra el panel: no se invalida la sesión completa para no
        // cerrar una sesión de la intranet abierta en el mismo navegador.
        $request->session()->regenerateToken();

        return redirect()->route('panel.login')->with('success', 'Cerraste sesión correctamente.');
    }
}
