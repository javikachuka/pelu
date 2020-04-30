@extends('raiz')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Solicitud de Turno</h3>
        <ul>
            <li>El horario implica que se trabaja de corrido desde la hora de inicio a la hora de fin</li>
            <li>Recuerde que puede crear mas de un horario, es por eso que se solicita dar un nombre al horario</li>
        </ul>
    </div>
    @include('messageError')

    <form class="form-group " method="POST" action="{{route("turnos.obtenerIntervalo")}}">
        <div class="card-body">
            <div class="row">

                <div class="col">
                    <label for="datepicker">Dia del Turno</label>
                    <div id="datepicker" data-date="12/03/2012"></div>
                    <input type="hidden" id="my_hidden_input" name="fecha" required>
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <label for="">Servicio</label>
                    <select class="form-control" name="servicio" id="servicio" required>
                        <option value="" selected disabled>--Seleccione--</option>
                        @foreach ($servicios as $servicio)
                        <option value="{{$servicio->id}}">{{$servicio->servicio}}</option>
                        @endforeach
                    </select>

                </div>
                {{-- <div class="col">
                    <label for="">Horario</label>
                    <select class="form-control" name="horario" id="horario" required>
                        <option value="" selected disabled>--Seleccione--</option>
                    </select>
                </div> --}}
            </div>

        </div>
        <div class="float-right mr-4">
            <a href="javascript:history.back()" class="btn btn-danger btn-sm">Cancelar</a>
            <button type="submit" class="btn btn-secondary btn-sm">Ver horarios disponibles</button>
        </div>
        @csrf
    </form>

</div>
@endsection
@push('scripts')
<script>
    $('#datepicker').datepicker({
        language: 'es' ,
        startDate: new Date(),
    }) ;
    $('#datepicker').on('changeDate', function() {
       var pickerValor= $('#my_hidden_input').val(
            $('#datepicker').datepicker('getFormattedDate')
        );

            /*var url = "{{ route('turnos.obtener') }}" ; */

            //AJAX
            /*
            $.get(url ,{fecha: pickerValor.val(),servicio: $('#servicio').val()} ,function(data){
                console.log(data);
                var html_select = '<option value="" selected disabled>--Seleccione--</option>' ;
                var html_select ;
                for (var i = 0; i < data.length; i++) {
                    html_select += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>' ;
                }
                $('#horario').html(html_select);
            });
            */
    });
</script>

@endpush
