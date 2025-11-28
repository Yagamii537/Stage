<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'rol',
        'notas',
    ];

    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }
}
