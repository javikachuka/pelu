<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    public function turno()
    {
        return $this->belongsTo(Turno::class);
    }
}
