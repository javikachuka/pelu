<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    // empleados
    public function empleados()
    {
        return $this->hasMany(User::class);
    }
    //usuarios suscriptos
    public function suscriptores()
    {
        return $this->belongsToMany(User::class, 'suscripciones', 'empresa_id', 'user_id');
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
    public function rubros(){
        return $this->belongsToMany(Rubro::class, 'rubro_id');
    }
}
