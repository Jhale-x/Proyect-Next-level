<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\ToolController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');

// Secciones
Route::get('/activity', [ActivityController::class, 'index'])->name('activity');
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
Route::get('/courses', [CourseController::class, 'index'])->name('courses');
Route::get('/messages', [MessageController::class, 'index'])->name('messages');
Route::get('/organizations', [OrganizationController::class, 'index'])->name('organizations');
Route::get('/qualifications', [QualificationController::class, 'index'])->name('qualifications');
Route::get('/tools', [ToolController::class, 'index'])->name('tools');
