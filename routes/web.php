<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;


// Listar notas (Pantalla principal)
Route::get('/', [NoteController::class, 'index'])->name('notes.index');

// Crear nota (Formulario y Guardar)
Route::get('/crear', [NoteController::class, 'create'])->name('notes.create');
Route::post('/crear', [NoteController::class, 'store'])->name('notes.store');

// Ver una nota individual
Route::get('/nota/{id}', [NoteController::class, 'show'])->name('notes.show');

// Mostrar el formulario de edición
Route::get('/nota/{id}/editar', [NoteController::class, 'edit'])->name('notes.edit');

// Recibir los datos y actualizar la base de datos
// Fíjate que usamos 'put' en lugar de 'post', es el estándar para actualizaciones
Route::put('/nota/{id}/editar', [NoteController::class, 'update'])->name('notes.update');

// Ruta para borrar
Route::delete('/nota/{id}', [NoteController::class, 'destroy'])->name('notes.destroy');
