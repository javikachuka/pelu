<?php

namespace App\Http\Controllers;

use App\Dia;
use App\Horario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HorarioController extends Controller
{
    public function index()
    {
        $horarios = Horario::all();
        return view('horarios.index', compact('horarios'));
    }

    public function create()
    {
        $dias = Dia::all();
        return view('horarios.create', compact('dias'));
    }

    public function save(Request $request)
    {
        $this->validacionCamposHorario($request);
        $comienzo = Carbon::now()->setTimeFrom($request->comienzo);
        $fin = Carbon::now()->setTimeFrom($request->fin);
        if ($comienzo->greaterThan($fin)) {
            return redirect()->back()->withErrors([
                'comparacion' => 'La hora de comienzo debe ser menor a la hora de fin'
            ])->withInput();
        }
        $dias = $request->dias;
        // return $dias ;
        foreach ($dias as $dia) {
            $diaExistente = Dia::find($dia);
            $horarios = $diaExistente->horarios;

            if (!$horarios->isEmpty()) {
                foreach ($horarios as $horario) {
                    // $comienzo = Carbon::now()->setTimeFrom($request->comienzo) ;
                    // $fin = Carbon::now()->setTimeFrom($request->fin) ;
                    $comienzoRegistrado = Carbon::now()->setTimeFrom($horario->comienzo);
                    $finRegistrado = Carbon::now()->setTimeFrom($horario->fin);
                    if ($comienzo->between($comienzoRegistrado, $finRegistrado)) {
                        return redirect()->back()->withErrors([
                            'existencia' => 'Uno de los dias marcados ya tiene registrado un horario de comienzo registrado en las hora seleccionada, ingrese un horario o dia diferente por favor'
                        ])->withInput();
                    } else {
                        if ($fin->between($comienzoRegistrado, $finRegistrado)) {
                            return redirect()->back()->withErrors([
                                'existencia' => 'Uno de los dias marcados ya tiene registrado un horario de fin registrado en las hora seleccionada, ingrese un horario o dia diferente por favor'
                            ])->withInput();
                        }
                    }
                }
            }
        }
        $horario = new Horario();
        $horario->nombre = $request->nombre;
        $horario->comienzo = $request->comienzo;
        $horario->fin = $request->fin;
        $horario->fijo = is_null($request->fijo)?0 : 1;
        $horario->empresa_id = auth()->user()->empresa_id;
        $horario->save();
        $horario->dias()->sync($request->dias);
        $notificacion = array(
            'mensaje' => 'Horario creado correctamente!',
            'tipo_alerta' => 'success',
            'accion' => 'Guardado'
        );
        return redirect()->route('horarios.index')->with($notificacion);
    }

    private function validacionCamposHorario(Request $request)
    {
        $rules = [
            'nombre'    => 'required|max:255|unique:horarios,nombre',
            'dias'      => 'required',
            'comienzo'  => 'required',
            'fin'       => 'required'
        ];

        $messages = [
            'dias.required'  =>  'Debe seleccionar al menos un dia'
        ];

        $this->validate($request, $rules, $messages);
    }

    public function delete($id)
    {
        $horario = Horario::find($id);
        $horario->delete();
        $notificacion = array(
            'mensaje' => 'Horario borrado correctamente!',
            'tipo_alerta' => 'success',
            'accion' => 'Borrado'
        );
        return redirect()->route('horarios.index')->with($notificacion);
    }
}
