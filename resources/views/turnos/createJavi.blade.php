@extends('admin.index')

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

    <form class="form-group " method="POST" action="{{route("turnos.save")}}">
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Servicio</label>
                        <select class="form-control" name="servicio" id="servicio" required>
                            <option value="" selected disabled>--Seleccione--</option>
                            @foreach ($servicios as $servicio)
                            <option value="{{$servicio->id}}">{{$servicio->servicio}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div id="info" class="mt-5">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row pt-3">
                    <div class="col-md-5">
                        <label for="datepicker">Dia del Turno</label>
                        <div id="datepicker" data-date="12/03/2012"></div>
                        <input type="hidden" id="my_hidden_input" name="fecha" required>
                    </div>
                    <div class="col-md-4">
                        <label for="">Horario</label>
                        <select class="form-control" name="horario" id="horario" required>
                            <option value="" selected disabled>--Seleccione--</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>
        <div class="float-right mr-4">
            <a href="javascript:history.back()" class="btn btn-danger btn-sm">Cancelar</a>
            <button type="submit" class="btn btn-secondary btn-sm">Reservar Turno</button>
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

            var url = "{{ route('turnos.obtenerIntervalo') }}" ;

            //AJAX
            $.get(url ,{fecha: pickerValor.val(),servicio: $('#servicio').val()} ,function(data){
                console.log(data);
                if(data['disponible']){

                var html_select = '<option value="" selected disabled>--Seleccione--</option>' ;
                var html_select ;
                for (var i = 0; i < data['horariosDisponibles'].length; i++) {
                    html_select += '<option value="'+data['horariosDisponibles'][i]+'">'+data['horariosDisponibles'][i]+'</option>' ;
                }
                $('#horario').html(html_select);
                }else{
                    var html_select = '<option value="" selected disabled>--Seleccione--</option>' ;
                    $('#horario').html(html_select);
                    alert('El dia seleccionado no se realiza el servicio');

                }
            });

    });

    $('#servicio').change(function(){
        var html_select = '<option value="" selected disabled>--Seleccione--</option>' ;
                    $('#horario').html(html_select);
        var id_ser = $(this).val() ;
        var url = "{{ route('servicios.getDuracion' , ':id') }}" ;
        url = url.replace(':id' , id_ser) ;
        var html = '';
        //AJAX
        $.get(url ,function(data){
            console.log(data);
           
            $('#info').html(data);
        },'html');

    }) ;
    //fuente https://api.jquery.com/jQuery.get/
</script>

@endpush