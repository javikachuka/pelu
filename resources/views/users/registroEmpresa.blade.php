@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('users.saveRegistroEmpresa') }}">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3>Registro Empresa</h3>
                        <ul>
                            <li>Complete por favor detenidamente cada campo solicitado</li>
                            <li>Ingrese los datos para la cuenta de usuario y luego los datos empresariales</li>
                        </ul>
                    </div>

                    <div class="card-body">

                        <h4>Datos de Usuario</h4>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="apellido" class="col-md-4 col-form-label text-md-right">Apellido</label>

                                    <div class="col-md-6">
                                        <input id="apellido" type="text"
                                            class="form-control @error('apellido') is-invalid @enderror" name="apellido"
                                            value="{{ old('apellido') }}" required autocomplete="apellido" autofocus>

                                        @error('apellido')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="dni" class="col-md-4 col-form-label text-md-right">DNI</label>

                                    <div class="col-md-6">
                                        <input id="dni" type="text"
                                            class="form-control @error('dni') is-invalid @enderror" name="dni"
                                            value="{{ old('dni') }}" required autocomplete="dni" autofocus>

                                        @error('dni')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fecha_nacimiento" class="col-md-4 col-form-label text-md-right">Fecha de
                                        Nacimiento</label>

                                    <div class="col-md-6">
                                        <input id="fecha_nacimiento" type="date"
                                            class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                                            name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required
                                            autocomplete="fecha_nacimiento" autofocus>

                                        @error('fecha_nacimiento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm"
                                        class="col-md-4 col-form-label text-md-right">Confirmar Contraseña</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <h4>Datos Empresariales</h4>
                        <div class="card">
                            <div class="card-body">
                                <label for="">General</label>
                                <div class="form-group row">
                                    <label for="nombreEmpresa" class="col-md-4 col-form-label text-md-right">Nombre de
                                        la Empresa</label>

                                    <div class="col-md-6">
                                        <input id="nombreEmpresa" type="text"
                                            class="form-control @error('nombreEmpresa') is-invalid @enderror"
                                            name="nombreEmpresa" value="{{ old('nombreEmpresa') }}" required
                                            autocomplete="nombreEmpresa" autofocus>

                                        @error('nombreEmpresa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="rubro_id" class="col-md-4 col-form-label text-md-right">Rubro</label>

                                    <div class="col-md-6">
                                        <select name="rubro_id" class=" form-control">
                                            <option value="" selected disabled>--Seleccione--</option>
                                            @foreach ($rubros as $rubro)
                                            <option value="{{$rubro->id}}" @if($rubro->id == old('rubro_id')) selected
                                                @endif>{{$rubro->nombre}}</option>
                                            @endforeach
                                        </select>
                                        @error('rubro_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="emailEmpresa" class="col-md-4 col-form-label text-md-right">Email de la
                                        Empresa</label>

                                    <div class="col-md-6">
                                        <input id="emailEmpresa" type="text"
                                            class="form-control @error('emailEmpresa') is-invalid @enderror"
                                            name="emailEmpresa" value="{{ old('emailEmpresa') }}" required
                                            autocomplete="emailEmpresa" autofocus>

                                        @error('emailEmpresa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="telefonoEmpresa" class="col-md-4 col-form-label text-md-right">Telefono
                                        de la Empresa</label>

                                    <div class="col-md-6">
                                        <input id="telefonoEmpresa" type="text"
                                            class="form-control @error('telefonoEmpresa') is-invalid @enderror"
                                            name="telefonoEmpresa" value="{{ old('telefonoEmpresa') }}" required
                                            autocomplete="telefonoEmpresa" autofocus>

                                        @error('telefonoEmpresa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <label for="">Direccion</label>
                                <div class="form-group row">
                                    <label for="pais_id" class="col-md-4 col-form-label text-md-right">Pais</label>

                                    <div class="col-md-6">
                                        <select name="pais_id" id="pais_id" class=" form-control">
                                            <option value="" selected disabled>--Seleccione--</option>
                                            @foreach ($paises as $pais)
                                            <option value="{{$pais->id}}" @if($pais->id == old('pais_id')) selected
                                                @endif>{{$pais->pais}}</option>
                                            @endforeach
                                        </select>
                                        @error('pais_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="provincia_id"
                                        class="col-md-4 col-form-label text-md-right">Provincia</label>

                                    <div class="col-md-6">
                                        <select name="provincia_id" id="provincia_id" class=" form-control" disabled>
                                            <option value="" selected disabled>--Seleccione--</option>
                                        </select>
                                        @error('provincia_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="localidad_id"
                                        class="col-md-4 col-form-label text-md-right">Localidad</label>

                                    <div class="col-md-6">
                                        <select name="localidad_id" id="localidad_id" class="form-control" disabled>
                                            <option value="" selected disabled>--Seleccione--</option>
                                        </select>
                                        @error('localidad_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="calle" class="col-md-4 col-form-label text-md-right">Calle</label>

                                    <div class="col-md-6">
                                        <input id="calle" type="text"
                                            class="form-control @error('calle') is-invalid @enderror" name="calle"
                                            value="{{ old('calle') }}" required autocomplete="calle" autofocus>

                                        @error('calle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary">
                                Registrarme
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        $('#dni').inputmask("99.999.999");
        $('#pais_id').change(function(){
            $('#provincia_id').removeAttr('disabled');
            var id = $(this).val();
            var url = "{{ route('paises.obtenerProvincias', ":id") }}" ;
            url = url.replace(':id' , id) ;
            $.get(url, function(data){
                var html_select = '<option value="" selected disabled>--Seleccione--</option>' ;
                for(var i = 0 ; i<data.length ; i++){
                     html_select += '<option value="'+data[i].id+'">'+data[i].provincia+'</option>' ;
                }
                 $('#provincia_id').html(html_select);
            });
        });
        $('#provincia_id').change(function(){
            $('#localidad_id').removeAttr('disabled');
            var id = $(this).val();
            var url = "{{ route('provincias.obtenerLocalidades', ":id") }}" ;
            url = url.replace(':id' , id) ;
            $.get(url, function(data){
                var html_select = '<option value="" selected disabled>--Seleccione--</option>' ;
                for(var i = 0 ; i<data.length ; i++){
                     html_select += '<option value="'+data[i].id+'">'+data[i].localidad+'</option>' ;
                }
                 $('#localidad_id').html(html_select);
            });
        });
    }) ;
</script>
@endpush
