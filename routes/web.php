<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebasController;
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


/// ======================================================
/// WEB PUBLICA
/// ======================================================

Route::get('/', [Web_Principal::class, 'index'])->name('web_principal');
Route::get('/propuesta-educativa', [Web_Principal::class, 'propuestaEducativa'])->name('propuesta_educativa');
Route::get('/pagina_institucional', [Pagina_InstitucionalController::class, 'index'])->name('pagina_institucional');


/// ======================================================
/// LOGIN / PORTAL
/// ======================================================

Route::prefix('auth')->group(function () {

    Route::get('/intranet', fn() => view('intranet'))->name('portal');


    Route::get('/auth.login-academia', fn() => view('login_academia'))
        ->name('login.academia');

    Route::get(
        '/auth.login-colegio',
        [LoginController::class, 'showColegio']
    )
        ->name('login.colegio');

    Route::post('/auth.login-alumno', [LoginController::class, 'loginAlumno'])->name('login.alumno');

    Route::post(
        '/auth.login-familia',
        [LoginController::class, 'loginFamilia']
    )
        ->name('login.familia');

    Route::post(
        '/logout',
        [LoginController::class, 'logout']
    )
        ->name('logout');
    Route::get(
        '/auth.login-user',
        [LoginController::class, 'showUser']
    )
        ->name('login.user');

    Route::post('/auth.login-user', [LoginController::class, 'loginUser'])
        ->name('login.user');
});


/// ======================================================
/// ADMIN (Docente + Administrador)
/// ======================================================

Route::prefix('admin')->middleware(['auth', 'role:administrador'])->group(function () {

    Route::get('/dashboard', fn() => view('Admin.dashboard'))->name('admin.dashboard');

    // accessible via /admin/pagina-institucional (prefix adds the initial /admin)
    // admin landing page for institutional content, includes form and listing of anuncios
    Route::get('/pagina-institucional', [Pagina_InstitucionalController::class, 'adminIndex'])->name('admin.pagina_institucional');

    // store a new anuncio from the admin form
    Route::post('/pagina-institucional', [Pagina_InstitucionalController::class, 'storeAnuncio'])
        ->name('admin.pagina_institucional.store');

    // Gestión de Usuarios
    Route::prefix('users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('admin.users');
        Route::post('/', [UsersController::class, 'store'])->name('admin.users.store');
        Route::get('/{id}/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{id}', [UsersController::class, 'update'])->name('admin.users.update');
        Route::delete('/{id}', [UsersController::class, 'destroy'])->name('admin.users.destroy');
    });

    // Gestión de Alumnos
    Route::prefix('alumnos')->group(function () {
        Route::post('/', [AlumnosController::class, 'store'])->name('admin.alumnos.store');
        Route::get('/{id}/edit', [AlumnosController::class, 'edit'])->name('admin.alumnos.edit');
        Route::put('/{id}', [AlumnosController::class, 'update'])->name('admin.alumnos.update');
        Route::delete('/{id}', [AlumnosController::class, 'destroy'])->name('admin.alumnos.destroy');
    });

    // Gestión de Cursos
    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('admin.courses');
        Route::post('/', [CourseController::class, 'store'])->name('admin.courses.store');
        Route::get('/{id}/edit', [CourseController::class, 'edit'])->name('admin.courses.edit');
        Route::put('/{id}', [CourseController::class, 'update'])->name('admin.courses.update');
        Route::delete('/{id}', [CourseController::class, 'destroy'])->name('admin.courses.destroy');
        Route::get('/{id_usuario}/docentes', [CourseController::class, 'docentes']);
        Route::get('/docente/{id}/salones', [CourseController::class, 'salonesPorDocente']);
        Route::get('/curso/{id}/salones', [CourseController::class, 'salones']);
        Route::post('/asignar-salones', [CourseController::class, 'asignarSalones'])->name('admin.courses.asignarSalones');
    });

    // Gestión de Salones
    Route::prefix('salones')->group(function () {
        Route::post('/crear-completo', [SalonController::class, 'crearCompleto'])->name('admin.salon.crearCompleto');
        Route::get('/por-nivel', [SalonController::class, 'porNivel']);
        Route::get('/{id}/detalle', [CourseController::class, 'detalleSalon']);
        // export/import Excel for a salón
        //Route::get('/{id}/export', [SalonController::class, 'export'])->name('admin.salones.export');
        Route::get('/{id}/export/{idCurso}', [SalonController::class, 'export'])
            ->name('admin.salones.export');
        Route::post('/{id}/import', [SalonController::class, 'import'])->name('admin.salones.import');
        Route::get('/{id}/edit', [SalonController::class, 'edit'])->name('admin.salones.edit');
        Route::put('/{id}', [SalonController::class, 'update'])->name('admin.salones.update');
        Route::delete('/{id}', [SalonController::class, 'destroy'])->name('admin.salones.destroy');
    });

    // Gestión de Niveles/Grados/Secciones/Facultades
    Route::post('/niveles/store-multiple', [NivelController::class, 'storeMultiple'])->name('admin.niveles.storeMultiple');
    Route::post('/grados/store', [GradoController::class, 'store'])->name('admin.grados.store');
    Route::post('/grados/store-multiple', [GradoController::class, 'storeMultiple'])->name('admin.grados.storeMultiple');
    Route::get('/grados/por-nivel/{id}', [GradoController::class, 'porNivel'])
        ->name('admin.grados.porNivel');
    Route::post('/secciones/store-multiple', [SeccionController::class, 'storeMultiple'])->name('admin.secciones.storeMultiple');
    Route::post('/facultades/store-multiple', [FacultadController::class, 'storeMultiple'])->name('admin.facultades.storeMultiple');

    // ETI
    Route::get('/eti', [EtisController::class, 'index'])->name('admin.eti');

    // Calificaciones (Admin como Docente)
    Route::get('/qualifications', [QualificationController::class, 'index'])->name('admin.qualifications');

    // Actividades (Admin como Docente)
    Route::get('/activity', [ActivityController::class, 'index'])->name('admin.activity');
    Route::prefix('activities')->group(function () {
        Route::post('/store', [ActivityController::class, 'store'])->name('admin.activities.store');
        Route::post('/asignar', [ActivityController::class, 'asignar'])->name('admin.activities.asignar');
        Route::get('/{id}/edit', [ActivityController::class, 'edit'])->name('admin.activities.edit');
        Route::put('/{id}', [ActivityController::class, 'update'])->name('admin.activities.update');
        Route::delete('/{id}', [ActivityController::class, 'destroy'])->name('admin.activities.destroy');
    });

    Route::prefix('messages')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('admin.messages');
        Route::get('/get-chat/{id_curso}', [MessageController::class, 'getMessagesByCurso'])->name('admin.messages.getChat');
        Route::post('/store-ajax', [MessageController::class, 'storeAjax'])->name('admin.messages.ajax');
    });

    Route::get('/calendar', [CalendarController::class, 'index'])->name('admin.calendar');
    Route::get('/organizations', [OrganizationController::class, 'index'])->name('admin.organizations');
    Route::get('/tools', [ToolController::class, 'index'])->name('admin.tools');
});

