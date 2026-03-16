<?php

use Illuminate\Support\Facades\Route; // Siempre asegúrate de tener esta línea
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\OrganizacionesController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\MensajesController;
use App\Http\Controllers\CalificacionesController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ListadoController;
use App\Http\Controllers\HerramientasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EtiController; // <--- Importado aquí
use App\Http\Controllers\asistenciaController;
use App\Http\Controllers\asispController;
use App\Http\Controllers\MensajessController;
/*
|--------------------------------------------------------------------------
| Página principal
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('institucion');

/*
|--------------------------------------------------------------------------
| Rutas del sidebar
|--------------------------------------------------------------------------
*/
Route::get('/actividad', [ActividadController::class, 'index'])->name('actividad');
Route::get('/cursos', [CursosController::class, 'index'])->name('cursos');
Route::get('/eti', [EtiController::class, 'index'])->name('eti'); // <--- Ruta limpia
Route::get('/organizaciones', [OrganizacionesController::class, 'index'])->name('organizaciones');
Route::get('/calendario', [CalendarioController::class, 'index'])->name('calendario');
Route::get('/mensajes', [MensajesController::class, 'index'])->name('mensajes');
Route::get('/calificaciones', [CalificacionesController::class, 'index'])->name('calificaciones');
Route::get('/herramientas', [HerramientasController::class, 'index'])->name('herramientas');
Route::get('/asistencia', [asistenciaController::class, 'index'])->name('asistencia');
Route::get('/asistenciaP', [asispController::class, 'index'])->name('asistenciaP');
Route::get('/soporte', [App\Http\Controllers\soporteController::class, 'index'])->name('soporte');
Route::get('/mensajes/nuevo/{curso}', [MensajessController::class, 'create'])->name('mensajes.nuevo');
/*
|--------------------------------------------------------------------------
| Usuarios (submenu)
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->group(function () {
    Route::get('/intranet', fn() => view('intranet'))->name('portal');
    Route::get('/login-academia', fn() => view('Auth.login_academia'))->name('login.academia');
    Route::get('/login-colegio', [LoginController::class, 'showColegio'])->name('login.colegio');
    
    // Logins
    Route::post('/login-alumno', [LoginController::class, 'loginAlumno'])->name('login.alumno');
    Route::post('/login-familia', [LoginController::class, 'loginFamilia'])->name('login.familia');
    Route::get('/login-user', [LoginController::class, 'showUser'])->name('login.user');
    Route::post('/login-user', [LoginController::class, 'loginUser']);    
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', 'role:administrador'])->group(function () {
    
    Route::get('/dashboard', fn() => view('Admin.dashboard'))->name('admin.dashboard');

    // Gestión de Usuarios (Personal)
    Route::prefix('users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('admin.users');
        Route::post('/', [UsersController::class, 'store'])->name('admin.users.store');
    });

    // Gestión de Actividades
    Route::prefix('activity')->group(function () {
        Route::get('/', [ActivityController::class, 'index'])->name('admin.activity');
        Route::post('/store', [ActivityController::class, 'store'])->name('admin.activities.store');
        Route::post('/asignar', [ActivityController::class, 'asignar'])->name('admin.activities.asignar');
    });

    // Gestión de Salones
    Route::prefix('salones')->group(function () {
        Route::get('/', [SalonController::class, 'index'])->name('admin.salones');
        Route::get('/{id}/edit', [SalonController::class, 'edit'])->name('admin.salones.edit');
        Route::put('/{id}', [SalonController::class, 'update'])->name('admin.salones.update');
    });

    // Página Institucional y Anuncios
    Route::get('/pagina-institucional', [Pagina_InstitucionalController::class, 'adminIndex'])->name('admin.pagina_institucional');
    Route::post('/pagina-institucional/store', [Pagina_InstitucionalController::class, 'storeAnuncio'])->name('admin.pagina_institucional.store');
    Route::delete('/pagina-institucional/{id}', [Pagina_InstitucionalController::class, 'destroyAnuncio'])->name('admin.pagina_institucional.destroy');

    // Módulos Académicos
    Route::get('/courses', [CourseController::class, 'index'])->name('admin.courses');
    Route::post('/courses/store', [CourseController::class, 'store'])->name('admin.courses.store'); 
    Route::post('/courses/asignar-salones', [CourseController::class, 'asignarSalones'])->name('admin.courses.asignarSalones');
    
    Route::get('/eti', [EtisController::class, 'index'])->name('admin.eti');
    Route::get('/calendar', [CalendarController::class, 'index'])->name('admin.calendar');

    // CORRECCIÓN admin.messages.ajax
    Route::get('/messages', [MessageController::class, 'index'])->name('admin.messages');
    Route::get('/messages/ajax/{id_curso?}', [MessageController::class, 'getMessagesByCurso'])->name('admin.messages.ajax');  
    Route::post('/messages/store-ajax', [MessageController::class, 'storeAjax'])->name('admin.messages.store');

    Route::get('/organizations', [OrganizationController::class, 'index'])->name('admin.organizations');
    Route::get('/qualifications', [QualificationController::class, 'index'])->name('admin.qualifications');
    Route::get('/tools', [ToolController::class, 'index'])->name('admin.tools');
    Route::get('/support', [SuportController::class, 'index'])->name('admin.support');
    
    // Matrícula y Configuración de Niveles (CORREGIDO)
    Route::prefix('config')->group(function () {
        Route::post('/niveles/multiple', [NivelController::class, 'storeMultiple'])->name('admin.niveles.storeMultiple');
        Route::post('/secciones/multiple', [NivelController::class, 'storeSecciones'])->name('admin.secciones.storeMultiple');
        Route::post('/grados/multiple', [NivelController::class, 'storeGrados'])->name('admin.grados.storeMultiple');
        Route::post('/facultades/multiple', [NivelController::class, 'storeFacultades'])->name('admin.facultades.storeMultiple');
    });

    // CORRECCIÓN admin.alumnos.store
    Route::get('/registro-usuario', [AlumnosController::class, 'create'])->name('usuario');
    Route::get('/listado-alumnos', [AlumnosController::class, 'index'])->name('listado');
    Route::post('/alumnos/store', [AlumnosController::class, 'store'])->name('admin.alumnos.store');
});

/*
|--------------------------------------------------------------------------
| Panel de DOCENTE
|--------------------------------------------------------------------------
*/
Route::prefix('docente')->middleware(['auth', 'role:docente'])->group(function () {
    Route::get('/dashboard', fn() => view('Docentes.dashboard'))->name('docente.dashboard');
    Route::get('/pagina-institucional', [Pagina_InstitucionalController::class, 'docenteIndex'])->name('docente.pagina_institucional');
    Route::get('/courses', [CourseController::class, 'index'])->name('docente.courses');
    Route::get('/calendar', [CalendarController::class, 'index'])->name('docente.calendar');
    Route::get('/activity', [ActivityController::class, 'index'])->name('docente.activity');
    Route::get('/qualifications', [QualificationController::class, 'index'])->name('docente.qualifications');
    Route::get('/messages', [MessageController::class, 'index'])->name('docente.messages');
    Route::get('/organizations', [OrganizationController::class, 'index'])->name('docente.organizations');
    Route::get('/tools', [ToolController::class, 'index'])->name('docente.tools');
});

