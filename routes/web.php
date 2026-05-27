<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InscripcionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizadorController;
use App\Http\Controllers\TallerController;
use App\Http\Controllers\MaterialController;


Route::get('/', [TallerController::class, 'index'])->name('agenda');
Route::get('/contacto', function () { return view('contacto'); });

Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Ruta para ver el detalle de un taller específico
Route::get('/evento/{id}', [TallerController::class, 'show'])->name('taller.detalle');

// Rutas del Área Privada del Asistente y Gestión de Inscripciones
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [InscripcionController::class, 'perfil'])->name('perfil.asistente');
    Route::post('/taller/{id}/inscribir', [InscripcionController::class, 'inscribir'])->name('taller.inscribir');
    Route::delete('/inscripcion/{id}/cancelar', [InscripcionController::class, 'cancelar'])->name('inscripcion.cancelar');

    // Ver el formulario de edición
    Route::get('/perfil/editar', [ProfileController::class, 'edit'])->name('perfil.edit');
    // Actualizar nombre y correo
    Route::patch('/perfil/actualizar', [ProfileController::class, 'update'])->name('perfil.update');
    // Actualizar contraseña
    Route::put('/perfil/password', [ProfileController::class, 'updatePassword'])->name('perfil.password');
    // Eliminar cuenta
    Route::delete('/perfil/eliminar', [ProfileController::class, 'destroy'])->name('perfil.destroy');
});

// Rutas del Área Privada del Organizador (Protegidas por middleware de autenticación)
Route::middleware(['auth'])->group(function () {
    Route::get('/panel-organizador', [OrganizadorController::class, 'index'])
        ->name('organizador.panel');

    Route::get('/organizador/inscritos', [OrganizadorController::class, 'inscritos'])
        ->name('organizador.inscritos');

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

    Route::delete('/organizador/materiales/{material}', [MaterialController::class, 'destroy'])
        ->name('organizador.materiales.eliminar');
});
