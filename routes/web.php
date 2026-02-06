<?php

<<<<<<< HEAD
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
Route::prefix('usuarios')->group(function () {
    Route::get('/registro', [UsuarioController::class, 'index'])->name('usuario');
    Route::get('/listado', [ListadoController::class, 'index'])->name('listado');
});

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
=======
use App\Http\Controllers\homeController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\herramientasController;
use App\Http\Controllers\organizacionesController;
use App\Http\Controllers\soporteController;
use App\Http\Controllers\mensajesController;
use App\Http\Controllers\MensajessController;
use App\Http\Controllers\calificacionesController;
use App\Http\Controllers\asistenciaController;
use App\Http\Controllers\asispController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});


//Secciones
Route::get('/Activity', [ActivityController::class, 'index'])->name('Activity');
Route::get('/herramientas', [herramientasController::class, 'index'])->name('herramientas');
Route::get('/organizaciones', [organizacionesController::class, 'index'])->name('organizaciones');
Route::get('/mensajes', [mensajesController::class, 'index'])->name('mensajes');
Route::get('/soporte', [soporteController::class, 'index'])->name('soporte');
Route::get('/mensajes/nuevo/{curso}', [MensajessController::class, 'create'])->name('mensajes.nuevo');
Route::get('/calificaciones', [calificacionesController::class, 'index'])->name('calificaciones');
Route::get('/asistencia', [asistenciaController::class, 'index'])->name('asistencia');
Route::get('/asistenciaP', [asispController::class, 'index'])->name('asistenciaP');
>>>>>>> 6449e0ffd2cda145b29f11a55a06e18829329855
