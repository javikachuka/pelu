@include('raiz')

<div class="card">
    <div class="card-header">
        <h3>Creacion de servicios</h3>
        <ul>
            <li>El servicio implica, los servicios que ofrese la empresa para sus clientes</li>
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
                <input type="number" class="form-control" id="duracion" name="duracion" value="{{ old('duracion') }}"
                    required>
            </div>
        </div>
        <button type="submit" class="btn btn-secondary">Crear</button>
        @csrf
    </form>

</div>