<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/** Solo deja pasar al personal del panel de matrículas con la cuenta activa. */
class PanelMatricula
{
    public function handle(Request $request, Closure $next): Response
    {
        $guard = Auth::guard('matricula');

        if (!$guard->check()) {
            return redirect()->guest(route('panel.login'))->with('error', 'Inicia sesión para entrar al panel.');
        }

        if (!$guard->user()->activo) {
            $guard->logout();
            return redirect()->route('panel.login')->with('error', 'Tu cuenta está desactivada. Comunícate con la dirección.');
        }

        return $next($request);
    }
}
