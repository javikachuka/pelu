@extends('admin.index')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-auto">
                <h3>Horarios Laborales Creados</h3>
            </div>
            <div class="col-md-auto">
                <button type="button" class="btn btn-sm btn-secondary"
                    onclick="location.href='{{ route('horarios.create')}}'"><i class="fas fa-plus"></i></button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-responsive table-bordered table-striped table-hover dataTable">
            <thead class="thead-dark">
                <tr>
                    <th width="15%">Nombre</th>
                    <th width="15%">Dias de Trabajo</th>
                    <th width="10%">Hora de Comienzo</th>
                    <th width="10%">Hora de Fin</th>
                    <th width="10%">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if (!$horarios->isEmpty())
                @foreach ($horarios as $horario)
                <tr>
                    <th>{{$horario->nombre}}</th>
                    <th>
                    @foreach ($horario->dias as $dia)
                        <span class="badge badge-info">{{$dia->dia}}</span>
                    @endforeach
                    </th>
                    <th>{{$horario->comienzo}}</th>
                    <td>{{$horario->fin}}</td>
                    <td class="d-flex justify-content-center ">
                        <a class="p-1 text-primary"><i class="fal fa-edit"></i></a>
                        <form id="form-borrar{{$horario->id}}" method="POST"
                            action="{{route('horarios.delete' , $horario->id)}}"
                            style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Esta seguro que quiere borrar este horario?');" class="btn btn-link p-1 text-danger"><i
                                class="fal fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
