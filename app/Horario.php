<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Horario extends Model
{
    use SoftDeletes ;

    protected $guarded = [] ;

    public function dias()
    {
        return $this->belongsToMany(Dia::class, 'dias_horarios');
    }
}
