<?php

namespace App\Http\Controllers;

use Cardumen\ArgentinaProvinciasLocalidades\Models\Pais;
use Cardumen\ArgentinaProvinciasLocalidades\Models\Provincia;
use Illuminate\Http\Request;

class DireccionController extends Controller
{

    public function obtenerProvincias(Pais $pais){
        return $pais->provincias ;
    }

    public function obtenerLocalidades(Provincia $provincia){
        return $provincia->localidades ;
    }
}
