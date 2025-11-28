<?php

namespace App\Livewire\Eventos;

use App\Models\Evento;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.stage')]
class IndexEventos extends Component
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
        $evento = Evento::findOrFail($id);
        $evento->delete();
        session()->flash('message', 'Evento eliminado correctamente.');
    }

    public function render()
    {
        $eventos = Evento::with('responsable')
            ->where('nombre', 'like', '%' . $this->search . '%')
            ->orderByDesc('fecha_evento')
            ->paginate(10);

        return view('livewire.eventos.index-eventos', [
            'eventos' => $eventos,
        ]);
    }
}
