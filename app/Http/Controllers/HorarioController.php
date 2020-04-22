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
        $this->validacionCamposHorario;
        $comienzo = Carbon::now()->setTimeFrom($request->comienzo) ;
        $fin = Carbon::now()->setTimeFrom($request->fin) ;
        if($comienzo->greaterThan($fin)){
            return redirect()->back()->withErrors([
                'comparacion' => 'La hora de comienzo debe ser menor a la hora de fin'
            ]);
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
            'name'      => 'required|max:255' ,
            'dias[]'    => 'required',
            'comienzo'  => 'required',
            'fin'       => 'required'
        ] ;

        $this->validate($request, $rules);

    }
}
