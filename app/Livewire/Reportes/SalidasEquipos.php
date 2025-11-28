<?php

namespace App\Livewire\Reportes;

use App\Models\Equipo;
use App\Models\Responsable;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.stage')]
class SalidasEquipos extends Component
{
    public ?string $fecha_desde = null;
    public ?string $fecha_hasta = null;
    public ?int $equipo_id = null;
    public ?int $responsable_id = null;
    public string $estado_evento = 'todos'; // todos, planificado, en_curso, finalizado, cancelado

    public function render()
    {
        $query = DB::table('equipo_evento as ee')
            ->join('eventos as e', 'ee.evento_id', '=', 'e.id')
            ->join('equipos as eq', 'ee.equipo_id', '=', 'eq.id')
            ->leftJoin('responsables as r', 'e.responsable_id', '=', 'r.id')
            ->selectRaw('
                ee.id,
                e.id as evento_id,
                e.nombre as evento_nombre,
                e.fecha_evento,
                e.lugar,
                e.estado as evento_estado,
                eq.id as equipo_id,
                eq.nombre as equipo_nombre,
                eq.tipo as equipo_tipo,
                eq.marca as equipo_marca,
                ee.cantidad_salida,
                ee.cantidad_retorno,
                ee.estado_retorno,
                r.nombre as responsable_nombre
            ')
            ->orderByDesc('e.fecha_evento')
            ->orderBy('evento_nombre');

        // ==== FILTROS ====

        // Rango de fechas
        if ($this->fecha_desde && $this->fecha_hasta) {
            $query->whereBetween('e.fecha_evento', [
                $this->fecha_desde,
                $this->fecha_hasta,
            ]);
        } elseif ($this->fecha_desde) {
            $query->whereDate('e.fecha_evento', '>=', $this->fecha_desde);
        } elseif ($this->fecha_hasta) {
            $query->whereDate('e.fecha_evento', '<=', $this->fecha_hasta);
        }

        // Equipo
        if ($this->equipo_id) {
            $query->where('eq.id', $this->equipo_id);
        }

        // Responsable
        if ($this->responsable_id) {
            $query->where('r.id', $this->responsable_id);
        }

        // Estado del evento
        if ($this->estado_evento !== 'todos') {
            $query->where('e.estado', $this->estado_evento);
        }

        // Sin paginación para evitar caché raro: traemos todo según filtros
        $movimientos = $query->get();

        $equipos = Equipo::orderBy('nombre')->get();
        $responsables = Responsable::orderBy('nombre')->get();

        return view('livewire.reportes.salidas-equipos', [
            'movimientos'   => $movimientos,
            'equipos'       => $equipos,
            'responsables'  => $responsables,
        ]);
    }
}
