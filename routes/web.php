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

// --- RUTAS PÚBLICAS ---
Route::get('/', [Web_Principal::class, 'index'])->name('web_principal');
Route::get('/propuesta-educativa', [Web_Principal::class, 'propuestaEducativa'])->name('propuesta_educativa');
Route::get('/pagina_institucional', [Pagina_InstitucionalController::class, 'index'])->name('pagina_institucional');

// Esta ruta servirá para ambos nombres que estás usando en las vistas
Route::get('/', [Web_Principal::class, 'index'])
    ->name('web_principal');

// Creamos un "alias" o segunda ruta idéntica para 'web.inicio' 
// Así no tienes que editar todos tus archivos .blade.php
Route::get('/inicio', [Web_Principal::class, 'index'])
    ->name('web.inicio');

// 1. Pantalla de validación de DNI
Route::get('/matricula', [MatriculaController::class, 'index'])->name('matricula');

// 2. Procesa la validación del DNI/CV
Route::post('/matricula/verificar', [MatriculaController::class, 'store'])->name('admin.matriculas.store');

// 3. El formulario de 3 pasos (donde eliges Modalidad/Academia/Colegio)
Route::get('/matricula-formulario', [MatriculaController::class, 'mostrarFormulario'])->name('matricula.formulario');

// --- AUTENTICACIÓN ---
Route::prefix('auth')->group(function () {
    Route::get('/intranet', fn() => view('intranet'))->name('portal');
    Route::get('/login-academia', fn() => view('Auth.login_academia'))->name('login.academia');
    Route::get('/login-colegio', [LoginController::class, 'showColegio'])->name('login.colegio');
    Route::post('/login-alumno', [LoginController::class, 'loginAlumno'])->name('login.alumno');
    Route::post('/login-familia', [LoginController::class, 'loginFamilia'])->name('login.familia');
    Route::get('/login-user', [LoginController::class, 'showUser'])->name('login.user');
    Route::post('/login-user', [LoginController::class, 'loginUser']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// --- ADMINISTRACIÓN ---
Route::prefix('admin')->middleware(['auth', 'role:administrador'])->group(function () {
    
    Route::get('/dashboard', fn() => view('Admin.dashboard'))->name('admin.dashboard');

    // --- MATRÍCULAS ---
    Route::prefix('matriculas')->group(function () {
        Route::get('/', [MatriculaController::class, 'index'])->name('admin.matriculas.index');
    });


    // Gestión Institucional
    Route::get('/pagina-institucional', [Pagina_InstitucionalController::class, 'adminIndex'])->name('admin.pagina_institucional');
    Route::post('/pagina-institucional', [Pagina_InstitucionalController::class, 'storeAnuncio'])->name('admin.pagina_institucional.store');
    Route::delete('/pagina-institucional/{id}', [Pagina_InstitucionalController::class, 'destroyAnuncio'])->name('admin.pagina_institucional.destroy');

    // --- SECCIÓN ETI Y USUARIOS ---
    // 'admin.users' es la pantalla de gestión de botones
    Route::get('/gestion-usuarios', [EtisController::class, 'index'])->name('admin.users'); 
    // 'admin.eti' es la pantalla de cursos ETI
    Route::get('/eti', [EtisController::class, 'viewEti'])->name('admin.eti');

    // --- ALUMNOS ---
    Route::prefix('alumnos')->group(function () {
        Route::get('/registro', [AlumnosController::class, 'create'])->name('admin.alumnos.create');
        Route::get('/listado', [AlumnosController::class, 'index'])->name('admin.alumnos.index'); 
        Route::post('/', [AlumnosController::class, 'store'])->name('admin.alumnos.store');
        Route::get('/datos-formulario', [AlumnosController::class, 'datosFormulario'])->name('admin.alumnos.datosFormulario');
    });

    // --- PERSONAL (Users) ---
    Route::prefix('users')->group(function () {
        // Ruta para ver el listado
        Route::get('/listado', [UsersController::class, 'index'])->name('admin.users.index'); 
        
        // CORRECCIÓN: Agregamos el nombre exacto que pide el error
        Route::post('/', [UsersController::class, 'store'])->name('admin.users.store');
    });
    // --- CURSOS Y SALONES ---
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

    // --- CONFIGURACIÓN ACADÉMICA ---
    Route::post('/niveles/store-multiple', [NivelController::class, 'storeMultiple'])->name('admin.niveles.storeMultiple');
    Route::post('/grados/store-multiple', [GradoController::class, 'storeMultiple'])->name('admin.grados.storeMultiple');
    Route::post('/secciones/store-multiple', [SeccionController::class, 'storeMultiple'])->name('admin.secciones.storeMultiple');
    Route::post('/facultades/store-multiple', [FacultadController::class, 'storeMultiple'])->name('admin.facultades.storeMultiple');

    // --- ACTIVIDADES (Corregido para evitar RouteNotFound) ---
    Route::prefix('activities')->group(function () {
        Route::get('/', [ActivityController::class, 'index'])->name('admin.activity');
        Route::post('/store', [ActivityController::class, 'store'])->name('admin.activities.store');
        Route::post('/asignar', [ActivityController::class, 'asignar'])->name('admin.activities.asignar');
    });

    // --- MENSAJES ---
    Route::prefix('messages')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('admin.messages');
        Route::get('/get-chat/{id_curso}', [MessageController::class, 'getMessagesByCurso'])->name('admin.messages.getChat');
        
        // CAMBIA 'admin.messages.store' POR 'admin.messages.ajax'
        Route::post('/store-ajax', [MessageController::class, 'storeAjax'])->name('admin.messages.ajax');
    });

    // --- OTROS ---
    Route::get('/calendar', [CalendarController::class, 'index'])->name('admin.calendar');
    Route::get('/organizations', [OrganizationController::class, 'index'])->name('admin.organizations');
    Route::get('/tools', [ToolController::class, 'index'])->name('admin.tools');
    Route::get('/support', [SuportController::class, 'index'])->name('admin.support'); 
});

// --- ROL DOCENTE ---
Route::prefix('docente')->middleware(['auth', 'role:docente'])->group(function () {
    Route::get('/dashboard', fn() => view('Docentes.dashboard'))->name('docente.dashboard');
    Route::get('/pagina-institucional', [Pagina_InstitucionalController::class, 'docenteIndex'])->name('docente.pagina_institucional');
    Route::get('/courses', [CourseController::class, 'index'])->name('docente.courses');
    Route::get('/activity', [ActivityController::class, 'index'])->name('docente.activity');
    Route::get('/calendar', [CalendarController::class, 'index'])->name('docente.calendar');
    Route::get('/messages', [MessageController::class, 'index'])->name('docente.messages');
    Route::get('/tools', [ToolController::class, 'index'])->name('docente.tools');
});

// --- ROL AUXILIAR ---
Route::prefix('auxiliar')->middleware(['auth', 'role:auxiliar'])->group(function () {
    Route::get('/dashboard', fn() => view('auxiliar.dashboard'))->name('auxiliar.dashboard');
    Route::get('/support', [SuportController::class, 'index'])->name('auxiliar.support');
    Route::get('/tools', [ToolController::class, 'index'])->name('auxiliar.tools');
});

// --- ROL ALUMNO ---
Route::prefix('alumno')->middleware(['auth:alumno'])->group(function () {
    Route::get('/dashboard', fn() => view('Alumno.dashboard'))->name('alumno.dashboard');
    Route::get('/pagina-institucional', [Pagina_InstitucionalController::class, 'alumnoIndex'])->name('alumno.pagina_institucional');
    Route::get('/calendar', [CalendarController::class, 'index'])->name('alumno.calendar');
    Route::get('/messages', [MessageController::class, 'index'])->name('alumno.messages');
    Route::get('/activity', [ActivityController::class, 'index'])->name('alumno.activity');
    Route::get('/courses', [CourseController::class, 'index'])->name('alumno.courses');
    Route::get('/eti', [EtisController::class, 'index'])->name('alumno.eti');  
    Route::get('/support', [SuportController::class, 'index'])->name('alumno.support');
});