<?php

namespace App\Http\Controllers;

use App\Dia;
use App\Horario;
use App\Servicio;
use App\Turno;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TurnoController extends Controller
{
    public function create()
    {
        $servicios = Servicio::all();
        return view('turnos.createJavi', compact('servicios'));
    }

    public function get(Request $request)
    {
        $newDate = date("d/m/Y", strtotime($request->fecha));
        $turnosMismaFecha = Turno::where('fecha', $newDate)->where('finalizado', false)->get();
        //verificamos si hay turnos el mismo dia

        if (sizeof($turnosMismaFecha) > 0) {
            //se busca el servicio que selecciono el cliente
            $servicio = Servicio::find($request->servicio);

            //numero del dia de la semana empezando por Domingo(0), Lunes(1)
            $dia = $newDate->isoFormat('d');
            //todos los horarios que tienen el dia seleccionado
            $horariosLaboral = Horario::where('dia_id', $dia)->get();
            $horariosDisponibles = collect();

            foreach ($horariosLaboral as $key => $horario) {
                //buscamos todos los turnos de ese dia por ejemplo todos los turnos del Lunes ordenados por hora
                $turnosMismaFecha = Turno::where('fecha', $newDate)->where('finalizado', false)->where('horario_id', $horario->id)->orderBy('hora', 'asc')->get();

                $horaActual = $horario->comienzo;
                //si existen turnos se extraen los espacios en blancos o heucos
                if (sizeof($turnosMismaFecha) > 0) {
                    $guardarEspacios = collect();

                    foreach ($turnosMismaFecha as  $turno) {
                        $horaAnterior = $horaActual;
                        $horaActual = $turno->hora;
                        //calcular la diferencia entre las dos horas debe devolver en minutos
                        //******************************************************************************************** */
                    }
                } else {
                    //si no hay turnos simplemente separamos el horario por los intervalos del servicio.
                    $intervalo = '+' . $servicio->duracion . ' minute';
                    while ($horaActual < $horario->fin) {
                        $horaDespues = strtotime($intervalo, $horaActual);
                        $horariosDisponibles->add($horaActual . ' - ' . $horaDespues);
                        $horaActual = $horaDespues;
                    }
                }
            }
        } else {
        }
        $horarios = Horario::all();

        return $horarios;
    }




    public function getIntervalos(Request $request){
        // return $request ;
        $this->validacionCamposTurno($request);

        $turnos = Turno::where('fecha' , $request->fecha)->get() ;

        if($turnos->isEmpty()){
            $f = Carbon::createFromFormat('d/m/Y',$request->fecha) ;
            $dia = Dia::find($f->dayOfWeek);
            foreach($dia->horarios as $h){
                $intervalo = collect() ;
                return $minutos = Carbon::now()->setTimeFrom($h->comienzo)->diffInMinutes() ;

            }
        }
        // return redirect()->route('turnos.createJavi');
    }

    private function validacionCamposTurno(Request $request)
    {
        $rules = [
            'servicio'    => 'required',
            'fecha'      => 'required'
        ];

        $this->validate($request, $rules);
    }
}
