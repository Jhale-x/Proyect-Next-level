<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Alumno;
use App\Models\User;
use App\Models\Apoderado;

class LoginController extends Controller
{
    // ==========================================
    // VISTAS
    // ==========================================

    public function showColegio()
    {
        return view('auth.login_colegio');
    }
    public function showAcademia()
    {
        return view('auth.login_academia');
    }
    public function showUser()
    {
        return view('auth.login_user');
    }
    public function showApoderado()
    {
        return view('auth.login_colegio');
    }

    // ==========================================
    // LOGIN ALUMNOS (COLEGIO / ACADEMIA)
    // ==========================================

    public function loginAlumno(Request $request)
    {
        $request->validate([
            'usuario' => 'required',
            'password' => 'required'
        ]);

        // Buscamos al alumno por su usuario
        $alumno = Alumno::where('usuario', $request->usuario)->first();

        if (!$alumno) {
            return back()->with('error', 'Datos incorrectos: El usuario no existe.');
        }

        // 1. Verificamos si la contraseÃ±a coincide usando Hash
        // Nota: Se usa 'contrasena' sin Ã‘ porque asÃ­ sale en tu captura de phpMyAdmin
        $valid = Hash::check($request->password, $alumno->contrasena);

        // 2. SOPORTE PARA TEXTO PLANO
        // Si el hash falla, probamos comparaciÃ³n directa (por si editaste la BD a mano)
        if (!$valid && $alumno->contrasena === $request->password) {
            $valid = true;
            // Aprovechamos para encriptarla correctamente ahora mismo
            $alumno->contrasena = Hash::make($request->password);
            $alumno->save();
        }

        if (!$valid) {
            return back()->with('error', 'Datos incorrectos: ContraseÃ±a no vÃ¡lida.');
        }

        // Autenticamos en el guard especÃ­fico de alumno
        Auth::guard('alumno')->login($alumno);
        $request->session()->regenerate();

        // REDIRECCIÃ“N: Eliminada la lÃ³gica de 'tipo' porque la columna no existe en tu BD
        return redirect()->route('alumno.pagina_institucional');
    }

    // ==========================================
    // LOGIN USERS (ADMIN / DOCENTE / AUXILIAR)
    // ==========================================

    public function loginUser(Request $request)
    {
        $request->validate([
            'usuario' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('usuario', $request->usuario)->first();

        if (!$user) {
            return back()->with('error', 'Datos incorrectos');
        }

        $valid = Hash::check($request->password, $user->contrasena);

        if (!$valid && $user->contrasena === $request->password) {
            $valid = true;
            $user->contrasena = Hash::make($request->password);
            $user->save();
        }

        if (!$valid) {
            return back()->with('error', 'Datos incorrectos');
        }

        Auth::login($user);
        $request->session()->regenerate();

        $rol = strtolower($user->rol);
        if ($rol === 'administrador') {
            return redirect('/admin/dashboard');
        } elseif ($rol === 'docente') {
            return redirect()->route('docente.pagina_institucional');
        } elseif ($rol === 'auxiliar') {
            return redirect()->route('auxiliar.pagina_institucional');
        }

        return back()->with('error', 'Rol desconocido');
    }

    // ==========================================
    // LOGIN FAMILIA
    // ==========================================

    public function loginFamilia(Request $request)
    {
        $request->validate([
            'documento' => 'required'
        ]);

        $apoderado = Apoderado::where('dni', $request->documento)->first();

        if (!$apoderado) {
            return back()->withErrors(['documento' => 'Documento no encontrado']);
        }

        Auth::guard('apoderado')->login($apoderado);

        $request->session()->regenerate();

        return redirect()->route('apoderado.pagina_institucional');
    }

    // ==========================================
    // LOGOUT GENERAL
    // ==========================================

    public function logout(Request $request)
    {
        // 1. Cerramos sesiÃ³n en todos los guards
        Auth::guard('web')->logout();
        Auth::guard('alumno')->logout();

        // 2. Limpiamos la sesiÃ³n y el token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 3. REDIRECCIÃ“N AL PORTAL (La vista de los hexÃ¡gonos)
        return redirect()->route('portal');
    }
}
