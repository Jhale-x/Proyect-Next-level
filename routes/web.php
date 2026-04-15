<?php

use Illuminate\Support\Facades\Route;
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
use App\Http\Controllers\EtisController;
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
// RUTAS DE LOGIN
// ======================================================
Route::get('/intranet', [LoginController::class, 'showPortal'])->name('portal');
Route::get('/login-colegio', [LoginController::class, 'showColegio'])->name('login.colegio');
Route::get('/login-academia', [LoginController::class, 'showAcademia'])->name('login.academia');
Route::get('/login-user', [LoginController::class, 'showUser'])->name('login.user');

// Login de alumnos (POST)
Route::post('/login-alumno', [LoginController::class, 'loginAlumno'])->name('login.alumno');

// Login de familia (POST)
Route::post('/login-familia', [LoginController::class, 'loginFamilia'])->name('login.familia');

// Login de usuarios (POST)
Route::post('/login-user', [LoginController::class, 'loginUser']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/logout-alumno', [LoginController::class, 'logoutAlumno'])->name('logout.alumno');

// ======================================================
// RUTAS PÚBLICAS
// ======================================================
Route::get('/', [Web_Principal::class, 'index'])->name('web_principal');
Route::get('/propuesta-educativa', [Web_Principal::class, 'propuestaEducativa'])->name('propuesta_educativa');
Route::get('/pagina_institucional', [Pagina_InstitucionalController::class, 'index'])->name('pagina_institucional');
Route::get('/inicio', [Web_Principal::class, 'index'])->name('web.inicio');

// ======================================================
// SISTEMA DE MATRÍCULA
// ======================================================
Route::get('/matricula', [MatriculaController::class, 'index'])->name('matricula');
Route::post('/matricula/verificar', [MatriculaController::class, 'store'])->name('matricula.verificar.post');
Route::get('/matricula/verificar', function() {
    return redirect()->route('matricula');
});
Route::post('/matricula/validar', [MatriculaController::class, 'store'])->name('matricula.validar');
Route::get('/matricula/formulario', [MatriculaController::class, 'mostrarFormulario'])->name('matricula.formulario');
Route::get('/matricula-formulario', [MatriculaController::class, 'mostrarFormulario'])->name('matricula.formulario');
Route::post('/matricula/guardar', [MatriculaController::class, 'procesarMatricula'])->name('matricula.guardar');

// ======================================================
// API RUTAS PARA MATRÍCULA
// ======================================================
Route::prefix('api/matricula')->group(function () {
    Route::get('/sedes', [MatriculaController::class, 'getSedes']);
    Route::get('/entornos', [MatriculaController::class, 'getEntornos']);
    Route::get('/universidades', [MatriculaController::class, 'getUniversidades']);
    Route::get('/tipos-ciclo', [MatriculaController::class, 'getTiposCiclo']);
    Route::get('/turnos', [MatriculaController::class, 'getTurnos']);
    Route::get('/ciclos', [MatriculaController::class, 'getCiclos']);
    Route::get('/cuotas/{ciclo_id}', [MatriculaController::class, 'getCuotas']);
    Route::post('/guardar', [MatriculaController::class, 'procesarMatricula']);
});

Route::get('/api/test', function() {
    return response()->json([
        'success' => true,
        'message' => 'API funcionando correctamente',
        'timestamp' => now()->toDateTimeString()
    ]);
});

// ======================================================
// LOGIN DE ALUMNOS (VISTA)
// ======================================================
Route::get('/login-alumno', [LoginController::class, 'showColegio'])->name('login.alumno');

// ======================================================
// RUTAS DEL ALUMNO (AUTHENTICATED) - USANDO AlumnosController
// ======================================================
Route::prefix('alumno')->middleware(['auth:alumno'])->group(function () {
    Route::get('/dashboard', [AlumnosController::class, 'dashboard'])->name('alumno.dashboard');
    Route::get('/pagina-institucional', [AlumnosController::class, 'paginaInstitucional'])->name('alumno.pagina_institucional');
    Route::get('/activity', [AlumnosController::class, 'activity'])->name('alumno.activity');
    Route::get('/organizations', [AlumnosController::class, 'organizations'])->name('alumno.organizations');
    Route::get('/calendar', [AlumnosController::class, 'calendar'])->name('alumno.calendar');
    Route::get('/messages', [AlumnosController::class, 'messages'])->name('alumno.messages');
    Route::get('/qualifications', [AlumnosController::class, 'qualifications'])->name('alumno.qualifications');
    Route::get('/tools', [AlumnosController::class, 'tools'])->name('alumno.tools');
    Route::get('/eti', [AlumnosController::class, 'eti'])->name('alumno.eti');
    Route::get('/support', [AlumnosController::class, 'support'])->name('alumno.support');
    Route::get('/courses', [AlumnosController::class, 'courses'])->name('alumno.courses');
    Route::get('/courses/{id}', [AlumnosController::class, 'courseDetail'])->name('alumno.courses.show');
});

// ======================================================
// ADMINISTRACIÓN
// ======================================================
Route::prefix('admin')->middleware(['auth', 'role:administrador'])->group(function () {
    Route::get('/dashboard', fn() => view('Admin.dashboard'))->name('admin.dashboard');

    Route::prefix('matriculas')->group(function () {
        Route::get('/', [MatriculaController::class, 'index'])->name('admin.matriculas.index');
    });

    Route::get('/pagina-institucional', [Pagina_InstitucionalController::class, 'adminIndex'])->name('admin.pagina_institucional');
    Route::post('/pagina-institucional', [Pagina_InstitucionalController::class, 'storeAnuncio'])->name('admin.pagina_institucional.store');
    Route::delete('/pagina-institucional/{id}', [Pagina_InstitucionalController::class, 'destroyAnuncio'])->name('admin.pagina_institucional.destroy');

    Route::get('/gestion-usuarios', [EtisController::class, 'index'])->name('admin.users');
    Route::get('/eti', [EtisController::class, 'viewEti'])->name('admin.eti');

    Route::prefix('alumnos')->group(function () {
        Route::get('/registro', [AlumnosController::class, 'create'])->name('admin.alumnos.create');
        Route::get('/listado', [AlumnosController::class, 'index'])->name('admin.alumnos.index');
        Route::post('/', [AlumnosController::class, 'store'])->name('admin.alumnos.store');
        Route::get('/datos-formulario', [AlumnosController::class, 'datosFormulario'])->name('admin.alumnos.datosFormulario');
    });

    Route::prefix('users')->group(function () {
        Route::get('/listado', [UsersController::class, 'index'])->name('admin.users.index');
        Route::post('/', [UsersController::class, 'store'])->name('admin.users.store');
    });

    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('admin.courses');
        Route::post('/', [CourseController::class, 'store'])->name('admin.courses.store');
        Route::get('/{id_curso}/docentes', [CourseController::class, 'docentes'])->name('admin.courses.docentes');
        Route::get('/docente/{id_usuario}/salones', [CourseController::class, 'salonesPorDocente'])->name('admin.courses.salonesPorDocente');
        Route::post('/asignar-salones', [CourseController::class, 'asignarSalones'])->name('admin.courses.asignarSalones');
    });

    Route::prefix('salones')->group(function () {
        Route::get('/', [SalonController::class, 'index'])->name('admin.salones');
        Route::post('/crear-completo', [SalonController::class, 'crearCompleto'])->name('admin.salon.crearCompleto');
        Route::get('/por-nivel', [SalonController::class, 'porNivel'])->name('admin.salones.porNivel');
        Route::get('/{id}/detalle', [CourseController::class, 'detalleSalon'])->name('admin.salones.detalle');
        Route::post('/{id}/guardar-notas', [CourseController::class, 'guardarNotasSalon'])->name('admin.salones.guardarNotas');
    });

    Route::post('/niveles/store-multiple', [NivelController::class, 'storeMultiple'])->name('admin.niveles.storeMultiple');
    Route::post('/grados/store-multiple', [GradoController::class, 'storeMultiple'])->name('admin.grados.storeMultiple');
    Route::post('/secciones/store-multiple', [SeccionController::class, 'storeMultiple'])->name('admin.secciones.storeMultiple');
    Route::post('/facultades/store-multiple', [FacultadController::class, 'storeMultiple'])->name('admin.facultades.storeMultiple');

    Route::prefix('activities')->group(function () {
        Route::get('/', [ActivityController::class, 'index'])->name('admin.activity');
        Route::post('/store', [ActivityController::class, 'store'])->name('admin.activities.store');
        Route::post('/asignar', [ActivityController::class, 'asignar'])->name('admin.activities.asignar');
    });

    Route::prefix('messages')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('admin.messages');
        Route::get('/get-chat/{id_curso}', [MessageController::class, 'getMessagesByCurso'])->name('admin.messages.getChat');
        Route::post('/store-ajax', [MessageController::class, 'storeAjax'])->name('admin.messages.ajax');
    });

    Route::get('/calendar', [CalendarController::class, 'index'])->name('admin.calendar');
    Route::get('/organizations', [OrganizationController::class, 'index'])->name('admin.organizations');
    Route::get('/tools', [ToolController::class, 'index'])->name('admin.tools');
    Route::get('/support', [SuportController::class, 'index'])->name('admin.support');
});

// ======================================================
// ROL DOCENTE
// ======================================================
Route::prefix('docente')->middleware(['auth', 'role:docente'])->group(function () {
    Route::get('/dashboard', fn() => view('Docentes.dashboard'))->name('docente.dashboard');
    Route::get('/pagina-institucional', [Pagina_InstitucionalController::class, 'docenteIndex'])->name('docente.pagina_institucional');
    Route::get('/courses', [CourseController::class, 'index'])->name('docente.courses');
    Route::get('/activity', [ActivityController::class, 'index'])->name('docente.activity');
    Route::get('/calendar', [CalendarController::class, 'index'])->name('docente.calendar');
    Route::get('/messages', [MessageController::class, 'index'])->name('docente.messages');
    Route::get('/tools', [ToolController::class, 'index'])->name('docente.tools');
});

// ======================================================
// ROL AUXILIAR
// ======================================================
Route::prefix('auxiliar')->middleware(['auth', 'role:auxiliar'])->group(function () {
    Route::get('/dashboard', fn() => view('auxiliar.dashboard'))->name('auxiliar.dashboard');
    Route::get('/support', [SuportController::class, 'index'])->name('auxiliar.support');
    Route::get('/tools', [ToolController::class, 'index'])->name('auxiliar.tools');
});