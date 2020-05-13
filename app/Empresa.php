<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function usuarios()
    {
        return $this->hasMany(User::class);
    }
    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }
    public function turnos()
    {
        return $this->hasMany(Turno::class);
    }
    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
}
