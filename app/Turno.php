<?php

namespace App;

use Carbon\Carbon;
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
    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }

    public function getFecha()
    {
        $f = Carbon::create($this->fecha) ;
        return $f->isoFormat('dddd, D MMM YYYY');
    }
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
