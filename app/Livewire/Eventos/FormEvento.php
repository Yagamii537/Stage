<?php

namespace App\Livewire\Eventos;

use App\Models\Evento;
use App\Models\Equipo;
use App\Models\Responsable;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.stage')]
class FormEvento extends Component
{
    public ?int $evento_id = null;
    public string $nombre = '';
    public ?string $fecha_evento = null;
    public ?string $hora_inicio = null;
    public ?string $hora_fin = null;
    public ?string $lugar = null;
    public ?string $cliente = null;
    public ?int $responsable_id = null;
    public string $estado = 'planificado';
    public ?string $notas = null;

    /** @var array<int,int> equipo_id => cantidad_salida */
    public array $items = [];

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'fecha_evento' => 'required|date',
        'hora_inicio' => 'nullable',
        'hora_fin' => 'nullable',
        'lugar' => 'nullable|string|max:255',
        'cliente' => 'nullable|string|max:255',
        'responsable_id' => 'nullable|exists:responsables,id',
        'estado' => 'required|in:planificado,en_curso,finalizado,cancelado',
        'notas' => 'nullable|string',
        'items.*' => 'nullable|integer|min:0',
    ];

    public function mount(Evento $evento = null): void
    {
        if ($evento && $evento->exists) {
            $this->evento_id = $evento->id;
            $this->nombre = $evento->nombre;
            $this->fecha_evento = $evento->fecha_evento?->format('Y-m-d');
            $this->hora_inicio = $evento->hora_inicio;
            $this->hora_fin = $evento->hora_fin;
            $this->lugar = $evento->lugar;
            $this->cliente = $evento->cliente;
            $this->responsable_id = $evento->responsable_id;
            $this->estado = $evento->estado;
            $this->notas = $evento->notas;

            // cargar cantidades actuales
            foreach ($evento->equipos as $equipo) {
                $this->items[$equipo->id] = $equipo->pivot->cantidad_salida;
            }
        }
    }

    public function guardar()
    {
        $this->validate();

        $data = [
            'nombre' => $this->nombre,
            'fecha_evento' => $this->fecha_evento,
            'hora_inicio' => $this->hora_inicio,
            'hora_fin' => $this->hora_fin,
            'lugar' => $this->lugar,
            'cliente' => $this->cliente,
            'responsable_id' => $this->responsable_id,
            'estado' => $this->estado,
            'notas' => $this->notas,
        ];

        if ($this->evento_id) {
            $evento = Evento::findOrFail($this->evento_id);
            $evento->update($data);
        } else {
            $evento = Evento::create($data);
            $this->evento_id = $evento->id;
        }

        // procesar equipos y cantidades
        $syncData = [];
        foreach ($this->items as $equipoId => $cantidad) {
            $cantidad = (int) $cantidad;
            if ($cantidad <= 0) {
                continue;
            }

            $equipo = Equipo::findOrFail($equipoId);

            if ($cantidad > $equipo->cantidad_disponible) {
                $this->addError(
                    'items.' . $equipoId,
                    'No hay suficiente stock. Disponible: ' . $equipo->cantidad_disponible
                );
                return;
            }

            // descuento del stock disponible (solo en creación inicial; para versión simple)
            if (!$this->evento_id || !$evento->wasRecentlyCreated) {
                // para no complicar, solo manejamos bien la creación;
                // luego hacemos módulo para retorno y ajustes finos
            }

            $syncData[$equipoId] = [
                'cantidad_salida' => $cantidad,
                'cantidad_retorno' => 0,
                'estado_retorno' => 'pendiente',
                'observaciones' => null,
            ];
        }

        if (!empty($syncData)) {
            $evento->equipos()->sync($syncData);
        } else {
            $evento->equipos()->detach();
        }

        session()->flash('message', 'Evento guardado correctamente.');

        return redirect()->route('eventos.index');
    }

    public function render()
    {
        $responsables = Responsable::orderBy('nombre')->get();
        $equipos = Equipo::orderBy('nombre')->get();

        return view('livewire.eventos.form-evento', [
            'responsables' => $responsables,
            'equipos' => $equipos,
        ]);
    }
}
