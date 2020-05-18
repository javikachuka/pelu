<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Cardumen\ArgentinaProvinciasLocalidades\Models;

class Direccion extends Model
{
    protected $table = 'direcciones';

    public function pais(){
        return $this->hasOne(Pais::class);
    }

    public function provincia(){
        return $this->hasOne(Provincia::class);
    }

    public function localidad(){
        return $this->hasOne(Localidad::class);
    }

    public function empresa(){
        return $this->belongsTo(Empresa::class);
    }
}
