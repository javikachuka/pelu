<?php

namespace App\Http\Controllers;

use App\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();
        return view('servicios.index', compact('servicios'));
    }


    public function create()
    {
        return view('servicios.create');
    }

    public function save(Request $request)
    {
        $this->validacionCamposServicio($request);

        $servicios = Servicio::create(['servicio' => $request->servicio, 'duracion' => $request->duracion]);

        return redirect()->route('servicios.index');
    }

    public function getDuracion($id){
        $servicio = Servicio::find($id) ;
        return $servicio->duracion ;
    }

    public function validacionCamposServicio(Request $request)
    {
        $rules = [
            'servicio'    => 'required|max:255|unique:servicios,servicio',
            'duracion'      => 'required|integer'
        ];


        $this->validate($request, $rules);
    }
}
