<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $fillable = [
        'nombre',
        'tipo',
        'marca',
        'modelo',
        'num_serie',
        'estado',
        'cantidad_total',
        'cantidad_disponible',
        'foto',
        'qr_code',
        'descripcion',
    ];

    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'equipo_evento')
            ->withPivot([
                'cantidad_salida',
                'cantidad_retorno',
                'estado_retorno',
                'observaciones',
            ])
            ->withTimestamps();
    }
}
