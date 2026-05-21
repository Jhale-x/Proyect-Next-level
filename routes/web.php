<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\SuportController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\EtiController;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\SeccionController;
use App\Http\Controllers\FacultadController;
use App\Http\Controllers\Web_Principal;
use App\Http\Controllers\Pagina_InstitucionalController;
use App\Http\Controllers\AlumnosController;
use App\Http\Controllers\MatriculaController;

// ======================================================
// RUTAS PÚBLICAS
// ======================================================
Route::get('/', [Web_Principal::class, 'index'])->name('web_principal');
Route::get('/propuesta-educativa', [Web_Principal::class, 'propuestaEducativa'])->name('propuesta_educativa');
Route::get('/pagina_institucional', [Pagina_InstitucionalController::class, 'index'])->name('pagina_institucional');
Route::get('/inicio', [Web_Principal::class, 'index'])->name('web.inicio');

// ======================================================
// RUTAS DE LOGIN
// ======================================================
Route::get('/intranet', [LoginController::class, 'showPortal'])->name('portal');
Route::get('/login-colegio', [LoginController::class, 'showColegio'])->name('login.colegio');
Route::get('/login-academia', [LoginController::class, 'showAcademia'])->name('login.academia');
Route::get('/login-user', [LoginController::class, 'showUser'])->name('login.user');
Route::get('/login-alumno', [LoginController::class, 'showColegio'])->name('login.alumno');

Route::post('/login-alumno', [LoginController::class, 'loginAlumno'])->name('login.alumno.post');
Route::post('/login-familia', [LoginController::class, 'loginFamilia'])->name('login.familia');
Route::post('/login-user', [LoginController::class, 'loginUser'])->name('login.user.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/logout-alumno', [LoginController::class, 'logoutAlumno'])->name('logout.alumno');

// ======================================================
// RUTAS DE MATRÍCULA
// ======================================================
Route::prefix('matricula')->group(function () {
    Route::get('/', [MatriculaController::class, 'index'])->name('matricula');
    Route::post('/verificar', [MatriculaController::class, 'store'])->name('matricula.verificar.post');
    Route::post('/validar', [MatriculaController::class, 'store'])->name('matricula.validar');
    Route::get('/formulario', [MatriculaController::class, 'mostrarFormulario'])->name('matricula.formulario');
    Route::post('/guardar', [MatriculaController::class, 'procesarMatricula'])->name('matricula.guardar');
});

// ======================================================
// API RUTAS
// ======================================================
Route::prefix('api')->group(function () {
    Route::get('/test', fn() => response()->json(['success' => true]));
});

// ======================================================
// RUTAS DEL ALUMNO (logueado)
// ======================================================
Route::prefix('alumno')->middleware(['auth:alumno'])->name('alumno.')->group(function () {
    Route::get('/dashboard', [AlumnosController::class, 'dashboard'])->name('dashboard');
    Route::get('/pagina-institucional', [AlumnosController::class, 'paginaInstitucional'])->name('pagina_institucional');
    Route::get('/activity', [AlumnosController::class, 'activity'])->name('activity');
    Route::get('/organizations', [AlumnosController::class, 'organizations'])->name('organizations');
    Route::get('/calendar', [AlumnosController::class, 'calendar'])->name('calendar');
    Route::get('/messages', [AlumnosController::class, 'messages'])->name('messages');
    Route::get('/qualifications', [AlumnosController::class, 'qualifications'])->name('qualifications');
    Route::get('/tools', [AlumnosController::class, 'tools'])->name('tools');
    Route::get('/eti', [AlumnosController::class, 'eti'])->name('eti');
    Route::get('/support', [AlumnosController::class, 'support'])->name('support');
    Route::get('/courses', [AlumnosController::class, 'courses'])->name('courses');
    Route::get('/courses/{id}', [AlumnosController::class, 'courseDetail'])->name('courses.show');
});