/*
|--------------------------------------------------------------------------
| Panel de AUXILIAR
|--------------------------------------------------------------------------
*/
Route::prefix('auxiliar')->middleware(['auth', 'role:auxiliar'])->group(function () {
    Route::get('/dashboard', fn() => view('auxiliar.dashboard'))->name('auxiliar.dashboard');
    Route::get('/pagina-institucional', [Pagina_InstitucionalController::class, 'auxiliarIndex'])->name('auxiliar.pagina_institucional');
    Route::get('/soporte', [SuportController::class, 'index'])->name('auxiliar.soporte'); 
    Route::get('/calendar', [CalendarController::class, 'index'])->name('auxiliar.calendar');
    Route::get('/activity', [ActivityController::class, 'index'])->name('auxiliar.activity');
    Route::get('/messages', [MessageController::class, 'index'])->name('auxiliar.messages');
    Route::get('/tools', [ToolController::class, 'index'])->name('auxiliar.tools');
});

/*
|--------------------------------------------------------------------------
| Panel de ALUMNO
|--------------------------------------------------------------------------
*/
Route::prefix('alumno')->middleware(['auth:alumno'])->group(function () {
    Route::get('/dashboard', fn() => view('Alumno.dashboard'))->name('alumno.dashboard');
    Route::get('/pagina-institucional', [Pagina_InstitucionalController::class, 'alumnoIndex'])->name('alumno.pagina_institucional');
    Route::get('/calendar', [CalendarController::class, 'index'])->name('alumno.calendar');
    Route::get('/activity', [ActivityController::class, 'index'])->name('alumno.activity');
    Route::get('/qualifications', [QualificationController::class, 'index'])->name('alumno.qualifications');
    Route::get('/courses', [CourseController::class, 'index'])->name('alumno.courses');
    Route::get('/messages', [MessageController::class, 'index'])->name('alumno.messages');
    Route::get('/organizations', [OrganizationController::class, 'index'])->name('alumno.organizations');
    Route::get('/eti', [EtisController::class, 'index'])->name('alumno.eti');
    Route::get('/tools', [ToolController::class, 'index'])->name('alumno.tools');
    Route::get('/support', [SuportController::class, 'index'])->name('alumno.support');
});
