<?php

use App\Http\Controllers\homeController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\herramientasController;
use App\Http\Controllers\organizacionesController;
use App\Http\Controllers\soporteController;
use App\Http\Controllers\mensajesController;
use App\Http\Controllers\MensajessController;
use App\Http\Controllers\calificacionesController;
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