<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InscripcionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizadorController;
use App\Http\Controllers\TallerController;
use App\Http\Controllers\MaterialController;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

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


Route::middleware(['auth'])->group(function () {
    Route::get('/panel-organizador', [OrganizadorController::class, 'index'])
        ->name('organizador.panel');

    Route::get('/organizador/inscritos', [OrganizadorController::class, 'inscritos'])
        ->name('organizador.inscritos');
});

Route::patch('/organizador/inscripciones/{inscripcion}/asistencia', [OrganizadorController::class, 'actualizarAsistencia'])
    ->name('organizador.inscripciones.asistencia');

Route::get('/organizador/talleres/crear', [TallerController::class, 'create'])
    ->name('organizador.talleres.crear');

Route::post('/organizador/talleres', [TallerController::class, 'store'])
    ->name('organizador.talleres.store');

Route::get('/organizador/talleres/{taller}/editar', [TallerController::class, 'edit'])
    ->name('organizador.talleres.editar');

Route::put('/organizador/talleres/{taller}', [TallerController::class, 'update'])
    ->name('organizador.talleres.update');

Route::delete('/organizador/talleres/{taller}', [TallerController::class, 'destroy'])
    ->name('organizador.talleres.eliminar');

Route::get('/organizador/materiales', [MaterialController::class, 'index'])
    ->name('organizador.materiales');

Route::post('/organizador/materiales', [MaterialController::class, 'store'])
    ->name('organizador.materiales.store');




require __DIR__.'/auth.php';
