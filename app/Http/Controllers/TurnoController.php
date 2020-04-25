<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TurnoController extends Controller
{
    public function create(){
        return view('turnos.create');
    }
}
