@extends('admin.index')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-auto">
                <h3>Detalles del Turno
                    <div class="badge badge-info">
                        {{$turno->id}}
                    </div>
                </h3>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <td width="30%">
                            <strong>Cliente:</strong> {{$turno->usuario->name}} {{$turno->usuario->apellido}}
                        </td>
                        <td width="20%">
                            <strong>Dni:</strong> {{$turno->usuario->dni}}
                        </td>
                        <td width="20%">
                            <strong>Edad:</strong> {{$turno->usuario->getEdad()}}
                        </td>
                    </tr>
                    <tr>
                        <td width="20%">
                            <strong>Dia del Turno:</strong> {{$turno->getFecha()}}
                        </td>
                        <td width="20%">
                            <strong>Hora del Turno:</strong> {{$turno->hora}}
                        </td>
                        <td width="20%">
                            <strong>Estado:</strong>
                            @if ($turno->finalizado)
                            <span class="badge badge-success">Realizado</span>
                            @else
                            <span class="badge badge-danger">Pendiente</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">
                            <strong>Servicio:</strong> {{$turno->servicio->servicio}}
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Fotos:</strong></td>
                    </tr>
                </tbody>
            </table>
            @if (!$turno->fotos->isEmpty())
            @foreach ($turno->fotos as $foto)
            <div class="row">
                <div class="col text-center">
                    <img class="center"  src="{{asset($foto->uri)}}" height="640" width="520">
                </div>
            </div>
            <br>
            @endforeach
            @else
            <div class="row ">
                <div class="col text-center">
                    <div class="text-muted center">No se sacaron fotos en este turno...</div>
                </div>
            </div>
            @endif
        </div>
    </div>

</div>
@endsection

