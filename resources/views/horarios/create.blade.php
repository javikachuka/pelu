@extends('admin.index')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Creacion de Horario Laboral</h3>
        <ul>
            <li>El horario implica que se trabaja de corrido desde la hora de inicio a la hora de fin.</li>
            <li>Recuerde que puede crear mas de un horario, es por eso que se solicita dar un nombre al horario.</li>
            <li>


                <p style="color: red"> ¡IMPORTANTE!
                    Si el horario fijo esta seleccionado se utilizara ese
                    horario
                    para todos los servicios que se creen despues.
                </p>

            </li>
        </ul>
    </div>
    <form class="form-group " method="POST" action="{{route("horarios.save")}}">
        <div class="card-body">
            @include('messageError')
            <div class="form-group ">



                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input"  name="fijo" id="fijo">
                    <label for="fijo" class="custom-control-label">Horario Fijo</label>

                </div>

            </div>
            <div class="form-group ">
                <label for="nombre">Nombre del Horario</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}"
                    placeholder="Por ej. Horario Nocturno" required>
            </div>
            <label for="">Dias Semanales</label>
            <div class="form-group">
                <div class="form-check-inline">
                    @foreach ($dias as $dia)
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="{{$dia->id}}" name="dias[]"
                            id="dia+{{$dia->id}}" @if(is_array(old('dias')) && in_array($dia->id, old('dias'))) checked
                        @endif>
                        <label class="custom-control-label pr-4" for="dia+{{$dia->id}}">{{$dia->dia}}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="horaComienzo">Hora de Comienzo</label>
                        <input type="time" class="form-control" id="horaComienzo" name="comienzo"
                            value="{{ old('comienzo') }}" step="1800" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="horaFin">Hora de Fin</label>
                        <input type="time" class="form-control" id="horaFin" name="fin" step="1800"
                            value="{{ old('fin') }}" required>
                    </div>
                </div>
            </div>
            {{-- <div class="form-group">
                <label for="duracion">Duracion de cada Turno</label>
                <input type="time" class="form-control" id="duracion" name="intervalo" step="3600" max="03:00" required>
            </div> --}}
        </div>
        <div class="float-right mr-4">
            <a href="javascript:history.back()" class="btn btn-danger btn-sm">Cancelar</a>
            <button type="submit" class="btn btn-secondary btn-sm">Crear</button>
        </div>
        @csrf
    </form>

</div>
@endsection