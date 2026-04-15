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
    // Mostrar el portal de selección
    public function showPortal()
    {
        return view('intranet');
    }
    
    // Mostrar formulario de login para familia/apoderados (también usado para alumnos)
    public function showColegio()
    {
        return view('auth.login_colegio');
    }
    
    // Mostrar formulario de login para academia
    public function showAcademia()
    {
        return view('auth.login_academia');
    }
    
    // Mostrar formulario de login para usuarios (admin, docente, auxiliar)
    public function showUser()
    {
        return view('auth.login_user');
    }

    // Mostrar formulario de login para alumnos (método separado si lo prefieres)
    public function showAlumnoLogin()
    {
        return view('auth.login_colegio'); // Reutiliza la misma vista
    }

    // Login de alumno
    public function loginAlumno(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string',
            'password' => 'required|string'
        ]);

        $alumno = Alumno::where('usuario', $request->usuario)->first();

        if (!$alumno) {
            return back()->with('error', 'Usuario no encontrado. Verifica tus credenciales.');
        }

        if (!Hash::check($request->password, $alumno->contrasena)) {
            return back()->with('error', 'Contraseña incorrecta.');
        }

        Auth::guard('alumno')->login($alumno);
        $request->session()->regenerate();

        return redirect()->route('alumno.pagina_institucional');
    }

    // Login para familia/apoderados
    public function loginFamilia(Request $request)
    {
        $request->validate([
            'documento' => 'required|string'
        ]);

        $apoderado = Apoderado::where('dni', $request->documento)->first();
        if ($apoderado) {
            session(['apoderado_id' => $apoderado->id_apoderado]);
            return redirect()->route('alumno.pagina_institucional');
        }

        $user = User::where('dni', $request->documento)->first();
        if ($user) {
            session(['user_id' => $user->id_usuario]);
            return redirect()->route('alumno.pagina_institucional');
        }

        return back()->withErrors(['documento' => 'Documento no encontrado']);
    }

    // Login para usuarios (admin, docente, auxiliar)
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
            return redirect('/admin/pagina-institucional');
        } elseif ($rol === 'docente') {
            return redirect()->route('docente.pagina_institucional');
        } elseif ($rol === 'auxiliar') {
            return redirect()->route('auxiliar.dashboard');
        }

        return back()->with('error', 'Rol desconocido');
    }

    // Logout general
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        Auth::guard('alumno')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.user');
    }

    // Logout específico para alumnos
    public function logoutAlumno(Request $request)
    {
        Auth::guard('alumno')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login.alumno');
    }
}