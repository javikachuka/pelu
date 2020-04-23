<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    public function horarios()
    {
        return $this->belongsToMany(Horario::class, 'dias_horarios');
    }
}
