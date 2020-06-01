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
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
    //many to many
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'horarios_servicios');
    }
}
