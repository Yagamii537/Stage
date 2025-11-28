<?php

namespace App\Livewire\Equipos;

use App\Models\Equipo;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.stage')]
class IndexEquipos extends Component
{
    use WithPagination;

    public string $search = '';

    protected string $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function eliminar(int $id): void
    {
        $equipo = Equipo::findOrFail($id);
        $equipo->delete();

        session()->flash('message', 'Equipo eliminado correctamente.');
    }

    public function render()
    {
        $equipos = Equipo::where(function ($q) {
            $q->where('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('tipo', 'like', '%' . $this->search . '%');
        })
            ->orderByDesc('id')
            ->paginate(10);

        return view('livewire.equipos.index-equipos', [
            'equipos' => $equipos,
        ]);
    }
}
