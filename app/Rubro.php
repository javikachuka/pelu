<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubro extends Model
{
    protected $table = 'rubros';

    public function empresas(){
        return $this->belongsToMany(Empres::class, 'empresa_id');
    }
}
