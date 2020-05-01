<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $guarded = [];
    public function turnos()
    {
        return $this->hasMany(Turno::class);
    }
}
