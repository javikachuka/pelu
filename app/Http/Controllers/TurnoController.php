<?php

namespace App\Http\Controllers;

use App\Horario;
use App\Servicio;
use App\Turno;
use Illuminate\Http\Request;

class TurnoController extends Controller
{
    public function create(){
        $servicios = Servicio::all() ;
        return view('turnos.create' , compact('servicios'));
    }

    public function get($servicio, $fecha){

        $horarios = Horario::all() ;
        $turnos = Turno::where('fecha',$fecha)->get() ;

        if($turnos->isEmpty()){
            return 0 ;
        }else{
            return $turnos ;
        }
    }
}