Route::prefix('docente')->middleware(['auth', 'role:docente'])->group(function () {
    Route::get('/pagina-institucional', [Pagina_InstitucionalController::class, 'docenteIndex'])->name('docente.pagina_institucional');
    Route::get('/dashboard', fn() => view('Docentes.dashboard'))->name('docente.dashboard');
    Route::get('/qualifications', [QualificationController::class, 'index'])->name('docente.qualifications');
    Route::get('/activity', [ActivityController::class, 'index'])->name('docente.activity');
    Route::get('/calendar', [CalendarController::class, 'index'])->name('docente.calendar');
    Route::get('/messages', [MessageController::class, 'index'])->name('docente.messages');
    Route::get('/organizations', [OrganizationController::class, 'index'])->name('docente.organizations');
    Route::get('/tools', [ToolController::class, 'index'])->name('docente.tools');

    Route::prefix('activities')->group(function () {
        Route::post('/store', [ActivityController::class, 'store'])->name('docente.activities.store');
        Route::post('/asignar', [ActivityController::class, 'asignar'])->name('docente.activities.asignar');
        Route::get('/{id}/edit', [ActivityController::class, 'edit'])->name('docente.activities.edit');
        Route::put('/{id}', [ActivityController::class, 'update'])->name('docente.activities.update');
        Route::delete('/{id}', [ActivityController::class, 'destroy'])->name('docente.activities.destroy');
    });
});


/// ======================================================
/// AUXILIAR
/// ======================================================

Route::prefix('auxiliar')->middleware(['auth', 'role:auxiliar'])->group(function () {

    Route::get('/dashboard', fn() => view('auxiliar.dashboard'))->name('auxiliar.dashboard');
    Route::get('/suport', [SuportController::class, 'index'])->name('auxiliar.suport');
});


/// ======================================================
/// ALUMNO (Guard: alumno)
/// ======================================================

Route::prefix('alumno')->middleware(['auth:alumno'])->group(function () {

    Route::get('/dashboard', fn() => view('Alumno.dashboard'))->name('alumno.dashboard');
    Route::get('/pagina-institucional', [Pagina_InstitucionalController::class, 'alumnoIndex'])->name('alumno.pagina_institucional');
    Route::get('/qualifications', [QualificationController::class, 'index'])->name('alumno.qualifications');
    Route::get('/calendar', [CalendarController::class, 'index'])->name('alumno.calendar');
    Route::get('/messages', [MessageController::class, 'index'])->name('alumno.messages');
    Route::get('/activity', [ActivityController::class, 'index'])->name('alumno.activity');
    Route::get('/organizations', [OrganizationController::class, 'index'])->name('alumno.organizations');
    Route::get('/tools', [ToolController::class, 'index'])->name('alumno.tools');
    Route::get('/eti', [EtisController::class, 'index'])->name('alumno.eti');
});
