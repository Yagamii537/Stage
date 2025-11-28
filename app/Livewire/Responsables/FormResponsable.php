<?php

namespace App\Livewire\Responsables;

use App\Models\Responsable;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.stage')]
class FormResponsable extends Component
{
    public ?int $responsable_id = null;
    public string $nombre = '';
    public ?string $telefono = null;
    public ?string $email = null;
    public ?string $rol = null;
    public ?string $notas = null;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'telefono' => 'nullable|string|max:50',
        'email' => 'nullable|email|max:255',
        'rol' => 'nullable|string|max:100',
        'notas' => 'nullable|string',
    ];

    public function mount(Responsable $responsable = null): void
    {
        if ($responsable && $responsable->exists) {
            $this->responsable_id = $responsable->id;
            $this->nombre = $responsable->nombre;
            $this->telefono = $responsable->telefono;
            $this->email = $responsable->email;
            $this->rol = $responsable->rol;
            $this->notas = $responsable->notas;
        }
    }

    public function guardar()
    {
        $this->validate();

        $data = [
            'nombre' => $this->nombre,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'rol' => $this->rol,
            'notas' => $this->notas,
        ];

        if ($this->responsable_id) {
            Responsable::findOrFail($this->responsable_id)->update($data);
            session()->flash('message', 'Responsable actualizado correctamente.');
        } else {
            Responsable::create($data);
            session()->flash('message', 'Responsable creado correctamente.');
        }

        return redirect()->route('responsables.index');
    }

    public function render()
    {
        return view('livewire.responsables.form-responsable');
    }
}
