<?php

use App\Http\Controllers\MatriculaController;
use Illuminate\Support\Facades\Route;

Route::prefix('matricula')->group(function () {
    Route::get('/sedes', [MatriculaController::class, 'getSedes']);
    Route::get('/entornos', [MatriculaController::class, 'getEntornos']);
    Route::get('/niveles', [MatriculaController::class, 'getNiveles']);
    Route::get('/grados/{nivel_id}', [MatriculaController::class, 'getGrados']);
    Route::get('/secciones', [MatriculaController::class, 'getSecciones']);
    Route::get('/turnos', [MatriculaController::class, 'getTurnos']);
    Route::get('/universidades', [MatriculaController::class, 'getUniversidades']);
    Route::get('/tipos-ciclo', [MatriculaController::class, 'getTiposCiclo']);
    Route::get('/ciclos', [MatriculaController::class, 'getCiclos']);
    Route::get('/cuotas/{ciclo_id}', [MatriculaController::class, 'getCuotas']);
    Route::post('/guardar', [MatriculaController::class, 'procesarMatricula']);
});