<?php

namespace App\Http\Controllers;

use App\Horario;
use App\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();
        return view('servicios.index', compact('servicios'));
    }


    public function create()
    {
        $horarios=Horario::all();
        return view('servicios.create', compact('horarios'));
    }

    public function save(Request $request)
    {
        DB::beginTransaction();
        
        $this->validacionCamposServicio($request);
        $notificacion = [
            'mensaje' => 'No existen horarios para crear servicios',
            'tipo_alerta' => 'error',
            'accion' => 'Rechazado'
    ];

        if (Horario::count()<=0) {
            return redirect()->route('horarios.create')->with($notificacion);
        }

        $servicio = Servicio::create([
            'servicio' => $request->servicio, 'duracion' => $request->duracion, 'descripcion' => $request->descripcion, 'cantidadPersonas' => $request->cantidadPersonas,
            'empresa_id' => auth()->user()->empresa_id
        ]);
        try {
            if (!is_null($request->fijo)) {
                $servicio->horarios()->sync(Horario::where('fijo', true)->select('id')->get());
            } else {
                if (is_null($request->horariosSeleccionado)) {
                    DB::rollBack();
                    return redirect()->back()->with([
                        'mensaje' => 'No selecciono los horarios',
                        'tipo_alerta' => 'error',
                        'accion' => 'Rechazado'
                ]);
                }
                $servicio->horarios()->sync($request->horariosSeleccionado);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            
            return redirect()->route('servicios.create')->with([
                'mensaje' => 'Hubo un error con  los horarios',
                'tipo_alerta' => 'error',
                'accion' => 'Rechazado'
        ]);
        }
       
        DB::commit();
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
        $dias=collect();
       
        foreach ($servicio->horarios as  $horario) {
            foreach ($horario->dias as $key => $value) {
                $dias->put($key, $value->dia);
            }
        }
        $diasHtml='';
        
        for ($i=0; $i < sizeof($dias) ; $i++) {
            $diasHtml.= $dias[$i] .', ';
        }
     
        $hml='<p>Se atiende los dias '.$diasHtml.' dura apox. '.$servicio->duracion.' </p>';
        return $hml;
    }

   

    public function validacionCamposServicio(Request $request)
    {
        $rules = [
            'servicio'    => 'required|max:255|unique:servicios,servicio',
            'duracion'      => 'required'
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
