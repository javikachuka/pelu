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
    <form class="form-group " method="POST" action="{{route("users.save")}}">
        <div class="card-body">
            <label for="datepicker">Dia del Turno</label>
            <div id="datepicker" data-date="12/03/2012"></div>
            <input type="hidden" id="my_hidden_input">
            <label for="">Horario</label>
            <select class="form-control" name="horario" id="horario" required>
                <option value="" selected disabled>--Seleccione--</option>
            </select>
        </div>
        <button type="submit" class="btn btn-secondary">Crear</button>
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
        $('#my_hidden_input').val(
            $('#datepicker').datepicker('getFormattedDate')
        );

            var url = "{{ route('turnos.obtener') }}" ;
            //AJAX
            $.get(url , function(data){
                console.log(data);
                var html_select = '<option value="" selected disabled>--Seleccione--</option>' ;
                var html_select ;
                for (var i = 0; i < data.length; i++) {
                    html_select += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>' ;
                }
                $('#horario').html(html_select);
        });
    });
</script>

@endpush
