<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('web_principal');
});

Route::get('/intranet', function () {
    return view('intranet');
});
