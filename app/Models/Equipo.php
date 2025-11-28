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
}
