@extends('admin.index')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Creacion de servicios</h3>
        <ul>
            <li>El servicio implica, los servicios que ofrece la empresa para sus clientes</li>
            <li>La duracion del servicio se utilzara para calcular los turnos de sus clientes</li>
        </ul>
    </div>
    <form class="form-group " method="POST" action="{{route("servicios.save")}}">
        <div class="card-body">
            @include('messageError')
            <div class="form-group">
                <label for="servicio">Nombre del Servicio</label>
                <input type="text" class="form-control" id="servicio" name="servicio" value="{{ old('servicio') }}"
                    placeholder="Por ej. Corte de Cabello Masculino" required>
            </div>
            <div class="form-group">
                <label for="duracion">Duracion del servicio (Minutos)</label>
                <input type="number" class="form-control" id="duracion" name="duracion" min="15" max="300" value="{{ old('duracion') }}"
                    required>
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
