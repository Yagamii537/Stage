<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard\Home;
use App\Livewire\Equipos\IndexEquipos;
use App\Livewire\Equipos\FormEquipo;

Route::get('/', Home::class)->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', Home::class)->name('dashboard');

    // Equipos
    Route::get('/equipos', IndexEquipos::class)->name('equipos.index');
    Route::get('/equipos/crear', FormEquipo::class)->name('equipos.create');
    Route::get('/equipos/{equipo}/editar', FormEquipo::class)->name('equipos.edit');
});

require __DIR__ . '/auth.php';
