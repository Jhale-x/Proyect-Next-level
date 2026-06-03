<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login.user')->with('error', 'Debes iniciar sesión.');
        }

        $userRol = strtolower(trim(Auth::user()->rol));
        $roleExpected = strtolower(trim($role));

        // Si la ruta requiere rol 'docente', permitir también 'auxiliar'
        if ($roleExpected === 'docente' && ($userRol === 'docente' || $userRol === 'auxiliar')) {
            return $next($request);
        }

        // Comparación normal para otros roles
        if ($userRol !== $roleExpected) {
            // Redirigir según el rol real
            if ($userRol === 'administrador') {
                return redirect()->route('admin.pagina_institucional');
            } elseif ($userRol === 'docente') {
                return redirect()->route('docente.pagina_institucional');
            } elseif ($userRol === 'auxiliar') {
                return redirect()->route('auxiliar.dashboard');
            }
            abort(403, 'No tienes permiso.');
        }

        return $next($request);
    }
}