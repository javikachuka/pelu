<?php

namespace App\Http\Controllers;

use App\Dia;
use App\Horario;
use App\Servicio;
use App\Turno;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

define("MINUTOS_ESPACIOS",    10);
class TurnoController extends Controller
{


    public function index()
    {
        $turnos = Turno::all();
        return view('turnos.index', compact('turnos'));
    }


    public function create()
    {
        $servicios = Servicio::all();
        return view('turnos.createJavi', compact('servicios'));
    }

    public function save(Request $request)
    {
        $turno = new Turno;
        $f = Carbon::createFromFormat('d/m/Y', $request->fecha);

        $turno->fecha = $f;
        $turno->hora = $request->horario;
        $turno->finalizado = false;
        $turno->user_id = auth()->user()->id;
        $turno->servicio_id = $request->servicio;
        $dia = Dia::find($f->dayOfWeek) ;
        foreach($dia->horarios as $h){ //este codigo sirve para poder asignar el turno a un horario
            $comienzo = Carbon::now()->setTimeFrom($h->comienzo) ;
            $fin = Carbon::now()->setTimeFrom($h->fin) ;
            $hora = Carbon::now()->setTimeFrom($request->horario);
            if($hora->between($comienzo,$fin)){
                $turno->horario_id = $h->id;
            }
        }
        $turno->save();
        return redirect()->route('turnos.index');
    }

    public function getIntervalos(Request $request)
    {

        $newDate = $this->cambiarFormatoFecha($request->fecha);

        $fechaSeleccionada =  date($newDate);
        //se busca el servicio que selecciono el cliente
        $servicio = Servicio::find($request->servicio);

        //numero del dia de la semana empezando por Domingo(0), Lunes(1)
        $dia = date('N', strtotime($newDate));
        $day = Dia::find($dia);
        //todos los horarios que tienen el dia seleccionado
        $horariosLaboral = $day->horarios;

        if (sizeof($horariosLaboral) <= 0) {

            return 'el dia seleccionado no tiene horario';
        }
        $fechaDeHoy = date('Y-m-d');
        //si la fecha seleccionada es hoy la variable de $esHoy es true
        $esHoy = false;
        if ($fechaDeHoy == $newDate) {
            $esHoy = true;
        }

        $horariosDisponibles = collect();

        foreach ($horariosLaboral as $key => $horario) {
            //buscamos todos los turnos de ese dia por ejemplo todos los turnos del Lunes ordenados por hora
            $turnosMismaFecha = Turno::where('fecha', $fechaSeleccionada)->where('finalizado', false)->where('horario_id', $horario->id)->orderBy('hora', 'asc')->get();

            //si existen turnos se extraen los espacios en blancos o heucos
            if (sizeof($turnosMismaFecha) > 0) {
                $horaActual = $horario->comienzo;
                $horaAnterior = $horaActual;

                foreach ($turnosMismaFecha as  $turno) {
                    $horaActual = $turno->hora;
                    if ($esHoy) {
                        if ($turno->hora >= date('H:i:s')) {
                            $horaAnterior = date('H:i:s');
                        } else {
                            //La hora del turno ya paso asi que pasamos al otro turno
                            $diferenciahora = date("H:i:s", strtotime("00:00:00"));
                        }
                    } else {

                        $diferenciahora = date("H:i:s", strtotime("00:00:00") + strtotime($horaActual) - strtotime($horaAnterior));
                    }
                    $minutos = intval($this->todoMinutos($diferenciahora));

                    if (($minutos) >= $servicio->duracion) {

                        $cantidadIntervalos = intval($minutos / $servicio->duracion);
                        //se agregan todos las horas disponibles en intervalos de la duracion del servicio
                        for ($i = 0; $i < $cantidadIntervalos; $i++) {

                            $horariosDisponibles->add($horaAnterior);
                            $horaAnterior = $this->sumarMinutos($horaAnterior, $servicio->duracion);
                        }
                        $horaAnterior = $this->sumarMinutos($horaActual, $turno->servicio->duracion);
                    } else {
                        $horaAnterior = $this->sumarMinutos($horaActual, $turno->servicio->duracion);
                    }
                }
                //se mide el ultimo turno con la hora final del dia laboral
                $horaActual = $horario->fin;
                $diferenciahora = date("H:i:s", strtotime("00:00:00") + strtotime($horaActual) - strtotime($horaAnterior));
                $minutos = intval($this->todoMinutos($diferenciahora));
                if (($minutos) >= $servicio->duracion) {

                    $cantidadIntervalos = intval($minutos / $servicio->duracion);
                    //se agregan todos las horas disponibles en intervalos de la duracion del servicio
                    for ($i = 0; $i < $cantidadIntervalos; $i++) {
                        if ($esHoy) {
                            $horaDeHoy = date('H:i:s');
                            if ($horaAnterior >= $horaDeHoy) {
                                $horariosDisponibles->add($horaAnterior);
                            }
                            $horaAnterior = $this->sumarMinutos($horaAnterior, $servicio->duracion);
                        } else {
                            $horariosDisponibles->add($horaAnterior);
                            $horaAnterior = $this->sumarMinutos($horaAnterior, $servicio->duracion);
                        }
                    }
                }
                // return $horariosDisponibles;
            } else {
                //si no hay turnos simplemente separamos el horario por los intervalos del servicio.
                if ($esHoy) {
                    if (($horario->fin >= date('H:i:s'))) {
                        $horaAnterior = date('H:i:s');
                    } else {
                        $horaAnterior = $horario->fin;
                    }
                } else {
                    $horaAnterior = $horario->comienzo;
                }


                $diferenciahora = date("H:i:s", strtotime("00:00:00") + strtotime($horario->fin) - strtotime($horaAnterior));
                $minutos = intval($this->todoMinutos($diferenciahora));

                $cantidadIntervalos = intval($minutos / $servicio->duracion);

                for ($i = 0; $i < $cantidadIntervalos; $i++) {

                    $horariosDisponibles->add($horaAnterior);
                    $horaAnterior = $this->sumarMinutos($horaAnterior, $servicio->duracion);
                }
            }
        }


        return $horariosDisponibles;
        $horarios = Horario::all();

        return $horarios;
    }

