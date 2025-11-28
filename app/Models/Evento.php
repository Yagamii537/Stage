<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = [
        'nombre',
        'fecha_evento',
        'hora_inicio',
        'hora_fin',
        'lugar',
        'cliente',
        'responsable_id',
        'estado',
        'notas',
    ];

    public function responsable()
    {
        return $this->belongsTo(Responsable::class);
    }

    public function equipos()
    {
        return $this->belongsToMany(Equipo::class, 'equipo_evento')
            ->withPivot([
                'cantidad_salida',
                'cantidad_retorno',
                'estado_retorno',
                'observaciones',
            ])
            ->withTimestamps();
    }
}
