<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

// 1. Ruta Pública (Bienvenida)
Route::get('/', function () {
    return view('welcome');
});

// 2. RUTAS PROTEGIDAS (Solo usuarios logueados)
Route::middleware(['auth'])->group(function () {

    // --- AQUÍ ESTÁ EL ARREGLO ---
    // Creamos la ruta '/dashboard' Y LE PONEMOS EL NOMBRE 'dashboard'
    Route::get('/dashboard', function () {
        return redirect()->route('notes.index');
    })->name('dashboard'); // <--- ¡Esta línea soluciona tu error!
    // ----------------------------

    // Tus rutas de Notas
    Route::get('/notas', [NoteController::class, 'index'])->name('notes.index');
    Route::get('/notas/crear', [NoteController::class, 'create'])->name('notes.create');
    Route::post('/notas', [NoteController::class, 'store'])->name('notes.store');
    Route::get('/notas/{id}', [NoteController::class, 'show'])->name('notes.show');
    Route::get('/notas/{id}/editar', [NoteController::class, 'edit'])->name('notes.edit');
    Route::put('/notas/{id}', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('/notas/{id}', [NoteController::class, 'destroy'])->name('notes.destroy');
});

// 3. Rutas de Autenticación (Login, Registro, etc.)
require __DIR__.'/auth.php';