    //cambia de dia/mes/año a año-med-dia
    public function cambiarFormatoFecha($fecha)
    {
        $fch = explode("/", $fecha);
        $tfecha = $fch[2] . "-" . $fch[1] . "-" . $fch[0];
        return $tfecha;
    }
    //cambia la hora a minutos ejemlo 08:10:20 tranforma todo a minutos
    public function todoMinutos($hora)
    {
        $fch = explode(":", $hora);
        $minutos = intval($fch[1]) + (intval($fch[0]) * 60);
        return $minutos;
    }
    public function sumarMinutos($hora, int $minutos)
    {
        $fch = explode(":", $hora);
        $minutosTotal = intval($fch[1]) + $minutos;
        $horasFaltante = intval($minutosTotal / 60);
        $horasTotal = intval($fch[0]) + ($horasFaltante);

        $minutoFinal = $minutosTotal - ($horasFaltante * 60);

        if ($minutoFinal < 10) {
            $minutoFinal = '0' . $minutoFinal;
        }
        if ($horasTotal < 10) {
            $horasTotal = '0' . $horasTotal;
        }
        return $horasTotal . ':' . $minutoFinal . ':00';
    }


    public function getIntervalos2(Request $request)
    {
        // return $request ;
        $this->validacionCamposTurno($request);
        $turnos = Turno::where('fecha', $request->fecha)->get();
        $servicio = Servicio::find($request->servicio);

        if ($turnos->isEmpty()) {
            $f = Carbon::createFromFormat('d/m/Y', $request->fecha);
            $dia = Dia::find($f->dayOfWeek);
            $intervalo = collect();
            $aumento = $servicio->duracion;
            foreach ($dia->horarios as $h) {
                $minutosComienzo = (Carbon::now()->setTimeFrom($h->comienzo)->hour) * 60;
                $minutosComienzo += Carbon::now()->setTimeFrom($h->comienzo)->minute;
                $minutosFin = (Carbon::now()->setTimeFrom($h->fin)->hour) * 60;
                $minutosFin += Carbon::now()->setTimeFrom($h->fin)->minute;
                for ($minutosComienzo; $minutosComienzo < $minutosFin; $minutosComienzo += $aumento) {
                    $intervalo->add($this->hoursandmins($minutosComienzo));
                }
            }
            return $intervalo;
        }
        // return redirect()->route('turnos.createJavi');
    }

    private function hoursandmins($time, $format = '%02d:%02d')
    {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }

    public function fotos(){
        return view('turnos.fotos') ;
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
