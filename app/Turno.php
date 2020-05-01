<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $guarded = [];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }
}