// ======================================================
// RUTAS DEL ADMINISTRADOR
// ======================================================
Route::prefix('admin')->middleware(['auth', 'role:administrador'])->name('admin.')->group(function () {
    
    // ========== VISTAS PRINCIPALES ==========
    Route::get('/dashboard', function() {
        return view('Admin.dashboard');
    })->name('dashboard');
    
    Route::get('/courses', [CourseController::class, 'index'])->name('courses');
    
    Route::get('/eti', function() {
        return view('Admin.eti');
    })->name('eti');
    
    Route::get('/organizations', function() {
        return view('Admin.organizations');
    })->name('organizations');
    
    Route::get('/calendar', function() {
        return view('Admin.calendar');
    })->name('calendar');
    
    Route::get('/tools', function() {
        return view('Admin.tools');
    })->name('tools');
    
    Route::get('/qualifications', function() {
        return view('Admin.qualifications');
    })->name('qualifications');
    
    Route::get('/support', function() {
        return view('Admin.support');
    })->name('support');
    
    // ========== PÁGINA INSTITUCIONAL ==========
    Route::get('/pagina-institucional', function() {
        $totalUsuarios = DB::table('users')->count();
        $alumnos = DB::table('alumnos')->count();
        $colegio = DB::table('alumnos')->whereNotNull('id_salon')->count();
        $academia = DB::table('alumnos')->count() - $colegio;
        $admins = DB::table('users')->where('rol', 'administrador')->count();
        $docentes = DB::table('users')->where('rol', 'docente')->count();
        $auxiliares = DB::table('users')->where('rol', 'auxiliar')->count();
        $usuariosRecientes = DB::table('users')->orderBy('created_at', 'desc')->limit(6)->get();
        $recientes = DB::table('anuncios')->orderBy('created_at', 'desc')->limit(5)->get();
        $historial = DB::table('anuncios')->orderBy('created_at', 'desc')->paginate(10);
        
        return view('Admin.pagina_institucional', compact(
            'totalUsuarios', 'alumnos', 'academia', 'colegio',
            'admins', 'docentes', 'auxiliares', 'usuariosRecientes',
            'recientes', 'historial'
        ));
    })->name('pagina_institucional');
    
    // ========== ACTIVIDAD ==========
    Route::get('/activity', function() {
        try {
            $activities = DB::table('activities')
                ->leftJoin('cursos', 'activities.id_curso', '=', 'cursos.id_curso')
                ->select('activities.*', 'cursos.materia')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } catch (\Exception $e) {
            $activities = collect();
        }
        return view('Admin.activity', compact('activities'));
    })->name('activity');
    
    // ========== MENSAJES ==========
    Route::get('/messages', function() {
        $cursos = DB::table('cursos')->get();
        return view('Admin.messages', compact('cursos'));
    })->name('messages');
    
    Route::post('/messages/ajax', [MessageController::class, 'storeAjax'])->name('messages.ajax');
    
    // ========== REGISTRO DE USUARIOS (vista) ==========
    Route::get('/users', function() {
        $niveles = DB::table('niveles')->get();
        $secciones = DB::table('secciones')->get();
        $facultades = DB::table('facultades')->get();
        $cursos = DB::table('cursos')->get();
        return view('Admin.users', compact('niveles', 'secciones', 'facultades', 'cursos'));
    })->name('users');
    
    // ========== REGistro DE ALUMNOS (vista) ==========
    Route::get('/registro-alumno', function() {
        $niveles = DB::table('niveles')->get();
        $secciones = DB::table('secciones')->get();
        $facultades = DB::table('facultades')->get();
        $cursos = DB::table('cursos')->get();
        return view('Admin.users', compact('niveles', 'secciones', 'facultades', 'cursos'));
    })->name('registro.alumno');
    
    // ========== REGISTROS POST ==========
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');
    Route::post('/alumnos/store', [UsersController::class, 'storeAlumno'])->name('alumnos.store');
    
    // ========== ELIMINAR ALUMNO ==========
    Route::delete('/alumnos/{id}', [UsersController::class, 'destroyAlumno'])->name('alumnos.destroy');
    
    // ========== LISTADO DE ALUMNOS CON FILTROS ==========
    Route::get('/listado-alumnos', function() {
        $query = DB::table('alumnos')
            ->leftJoin('salones', 'alumnos.id_salon', '=', 'salones.id_salon')
            ->leftJoin('niveles', 'salones.id_nivel', '=', 'niveles.id_nivel')
            ->leftJoin('grados', 'salones.id_grado', '=', 'grados.id_grado')
            ->select('alumnos.*', 'niveles.nivel as nombre_nivel', 'grados.grado as nombre_grado');
        
        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('alumnos.nombre', 'LIKE', "%$search%")
                  ->orWhere('alumnos.apellido', 'LIKE', "%$search%")
                  ->orWhere('alumnos.dni', 'LIKE', "%$search%")
                  ->orWhere('alumnos.usuario', 'LIKE', "%$search%");
            });
        }
        
        if (request('nivel')) {
            $query->where('salones.id_nivel', request('nivel'));
        }
        
        if (request('grado')) {
            $query->where('salones.id_grado', request('grado'));
        }
        
        $alumnos = $query->paginate(15);
        $niveles = DB::table('niveles')->get();
        $grados = DB::table('grados')->get();
        
        return view('Admin.ListadoAlumno', compact('alumnos', 'niveles', 'grados'));
    })->name('listado.alumnos');
    
    // ========== LISTADO DE PERSONAL CON FILTROS ==========
    Route::get('/listado-personal', function() {
        $query = DB::table('users')
            ->leftJoin('cursos', 'users.id_curso', '=', 'cursos.id_curso')
            ->select('users.*', 'cursos.materia');
        
        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('users.nombre', 'LIKE', "%$search%")
                  ->orWhere('users.apellido', 'LIKE', "%$search%")
                  ->orWhere('users.dni', 'LIKE', "%$search%")
                  ->orWhere('users.usuario', 'LIKE', "%$search%");
            });
        }
        
        if (request('rol')) {
            $query->where('users.rol', request('rol'));
        }
        
        if (request('id_curso')) {
            $query->where('users.id_curso', request('id_curso'));
        }
        
        $personales = $query->paginate(15);
        $cursos = DB::table('cursos')->get();
        
        return view('Admin.ListadoPersonal', compact('personales', 'cursos'));
    })->name('listado.personal');
    
    // ========== API PARA GRADOS ==========
    Route::get('/alumnos/grados/por-nivel/{id_nivel}', [AlumnosController::class, 'getGradosByNivel']);
    
    // ========== CRUD DE CURSOS ==========
    Route::post('/courses/store', [CourseController::class, 'store'])->name('courses.store');
    Route::put('/courses/{id}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');
    
    // ========== CONFIGURACIONES MÚLTIPLES ==========
    Route::post('/niveles/store-multiple', [NivelController::class, 'storeMultiple'])->name('niveles.storeMultiple');
    Route::post('/grados/store-multiple', [GradoController::class, 'storeMultiple'])->name('grados.storeMultiple');
    Route::post('/secciones/store-multiple', [SeccionController::class, 'storeMultiple'])->name('secciones.storeMultiple');
    Route::post('/facultades/store-multiple', [FacultadController::class, 'storeMultiple'])->name('facultades.storeMultiple');
    
    // ========== ASIGNAR SALONES ==========
    Route::post('/courses/asignar-salones', [CourseController::class, 'asignarSalones'])->name('courses.asignarSalones');
    
    // ========== ACTIVIDADES ==========
    Route::post('/activities/store', [ActivityController::class, 'store'])->name('activities.store');
    Route::post('/activities/asignar', [ActivityController::class, 'asignar'])->name('activities.asignar');
    
    // ========== CRUD PÁGINA INSTITUCIONAL ==========
    Route::post('/pagina-institucional/store', [Pagina_InstitucionalController::class, 'storeAnuncio'])->name('pagina_institucional.store');
    Route::put('/pagina-institucional/{id}', [Pagina_InstitucionalController::class, 'update'])->name('pagina_institucional.update');
    Route::delete('/pagina-institucional/{id}', [Pagina_InstitucionalController::class, 'destroyAnuncio'])->name('pagina_institucional.destroy');
});

