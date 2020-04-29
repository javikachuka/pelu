@extends('raiz')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-auto">
                <h3>Servicios Creados</h3>
            </div>
            <div class="col-md-auto">
                <button type="button" class="btn btn-sm btn-secondary"
                    onclick="location.href='{{ route('servicios.create')}}'"><i class="fas fa-plus"></i></button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Servicio</th>
                    <th>Duracion (Minutos)</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if (!$servicios->isEmpty())
                @foreach ($servicios as $servicio)
                <tr>
                    <td>{{$servicio->id}}</td>
                    <td>{{$servicio->servicio}}</td>
                    <td>{{$servicio->duracion}}</td>
                    <td class="d-flex justify-content-center ">
                        <a class="p-1 text-primary"><i class="fal fa-edit"></i></a>
                        <a class="p-1 text-danger"><i class="fal fa-trash-alt"></i></a>
                    </td>
                </tr>
                @endforeach
                @else
                <td class="text-muted">No hay servicios registrados...</td>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
