<?php

namespace App\Livewire\Responsables;

use App\Models\Responsable;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.stage')]
class IndexResponsables extends Component
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
        $resp = Responsable::findOrFail($id);
        $resp->delete();
        session()->flash('message', 'Responsable eliminado correctamente.');
    }

    public function render()
    {
        $responsables = Responsable::where('nombre', 'like', '%' . $this->search . '%')
            ->orderBy('nombre')
            ->paginate(10);

        return view('livewire.responsables.index-responsables', [
            'responsables' => $responsables,
        ]);
    }
}