// ======================================================
// RUTAS DEL DOCENTE
// ======================================================
Route::middleware(['auth', 'role:docente'])->group(function () {
    Route::prefix('docente')->name('docente.')->group(function () {
        Route::view('/dashboard', 'Docentes.dashboard')->name('dashboard');
        Route::get('/pagina-institucional', [Pagina_InstitucionalController::class, 'docenteIndex'])->name('pagina_institucional');
        Route::get('/courses', [CourseController::class, 'index'])->name('courses');
        Route::get('/activity', [ActivityController::class, 'index'])->name('activity');
        Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
        Route::get('/messages', [MessageController::class, 'index'])->name('messages');
        Route::get('/tools', [ToolController::class, 'index'])->name('tools');
        Route::get('/qualifications', [QualificationController::class, 'index'])->name('qualifications');
    });
}); // Cierre del grupo Docente
// ======================================================
// RUTAS DEL AUXILIAR
// ======================================================
Route::middleware(['auth', 'role:auxiliar'])->group(function () {
    Route::prefix('auxiliar')->name('auxiliar.')->group(function () {
        Route::get('/institucional', [SuportController::class, 'auxiliarIndex'])->name('pagina_institucional');
        Route::get('/eti', [EtiController::class, 'etiIndex'])->name('eti');
        Route::get('/eta', [EtiController::class, 'etaIndex'])->name('eta');
        
        // Rutas para ETA
        Route::get('/eta/grados/{id_nivel}', [EtiController::class, 'getGradosByNivel']);
        Route::post('/eta/alumnos', [EtiController::class, 'getAlumnos']);
        Route::post('/eta/guardar-promedio', [EtiController::class, 'guardarPromedio']);
        Route::post('/eta/guardar-multiples-promedios', [EtiController::class, 'guardarMultiplesPromedios']);
        Route::get('/eta/promedios', [EtiController::class, 'getPromedios']);
        Route::get('/eta/exportar', [EtiController::class, 'exportarPromedios']);
    });
});