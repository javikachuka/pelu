@extends('admin.index')


@section('content')

<div class="card">
    <div class="card-header">
        <h3>Registro de Usuario</h3>
        <ul>
            <li>El horario implica que se trabaja de corrido desde la hora de inicio a la hora de fin</li>
            <li>Recuerde que puede crear mas de un horario, es por eso que se solicita dar un nombre al horario</li>
        </ul>
    </div>
    @include('messageError')
    <form class="form-group " method="POST" action="{{route("users.save")}}">
        <div class="card-body">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="name" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="dni">DNI</label>
                    <input type="text" class="form-control" id="dni" name="dni" required>
                </div>
                <div class="col-md-6">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                </div>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" required class="form-control" value="">
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" value="" required>
            </div>
        </div>
        <div class="float-right mr-4">
            <a href="javascript:history.back()" class="btn btn-danger btn-sm">Cancelar</a>
            <button type="submit" class="btn btn-secondary btn-sm">Crear</button>
        </div>
        @csrf
    </form>

</div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $('#dni').inputmask("99.999.999");
        });
    </script>
@endpush
