<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard\Home;
use App\Livewire\Equipos\IndexEquipos;
use App\Livewire\Equipos\FormEquipo;
use App\Livewire\Responsables\IndexResponsables;
use App\Livewire\Responsables\FormResponsable;
use App\Livewire\Eventos\IndexEventos;
use App\Livewire\Eventos\FormEvento;
use App\Http\Controllers\EventoPdfController;

Route::get('/', Home::class)->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', Home::class)->name('dashboard');

    // Equipos
    Route::get('/equipos', IndexEquipos::class)->name('equipos.index');
    Route::get('/equipos/crear', FormEquipo::class)->name('equipos.create');
    Route::get('/equipos/{equipo}/editar', FormEquipo::class)->name('equipos.edit');

    // Responsables
    Route::get('/responsables', IndexResponsables::class)->name('responsables.index');
    Route::get('/responsables/crear', FormResponsable::class)->name('responsables.create');
    Route::get('/responsables/{responsable}/editar', FormResponsable::class)->name('responsables.edit');

    // Eventos
    Route::get('/eventos', IndexEventos::class)->name('eventos.index');
    Route::get('/eventos/crear', FormEvento::class)->name('eventos.create');
    Route::get('/eventos/{evento}/editar', FormEvento::class)->name('eventos.edit');

    Route::get('/eventos/{evento}/pdf', [EventoPdfController::class, 'show'])
        ->name('eventos.pdf');
});

require __DIR__ . '/auth.php';
