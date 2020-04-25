<?php

namespace App\Http\Controllers;

use App\Horario;
use Illuminate\Http\Request;

class TurnoController extends Controller
{
    public function create(){
        return view('turnos.create');
    }

    public function get(){
        $horarios = Horario::all() ;
        return $horarios ;
    }
}
