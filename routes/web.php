<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InscripcionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('index'); })->name('agenda');
Route::get('/contacto', function () { return view('contacto'); });

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Rutas del Área Privada del Asistente y Gestión de Inscripciones
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [InscripcionController::class, 'perfil'])->name('perfil.asistente');
    Route::post('/taller/{id}/inscribir', [InscripcionController::class, 'inscribir'])->name('taller.inscribir');
});

require __DIR__.'/auth.php';
