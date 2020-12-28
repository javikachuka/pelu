@extends('admin.index')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-auto">
                <h3>Turnos Asignados</h3>
            </div>
            <div class="col-md-auto">
                <button type="button" class="btn btn-sm btn-secondary"
                    onclick="location.href='{{ route('turnos.create')}}'"><i class="fas fa-plus"></i></button>
            </div>
        </div>
    </div>
    <div class="card-body">
        
        
        <table id="turnos" class="table table-responsive table-bordered table-striped table-hover dataTable">
            <thead class="thead-dark">
                <tr>
                    <th width="5%">Hora</th>
                    <th width="5%">Lunes</th>
                </tr>
            </thead>
            <tbody>
                @if (!$turnos->isEmpty())
                @foreach ($turnos as $turno)
                <tr>
                    <td>{{$turno->id}}</td>
                    <td>{{$turno->getFecha()}}</td>
                    <td>{{$turno->hora}}</td>
                    <td>{{$turno->usuario->name}} {{$turno->usuario->apellido}}</td>
                    <td>{{$turno->servicio->servicio}}</td>
                    <td>
                        @if ($turno->finalizado)
                        <span class="badge badge-success">Realizado</span>
                        @else
                        <span class="badge badge-danger">Pendiente</span>
                        @endif
                    </td>
                    <td class="d-flex justify-content-center ">
                        @if ($turno->finalizado)
                        <a class="p-2 text-dark" href="{{route('turnos.show', $turno->id)}}"><i
                                class="fal fa-eye"></i></a>
                        @else
                        <a class="p-2 text-dark" href="{{route('turnos.fotos', $turno->id)}}"><i
                                class="fal fa-camera-retro"></i></a>
                        @endif
                        <a class="p-2 text-success"><i class="fal fa-fast-forward"></i></a>
                        <a class="p-2 text-danger"><i class="fal fa-trash-alt"></i></a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection