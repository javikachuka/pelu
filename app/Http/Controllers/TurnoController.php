<?php

namespace App\Http\Controllers;

use App\Dia;
use App\Foto;
use App\Horario;
use App\Servicio;
use App\Turno;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Date;

//si quiere que haya un lapso de 30 minutos debe agregar 10 minutos mas osea ingresar 40.
// si ingresa 40 el sistema le calculo los turnos con un minimo de 30 minutos y maximo 40.
define("_MINUTOS_ESPACIOS_", 30);
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

    public function saveFotos(Request $request)
    {
        if ($request->hasFile('fotos')) {
            $path = '/img/fotos/';
            $turno = Turno::find($request->turno_id);
            for ($i = 0; $i < count($request->fotos); $i++) {
                $f = $request->fotos[$i];
                $name = $f->getClientOriginalName();
                try {
                    $img = Image::make($f)->resize(640, 480);
                    $img->save(public_path($path) . $name);
                    $foto = new Foto;
                    $foto->uri = $path . $name;
                    $foto->turno_id = $turno->id;
                    $foto->save();
                } catch (Throwable $th) {
                    return redirect()->route('turnos.index')->withErrors(['fotos' => 'Hubo un error al guardar las fotos']);
                }
            }
            $turno->finalizado = true;
            $turno->update();
            return redirect()->route('turnos.index');
        } else {
            return 0;
        }
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
        $servicio = Servicio::find($request->servicio);
        $turno->empresa_id = $servicio->empresa_id;
        $dia = Dia::find($f->dayOfWeek);
        foreach ($dia->horarios as $h) { //este codigo sirve para poder asignar el turno a un horario
            $comienzo = Carbon::now()->setTimeFrom($h->comienzo);
            $fin = Carbon::now()->setTimeFrom($h->fin);
            $hora = Carbon::now()->setTimeFrom($request->horario);
            if ($hora->between($comienzo, $fin)) {
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

        $duracion = intval($this->todoMinutos($servicio->duracion));
        //numero del dia de la semana empezando por Domingo(0), Lunes(1)
        $dia = date('N', strtotime($newDate));
        $dia = intval($dia) == 7 ? 0 : $dia;
        $day = Dia::find($dia);
        //todos los horarios que tienen el dia seleccionado
        $existeElServicio=false;
        //buscamos si el dia que selecciono el usuario existe.
        foreach ($servicio->horarios as $horario2) {
            foreach ($horario2->dias as  $dia2) {
                if ($dia2->id == $dia) {
                    $existeElServicio=true;
                    break;
                }
            }
            if ($existeElServicio) {
                break;
            }
        }
        if (!$existeElServicio) {
            return ['disponible' => false];
        }


        $horariosLaboral = $servicio->horarios;


        if (sizeof($horariosLaboral) <= 0) {
            return ['disponible' => false];
        }
        $fechaDeHoy = date('Y-m-d');
        //si la fecha seleccionada es hoy la variable de $esHoy es true
        $esHoy = false;
        if ($fechaDeHoy == $newDate) {
            $esHoy = true;
        }

        $horariosDisponibles = collect();
        //permite que se ejecute IF una sola vez
        $sumarUnaVez = true;

        foreach ($horariosLaboral as $key => $horario) {
            //buscamos todos los turnos de ese dia por ejemplo todos los turnos del Lunes ordenados por hora
            $turnosMismaFecha = Turno::where('fecha', $fechaSeleccionada)->where('finalizado', false)->where('horario_id', $horario->id)->orderBy('hora', 'asc')->get();

            //si existen turnos se extraen los espacios en blancos o las horas donde hay lugar para turnos
            if (sizeof($turnosMismaFecha) > 0) {
                $horaActual = $horario->comienzo;
                $horaAnterior = $horaActual;

                foreach ($turnosMismaFecha as  $turno) {
                    $horaActual = $turno->hora;
                    if ($esHoy) {
                        //verificamos si la hora actual esta dentro del horario Laboral
                        if ($horario->fin <= date('H:i:s')) {
                            //no hay minutos disponibles en el horario laboral
                            break;
                        }
                        //si llego aca es porque hay minutos disponibles en el horario laboral
                        if ($sumarUnaVez) {
                            if ($turno->hora >= date('H:i:s')) {
                                $horaAnterior = date('H:i:') . '00';
                                $horaAnterior = $this->sumarMinutos($horaAnterior, _MINUTOS_ESPACIOS_);
                                $horaAnterior = $this->redondearMinuto($horaAnterior);
                                $sumarUnaVez = false;
                            } else {
                                //La hora del turno ya paso asi que pasamos al otro turno
                                $horaAnterior = $horaActual;
                            }
                        }
                    } else {
                    }

                    $diferenciahora = date("H:i:s", strtotime("00:00:00") + strtotime($horaActual) - strtotime($horaAnterior));
                    $minutos = intval($this->todoMinutos($diferenciahora));

                    if (($minutos) >= $duracion) {
                        $cantidadIntervalos = intval($minutos / $duracion);
                        //se agregan todos las horas disponibles en intervalos de la duracion del servicio
                        for ($i = 0; $i < $cantidadIntervalos; $i++) {
                            $horariosDisponibles->add($horaAnterior);
                            $horaAnterior = $this->sumarMinutos($horaAnterior, $duracion);
                        }
                    }
                    $duracionTurno =   intval($this->todoMinutos($turno->servicio->duracion));
                    $horaAnterior = $this->sumarMinutos($horaActual, $duracionTurno);
                }
                //se mide el ultimo turno con la hora final del dia laboral
                $horaActual = $horario->fin;


                $diferenciahora = date("H:i:s", strtotime("00:00:00") + strtotime($horaActual) - strtotime($horaAnterior));
                $minutos = intval($this->todoMinutos($diferenciahora));
                if (($minutos) >= $duracion) {
                    $cantidadIntervalos = intval($minutos / $duracion);
                    //se agregan todos las horas disponibles en intervalos de la duracion del servicio
                    for ($i = 0; $i < $cantidadIntervalos; $i++) {
                        if ($esHoy) {
                            $horaDeHoy = date('H:i:s');
                            if ($horaAnterior >= $horaDeHoy) {
                                $horariosDisponibles->add($horaAnterior);
                            }
                        } else {
                            $horariosDisponibles->add($horaAnterior);
                        }
                        $horaAnterior = $this->sumarMinutos($horaAnterior, $duracion);
                    }
                }
            } else {

                //si no hay turnos simplemente separamos el horario por los intervalos del servicio.
                if ($esHoy) {
                    if (($horario->fin >= date('H:i:s'))) {
                        $horaAnterior = date('H:i:') . '00';
                        $horaAnterior = $this->sumarMinutos($horaAnterior, _MINUTOS_ESPACIOS_);
                        $horaAnterior = $this->redondearMinuto($horaAnterior);
                    } else {
                        $horaAnterior = $horario->fin;
                    }
                } else {
                    $horaAnterior = $horario->comienzo;
                }


                $diferenciahora = date("H:i:s", strtotime("00:00:00") + strtotime($horario->fin) - strtotime($horaAnterior));
                $minutos = intval($this->todoMinutos($diferenciahora));

                $cantidadIntervalos = intval($minutos / $duracion);

                for ($i = 0; $i < $cantidadIntervalos; $i++) {
                    $horariosDisponibles->add($horaAnterior);
                    $horaAnterior = $this->sumarMinutos($horaAnterior, $duracion);
                }
            }
        }


        return ['disponible' => true, 'horariosDisponibles' => $horariosDisponibles];
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

    public function redondearMinuto($hora)
    {
        $fch = explode(":", $hora);
        $valor = substr($fch[1], 0, 1);
        return $fch[0] . ':' . $valor . '0:00';
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

    public function fotos($id)
    {
        $turno = Turno::findOrFail($id);
        $hoy = Carbon::now()->setTime(0, 0, 0);
        $fechaTurno = Carbon::create($turno->fecha);
        if ($hoy->greaterThanOrEqualTo($fechaTurno)) {
            return view('turnos.fotos', compact('turno'));
        } else {
            // alert('Debe ser el dia del turno poder cargar las fotos');
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $turno = Turno::findOrFail($id);
        return view('turnos.show', compact('turno'));
    }

    private function validacionCamposTurno(Request $request)
    {
        $rules = [
            'servicio'    => 'required',
            'fecha'      => 'required'
        ];

        $this->validate($request, $rules);
    }

    public function misTurnos()
    {
        if (auth()->user()) {
            return $turnos = (User::find(auth()->user()->id))->turnos;
        }
        return 1;
    }
}
