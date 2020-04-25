@include('raiz')

<div class="card">
    <div class="card-header">
        <h3>Creacion de Horario Laboral</h3>
        <ul>
            <li>El horario implica que se trabaja de corrido desde la hora de inicio a la hora de fin</li>
            <li>Recuerde que puede crear mas de un horario, es por eso que se solicita dar un nombre al horario</li>
        </ul>
    </div>
    <form class="form-group " method="POST" action="{{route("horarios.save")}}" >
    <div class="card-body">
        @include('messageError')
        <div class="form-group">
            <label for="nombre">Nombre del Horario</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}"placeholder="Por ej. Horario Nocturno" required>
        </div>
        <label for="">Dias Semanales</label>
        <div class="row">
            @foreach ($dias as $dia)
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" value="{{$dia->id}}" name="dias[]" id="dia+{{$dia->id}}" @if(is_array(old('dias')) && in_array($dia->id, old('dias'))) checked @endif>
                <label class="custom-control-label" for="dia+{{$dia->id}}">{{$dia->dia}}</label>
            </div>
            @endforeach
        </div>
        <div class="form-group">
            <label for="horaComienzo">Hora de Comienzo</label>
            <input type="time" class="form-control" id="horaComienzo" name="comienzo" value="{{ old('comienzo') }}" step="1800" required>
        </div>
        <div class="form-group">
            <label for="horaFin">Hora de Fin</label>
            <input type="time" class="form-control" id="horaFin" name="fin" step="1800" value="{{ old('fin') }}" required>
        </div>
        {{-- <div class="form-group">
            <label for="duracion">Duracion de cada Turno</label>
            <input type="time" class="form-control" id="duracion" name="intervalo" step="3600" max="03:00" required>
        </div> --}}
    </div>
    <button type="submit" class="btn btn-secondary">Crear</button>
        @csrf
    </form>

</div>
