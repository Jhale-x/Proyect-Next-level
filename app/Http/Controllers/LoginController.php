<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Alumno;
use App\Models\User;
use App\Models\Apoderado;
use Illuminate\Support\Facades\Hash;

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

    // ==========================================
    // LOGIN ALUMNOS (COLEGIO / ACADEMIA)
    // ==========================================

    public function loginAlumno(Request $request)
    {
        $request->validate([
            'usuario' => 'required',
            'password' => 'required'
        ]);

        $alumno = Alumno::where('usuario', $request->usuario)->first();

        if (! $alumno) {
            return back()->with('error', 'Datos incorrectos');
        }

        $valid = Hash::check($request->password, $alumno->contraseña);
        // legacy plain text? rehash if needed

        if (! $valid && $alumno->contraseña === $request->password) {
            $valid = true;
            $alumno->contraseña = Hash::make($request->password);
            $alumno->save();
        }

        if (! $valid) {
            return back()->with('error', 'Datos incorrectos');
        }

        Auth::guard('alumno')->login($alumno);
        $request->session()->regenerate();

        // Si manejas tipo (colegio o academia)
        if ($alumno->tipo == 'colegio') {
            return redirect('/alumno/colegio');
        }

        if ($alumno->tipo == 'academia') {
            return redirect('/alumno/academia');
        }

        return redirect('/alumno');
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

        if (! $user) {
            return back()->with('error', 'Datos incorrectos');
        }

        $valid = Hash::check($request->password, $user->contrasena);
        if (! $valid && $user->contrasena === $request->password) {
            $valid = true;
            $user->contrasena = Hash::make($request->password);
            $user->save();
        }

        if (! $valid) {
            return back()->with('error', 'Datos incorrectos');
        }

        Auth::login($user);
        $request->session()->regenerate();

        $rol = strtolower($user->rol);
        if ($rol === 'administrador') {
            return redirect('/admin/pagina-institucional');
        } elseif ($rol === 'docente') {
            return redirect('/Docente/pagina_institucional');
        } elseif ($rol === 'auxiliar') {
            return redirect('/Auxiliar/pagina_institucional');
        }

        // fallback in case role is unexpected
        return back()->with('error', 'Rol desconocido');
    }

    // ==========================================
    // LOGIN FAMILIA (OPCIONAL)
    // ==========================================

    public function loginFamilia(Request $request)
    {
        $request->validate([
            'documento' => 'required'
        ]);

        // try to log in as apoderado first (guardian)
        $apoderado = Apoderado::where('dni', $request->documento)->first();
        if ($apoderado) {
            session(['apoderado_id' => $apoderado->id_apoderado]);
            // deliberately same destination as alumnos; behaviour can be extended later
            return redirect('/courses');
        }

        $user = User::where('dni', $request->documento)->first();
        if ($user) {
            session([
                'user_id' => $user->id_usuario
            ]);
            return redirect('/courses');
        }

        return back()->withErrors([
            'documento' => 'Documento no encontrado'
        ]);
    }

    // ==========================================
    // LOGOUT GENERAL
    // ==========================================

    public function logout(Request $request)
    {
        Auth::logout();
        Auth::guard('alumno')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.colegio');
    }
}
