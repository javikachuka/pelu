@extends('raiz')
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
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Cliente</th>
                    <th>Servicio</th>
                </tr>
            </thead>
            <tbody>
                @if (!$turnos->isEmpty())
                @foreach ($turnos as $turno)
                <tr>
                    <th>{{$turno->id}}</th>
                    <th>{{$turno->getFecha()}}</th>
                    <th>{{$turno->hora}}</th>
                    <td>{{$turno->usuario->name}}</td>
                    <td>{{$turno->servicio->servicio}}</td>
                </tr>
                @endforeach
                @else
                    <td class="text-muted">No hay turnos registrados...</td>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
