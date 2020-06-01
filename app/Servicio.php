<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servicio extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    public function turnos()
    {
        return $this->hasMany(Turno::class);
    }
    //hay que asegurarse que no traiga de la base de datos los servicios borrados
    public function turnosEnEspera()
    {
        return Turno::where([['servicio_id', $this->id], ['finalizado', false] /*, ['deleted_at', '<>', true]*/])->get();
    }
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
    //many to many
    public function horarios()
    {
        return $this->belongsToMany(Horario::class,'horarios_servicios');
    }
}
