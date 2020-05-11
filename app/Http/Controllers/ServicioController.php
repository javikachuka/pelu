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

        $notificacion = array(
            'mensaje' => 'Servicio creado correctamente!',
            'tipo_alerta' => 'success',
            'accion' => 'Guardado'
        );
        return redirect()->route('servicios.index')->with($notificacion);
    }

    public function getDuracion($id)
    {
        $servicio = Servicio::find($id);
        return $servicio->duracion;
    }

    public function validacionCamposServicio(Request $request)
    {
        $rules = [
            'servicio'    => 'required|max:255|unique:servicios,servicio',
            'duracion'      => 'required|integer'
        ];


        $this->validate($request, $rules);
    }

    public function delete(Request $request, $id)
    {

        $usuarioSesion = auth()->user();
        $servicio = Servicio::find($id);

        if (is_null($servicio)) {
            return redirect()->back()->withErrors('No existe el servicio');
        }

        if (sizeof($servicio->turnosEnEspera()) > 0) {
            return redirect()->back()->withErrors('No se puede borrar los servicios que tienen turnos asignados');
        }
        if ($servicio->delete()) {
            $notificacion = array(
                'mensaje' => 'Servicio borrado correctamente!',
                'tipo_alerta' => 'success',
                'accion' => 'Borrado'
            );
            return redirect()->back()->with($notificacion);
        }
        return redirect()->back()->withErrors('No se pudo eliminar el servicio');
    }
}
