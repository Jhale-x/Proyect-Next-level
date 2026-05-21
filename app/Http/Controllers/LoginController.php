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
    
    // Mostrar formulario de login para familia/apoderados
    public function showColegio()
    {
        return view('auth.login_colegio');
    }
    
    public function showAcademia()
    {
        return view('auth.login_academia');
    }
    
    // Mostrar formulario de login para usuarios (admin, docente, auxiliar)
    public function showUser()
    {
        return view('auth.login_user');
    }

    public function showAlumnoLogin()
    {
        return view('auth.login_colegio');
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
        // Validar
        $request->validate([
            'usuario' => 'required',
            'password' => 'required',
            'rol_esperado' => 'required|in:administrador,docente,auxiliar'
        ]);

        // Buscar usuario
        $user = User::where('usuario', $request->usuario)->first();

        if (!$user) {
            return back()->with('error', '❌ Usuario no encontrado.');
        }

        // *** NUEVA LÓGICA: El panel de docente acepta docente y auxiliar ***
        if ($request->rol_esperado === 'docente') {
            // Permitir solo docente o auxiliar (NO administrador)
            if ($user->rol !== 'docente' && $user->rol !== 'auxiliar') {
                return back()->with('error', '❌ Esta cuenta no es de docente ni auxiliar.');
            }
        } 
        // Panel de administrador: SOLO administrador
        elseif ($request->rol_esperado === 'administrador') {
            if ($user->rol !== 'administrador') {
                return back()->with('error', '❌ Esta cuenta no es de administrador.');
            }
        }
        // Panel de auxiliar: SOLO auxiliar (si decides mantenerlo separado)
        elseif ($request->rol_esperado === 'auxiliar') {
            if ($user->rol !== 'auxiliar') {
                return back()->with('error', '❌ Esta cuenta no es de auxiliar.');
            }
        }

        // Verificar contraseña
        if (!Hash::check($request->password, $user->contrasena)) {
            return back()->with('error', '❌ Contraseña incorrecta.');
        }

        // Iniciar sesión
        Auth::login($user);
        $request->session()->regenerate();

        // Redirigir según el rol REAL del usuario
        if ($user->rol === 'administrador') {
            return redirect()->route('admin.pagina_institucional');
        } elseif ($user->rol === 'docente') {
            return redirect()->route('docente.pagina_institucional');
        } elseif ($user->rol === 'auxiliar') {
            return redirect()->route('auxiliar.pagina_institucional');
        }

        return back()->with('error', 'Rol no reconocido.');
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