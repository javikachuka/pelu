<?php

namespace App\Http\Controllers;

use App\Dia;
use App\Horario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HorarioController extends Controller
{

    public function index(){
        $horarios = Horario::all() ;
        return view('horarios.index', compact('horarios')) ;
    }

    public function create (){
        $dias = Dia::all();
        return view('horarios.create' , compact('dias')) ;
    }

    public function save(Request $request){
        $this->validacionCamposHorario($request);
        $this->validacionRangoHorario($request);
        $dias = $request->dias ;
        foreach ($dias as $dia ) {
            $diaExistente = Dia::find($dia) ;
            $horarios = $diaExistente->horarios ;
            if(!$horarios->isEmpty()){
                foreach ($horarios as $horario) {
                    $comienzo = Carbon::now()->setTimeFrom($request->comienzo) ;
                    $fin = Carbon::now()->setTimeFrom($request->fin) ;
                    $comienzoRegistrado = Carbon::now()->setTimeFrom($horario->comienzo) ;
                    $finRegistrado = Carbon::now()->setTimeFrom($horario->fin) ;
                    if($comienzo->lessThanOrEqualTo($finRegistrado)){
                        return redirect()->back()->withErrors([
                            'existencia' => 'Uno de los dias marcados ya tiene registrado un horario en las horas seleccionadas, ingrese un horario o dia diferente por favor'
                        ]) ;

                    }
                }
            }


        }
        $horario = new Horario() ;
        $horario->nombre = $request->nombre ;
        $horario->comienzo = $request->comienzo ;
        $horario->fin = $request->fin ;
        $horario->save() ;
        return redirect()->route('horarios.index') ;
    }

    private function validacionCamposHorario(Request $request){
        $rules = [
            'nombre'    => 'required|max:255|unique:horarios,nombre' ,
            'dias'      => 'required',
            'comienzo'  => 'required',
            'fin'       => 'required'
        ] ;

        $messages = [
            'dias.required'  =>  'Debe seleccionar al menos un dia'
        ] ;

        $this->validate($request, $rules , $messages);
    }

    private function validacionRangoHorario(Request $request){
        $comienzo = Carbon::now()->setTimeFrom($request->comienzo) ;
        $fin = Carbon::now()->setTimeFrom($request->fin) ;
        if($comienzo->greaterThan($fin)){
            return redirect()->back()->withErrors([
                'comparacion' => 'La hora de comienzo debe ser menor a la hora de fin'
            ]);
        }
    }
}
