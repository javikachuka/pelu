<?php

namespace App\Http\Controllers;

use App\Dia;
use App\Horario;
use Illuminate\Http\Request;

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
        $horario = new Horario() ;
        $horario->nombre = $request->nombre ;
        $horario->comienzo = $request->comienzo ;
        $horario->fin = $request->fin ;
        $horario->save() ;
        return redirect()->route('horarios.index') ;
    }
}
