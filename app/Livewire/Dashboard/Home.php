<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Equipo;

#[Layout('layouts.stage')]
class Home extends Component
{
    public int $totalEquipos = 0;
    public int $equiposDisponibles = 0;
    public int $equiposEnEvento = 0;
    public int $equiposMantenimiento = 0;

    public function mount(): void
    {
        $this->totalEquipos = Equipo::count();
        $this->equiposDisponibles = Equipo::where('estado', 'disponible')->count();
        $this->equiposEnEvento = Equipo::where('estado', 'en_evento')->count();
        $this->equiposMantenimiento = Equipo::where('estado', 'mantenimiento')->count();
    }

    public function render()
    {
        return view('livewire.dashboard.home');
    }
}
