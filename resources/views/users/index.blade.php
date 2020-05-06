@extends('admin.index')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-auto">
                <h3>Clientes Registrados</h3>
            </div>
            <div class="col-md-auto">
                <button type="button" class="btn btn-sm btn-secondary"
                    onclick="location.href='{{ route('users.create')}}'"><i class="fas fa-plus"></i></button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-responsive table-bordered table-striped table-hover dataTable">
            <thead class="thead-dark">
                <tr>
                    <th width="5%">#</th>
                    <th width="10%">Nombre</th>
                    <th width="10%">Apellido</th>
                    <th width="10%">DNI</th>
                    <th width="15%">Fecha de Nacimiento</th>
                    <th width="10%">Edad</th>
                    <th width="10%">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->apellido}}</td>
                    <td>{{$user->dni}}</td>
                    <td>{{$user->getFecha()}}</td>
                    <td>{{$user->getEdad()}} años</td>
                    <td class="d-flex justify-content-center ">
                        <a class="p-1 text-primary"><i class="fal fa-edit"></i></a>
                        <a class="p-1 text-danger"><i class="fal fa-trash-alt"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
