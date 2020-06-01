@extends('admin.index')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Creacion de servicios</h3>
        <ul>
            <li>El servicio implica, los servicios que ofrece la empresa para sus clientes</li>
            <li>La duracion del servicio se utilzara para calcular los turnos de sus clientes</li>
            <li>La cantidad de personas que pueden ser atendidas al mismo tiempo en el servicio (Corte de cabello hay
                dos peluqueros entonces 2 peronas pueden ser atendidas)</li>
            <li>La descripcion permite explicar al cliente como se realiza el servicio (¡Atraelo!)</li>
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
                <label for="duracion">Duracion del Servicio (HORA:MINUTO)</label>
                <input type="time" class="form-control" id="duracion" name="duracion" value="{{ old('duracion') }}"
                    step="1800" required>
            </div>
            <div class="form-group">
                <label for="cantidadPersonas">Cantidad de Personas</label>
                <input type="number" class="form-control" id="cantidadPersonas" name="cantidadPersonas" min="1"
                    value="{{ old('cantidadPersonas') }}" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <textarea name="descripcion" id="descripcion" cols="30" rows="2" class="form-control"
                    value={{ old('descripcion') }}> </textarea>
            </div>
            <hr>
            <h3> Horarios</h3>
            <div class="form-group">
                <label for="descripcion">Utilizar Horarios Fijos: <div class="icheck-success d-inline">
                        <input type="checkbox" checked name="fijo" id="fijo">
                        <label for="fijo">
                        </label>
                    </div>
                </label>
            </div>
            <div class="form-group">

                <label for="descripcion">Utilizar Horario Personalizado</label>
                <select name="horariosSeleccionado[]" id="horariosSeleccionado" class="select2 form-control"
                    multiple="multiple" data-placeholder="Puede seleccionar muchos horarios" disabled>
                    @foreach ($horarios as $horario)
                    <option value="{{$horario->id}}">{{$horario->nombre}}</option>
                    @endforeach
                </select>

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
    $(document).ready(
        function(){
            $('#horariosSeleccionado').removeAttr('disabled');
            $('#horariosSeleccionado').attr('disabled',true);
            $('#fijo').removeAttr('checked');
            $('#fijo').attr('checked',true);
        }
    );
    $('#fijo').change(
        function(){

            if($('#fijo').is(':checked')){
                $('#horariosSeleccionado').attr('disabled',true);
                $('#horariosSeleccionado').attr('required');
            }else{ 
                $('#horariosSeleccionado').removeAttr('disabled');
                $('#horariosSeleccionado').removeAttr('required');
            }
        }
    );

</script>
@endpush