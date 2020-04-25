<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $guarded = [] ;

    public function dias()
    {
        return $this->belongsToMany(Dia::class, 'dias_horarios');
    }
}
