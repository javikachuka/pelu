@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Tipo de Registro</h3>
                    <ul>
                        <li>Recuerde que el tipo de registro dependera de si usted es una empresa o cliente</li>
                        <li>Al registrarse como empresa podra ofrecer sus servicios a multiples personas</li>
                        <li>Al registrarse como cliente podra encontrar diversas empresas para reservar turnos</li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-5 text-center">
                            <button class="btn btn-info btn-lg"
                                onclick="location.href='{{route('users.createRegistroEmpresa')}}'">Empresa <i
                                    class="fas fa-city"></i></button>
                        </div>
                        <div class="col-md-5 text-center">
                            <button class="btn btn-info btn-lg"
                                onclick="location.href='{{ route('users.createRegistroClientes')}}'">Cliente <i
                                    class="fas fa-address-card"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
