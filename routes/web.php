<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('web_principal');
})->name('web.inicio');

Route::get('/intranet', function () {
    return view('intranet');
})->name('portal');

Route::get('/login-colegio', function () {
    return view('login_colegio');
})->name('login.colegio');

Route::get('/login-academia', function () {
    return view('login_academia');
})->name('login.academia');

Route::get('/propuesta-educativa', function () {
    return view('propuesta');
})->name('propuesta.educativa');

Route::get('/experiencia-next-level', function () {
    return view('experiencia');
})->name('experiencia');

Route::get('/ubicacion', function () {
    return view('ubicacion');
})->name('ubicacion');

Route::get('/nuestros-valores', function () {
    return view('nuestros_valores');
})->name('nuestros.valores');

Route::get('/sobre-nosotros', function () {
    return view('sobre_nosotros');
})->name('sobre.nosotros');

Route::get('/academia', function () {
    return view('academia');
})->name('academia');

Route::get('/contactenos', function (){
    return view('contactenos');
})->name('contactenos');

Route::get('/galeria', function () {
    return view('galeria');
})->name('galeria');

Route::get('/pagos', function (){
    return view('pagos');
})->name('pagos');

Route::get('/ciclos', function (){
    return view('ciclos');
})->name('ciclos');

Route::get('/ciclo-anual-unu', function (){
    return view('ciclo_anual_unu');
})->name('ciclo-anual-unu');

Route::get('/ciclo-anual-unia', function (){
    return view('ciclo_anual_unia');
})->name('ciclo-anual-unia');

Route::get('/mantenimiento', function () {
    return view('mantenimiento');
})->name('mantenimiento');
