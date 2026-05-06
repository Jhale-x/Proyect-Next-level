<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('web_principal');
})->name('web.inicio');

/*

Route::get('/intranet', function () {
    return view('intranet');
})->name('portal');

Route::get('/login-colegio', function () {
    return view('login_colegio');
})->name('login_colegio');

Route::get('/login-academia', function () {
    return view('login_academia');
})->name('login_academia');

*/

Route::get('/propuesta-educativa', function () {
    return view('propuesta');
})->name('propuesta_educativa');

Route::get('/experiencia-next-level', function () {
    return view('experiencia');
})->name('experiencia');

Route::get('/ubicacion', function () {
    return view('ubicacion');
})->name('ubicacion');

Route::get('/nuestros-valores', function () {
    return view('nuestros_valores');
})->name('nuestros_valores');

Route::get('/sobre-nosotros', function () {
    return view('sobre_nosotros');
})->name('sobre_nosotros');

Route::get('/que-ofrecemos', function () {
    return view('que_ofrecemos');
})->name('que_ofrecemos');

Route::get('/colegio', function () {
    return view('colegio');
})->name('colegio');


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

/*

Route::get('matricula', function (){
    return view('matricula');
})->name('matricula');

Route::get('matricula-formulario', function (){
    return view('matricula_formulario');
})->name('matricula_formulario');

*/

Route::get('/ciclos', function (){
    return view('ciclos');
})->name('ciclos');

Route::get('/ciclo-anual-unu', function (){
    return view('ciclo_anual_unu');
})->name('ciclo_anual_unu');

Route::get('/ciclo-anual-unia', function (){
    return view('ciclo_anual_unia');
})->name('ciclo_anual_unia');

Route::get('/ciclo-semestral-unu', function (){
    return view('ciclo_semestral_unu');
})->name('ciclo_semestral_unu');

Route::get('/ciclo-semestral-unia', function (){
    return view('ciclo_semestral_unia');
})->name('ciclo_semestral_unia');

Route::get('/ciclo-verano-unu', function (){
    return view('ciclo_verano_unu');
})->name('ciclo_verano_unu');

Route::get('/ciclo-verano-unia', function (){
    return view('ciclo_verano_unia');
})->name('ciclo_verano_unia');

Route::get('/ciclos-pucp', function (){
    return view('ciclos_pucp');
})->name('ciclos_pucp');

Route::get('/ciclos-uni', function (){
    return view('ciclos_uni');
})->name('ciclos_uni');

Route::get('/ciclos-unmsm', function (){
    return view('ciclos_unmsm');
})->name('ciclosunmsm');

Route::get('/mantenimiento', function () {
    return view('mantenimiento');
})->name('mantenimiento');

Route::get('/mantenimiento', function () {
    return view('mantenimiento');
})->name('mantenimiento');

Route::get('/politica-privacidad', function () {
    return view('politica_privacidad');
})->name('politica_privacidad');

Route::get('/politica-cookies', function () {
    return view('politica_cookies');
})->name('politica_cookies');

Route::get('/terminos-condiciones', function () {
    return view('terminos_condiciones');
})->name('terminos_condiciones');
