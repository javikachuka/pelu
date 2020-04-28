<?php

namespace App\Http\Controllers;

use App\Horario;
use App\Servicio;
use App\Turno;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TurnoController extends Controller
{
    public function create(){
        $servicios = Servicio::all() ;
        return view('turnos.create' , compact('servicios'));
    }

    public function get(Request $request)
    {
        $newDate = date("d/m/Y", strtotime($request->fecha));
        $turnosMismaFecha = Turno::where('fecha', $newDate)->where('finalizado', false)->get();
        //verificamos si hay turnos el mismo dia

        if (sizeof($turnosMismaFecha) > 0) {

            $servicio = Servicio::find($request->servicio);

            $dia = Carbon::create($newDate);
            //numero del dia de la semana empezando por Domingo(0), Lunes(1)
            $dia = $dia->isoFormat('d');
            //todos los horarios que tienen el dia seleccionado
            $horariosLaboral = Horario::where('dia_id', $dia)->get();

            $horariosDisponibles = collect();

            
        } else {
        }
        $horarios = Horario::all();

        return $horarios;
    }
}
