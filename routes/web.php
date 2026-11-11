<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web_Principal;
use App\Http\Controllers\MatriculaController;

// 🆕 IMPORTAR EL CONTROLADOR DEL CHATBOT
use App\Http\Controllers\ChatbotController;

// ======================================================
// RUTAS PÚBLICAS
// ======================================================
Route::get('/', [Web_Principal::class, 'index'])->name('web_principal');
Route::get('/propuesta-educativa', [Web_Principal::class, 'propuestaEducativa'])->name('propuesta_educativa');
Route::get('/inicio', [Web_Principal::class, 'index'])->name('web.inicio');

// Página de accesos (reemplaza al portal de la intranet, que está desactivada)
Route::view('/intranet', 'accesos')->name('portal');

// ======================================================
// RUTAS DE MATRÍCULA
// ======================================================
Route::prefix('matricula')->group(function () {
    Route::get('/', [MatriculaController::class, 'index'])->name('matricula');
    Route::post('/verificar', [MatriculaController::class, 'store'])->name('matricula.verificar.post');
    Route::post('/validar', [MatriculaController::class, 'store'])->name('matricula.validar');
    Route::get('/formulario', [MatriculaController::class, 'mostrarFormulario'])->name('matricula.formulario');
    Route::post('/guardar', [MatriculaController::class, 'procesarMatricula'])->name('matricula.guardar');
    Route::post('/pago/{codigo}/culqi', [\App\Http\Controllers\PagoCulqiController::class, 'pagar'])
        ->middleware('throttle:10,1')->name('matricula.pago.culqi');
});

// ======================================================
// PANEL DE MATRÍCULAS (fuera de la intranet, con su propio login)
// ======================================================
Route::prefix('panel-matriculas')->name('panel.')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Panel\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Panel\AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [\App\Http\Controllers\Panel\AuthController::class, 'logout'])->name('logout');

    Route::middleware('panel.matricula')->controller(\App\Http\Controllers\Panel\MatriculaPanelController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/exportar', 'exportar')->name('exportar');
        Route::post('/correo-prueba', 'correoPrueba')->name('correo-prueba');
        Route::get('/mi-cuenta', 'cuenta')->name('cuenta');
        Route::put('/mi-cuenta', 'actualizarClave')->name('cuenta.clave');
        Route::get('/{id}', 'show')->whereNumber('id')->name('show');
        Route::put('/{id}/estado', 'updateEstado')->whereNumber('id')->name('estado');
        Route::post('/{id}/notificaciones', 'reenviarNotificaciones')->whereNumber('id')->name('notificaciones');
    });

    // Ciclos y cuotas
    Route::middleware('panel.matricula')->controller(\App\Http\Controllers\Panel\CicloPanelController::class)->group(function () {
        Route::get('/ciclos', 'index')->name('ciclos.index');
        Route::get('/ciclos/nuevo', 'create')->name('ciclos.create');
        Route::post('/ciclos', 'store')->name('ciclos.store');
        Route::get('/ciclos/{id}/editar', 'edit')->whereNumber('id')->name('ciclos.edit');
        Route::put('/ciclos/{id}', 'update')->whereNumber('id')->name('ciclos.update');
        Route::patch('/ciclos/{id}/estado', 'cambiarEstado')->whereNumber('id')->name('ciclos.estado');
        Route::post('/ciclos/{id}/duplicar', 'duplicar')->whereNumber('id')->name('ciclos.duplicar');
        Route::post('/ciclos/{id}/cuotas', 'guardarCuota')->whereNumber('id')->name('ciclos.cuotas.store');
        Route::put('/cuotas/{id}', 'actualizarCuota')->whereNumber('id')->name('cuotas.update');
        Route::delete('/cuotas/{id}', 'eliminarCuota')->whereNumber('id')->name('cuotas.destroy');
    });
});

// ======================================================
// WEBHOOKS DE PASARELAS DE PAGO (servidor a servidor, sin CSRF)
// ======================================================
Route::post('/webhooks/culqi', \App\Http\Controllers\WebhookCulqiController::class)
    ->middleware('throttle:60,1')->name('webhooks.culqi');

// ======================================================
// 🆕 RUTAS DEL CHATBOT
// ======================================================
Route::prefix('chatbot')->group(function () {
    Route::post('/procesar', [ChatbotController::class, 'procesar'])->name('chatbot.procesar');
    Route::get('/historial', [ChatbotController::class, 'historial'])->name('chatbot.historial');
    Route::post('/cerrar', [ChatbotController::class, 'cerrar'])->name('chatbot.cerrar');
});

// ======================================================
// API RUTAS
// ======================================================
Route::prefix('api')->group(function () {
    Route::get('/test', fn() => response()->json(['success' => true]));
});

// ======================================================
// API RUTAS PARA MATRÍCULA
// ======================================================
Route::prefix('api/matricula')->group(function () {
    // Datos generales para selects
    Route::get('/sedes', [MatriculaController::class, 'getSedes']);
    Route::get('/entornos', [MatriculaController::class, 'getEntornos']);
    Route::get('/niveles', [MatriculaController::class, 'getNiveles']);
    Route::get('/grados/{nivel_id}', [MatriculaController::class, 'getGrados']);
    Route::get('/secciones', [MatriculaController::class, 'getSecciones']);
    Route::get('/turnos', [MatriculaController::class, 'getTurnos']);
    Route::get('/universidades', [MatriculaController::class, 'getUniversidades']);
    Route::get('/tipos-ciclo', [MatriculaController::class, 'getTiposCiclo']);

    // Datos dinámicos con filtros
    Route::get('/ciclos', [MatriculaController::class, 'getCiclos']);
    Route::get('/cuotas/{ciclo_id}', [MatriculaController::class, 'getCuotas']);

    // Guardar matrícula (API)
    Route::post('/guardar', [MatriculaController::class, 'procesarMatricula']);

    // Verificar pago (opcional)
    Route::get('/pago/{codigo}', [MatriculaController::class, 'verificarPago']);
});
