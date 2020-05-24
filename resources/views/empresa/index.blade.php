@extends('admin.index')
@section('content')


<!--Carousel Wrapper-->
<div id="carousel-example-2" class="carousel slide carousel-fade z-depth-1-half" data-ride="carousel">
    <!--Indicators-->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-2" data-slide-to="1"></li>
        <li data-target="#carousel-example-2" data-slide-to="2"></li>
    </ol>
    <!--/.Indicators-->
    <!--Slides-->
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <div class="view">
                <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(105).jpg"
                    alt="First slide">
                <div class="mask rgba-black-light"></div>
            </div>
            <div class="carousel-caption">
                <h3 class="h3-responsive">This is the first title</h3>
                <p>First text</p>
            </div>
        </div>
        <div class="carousel-item">
            <!--Mask color-->
            <div class="view">
                <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(115).jpg"
                    alt="Second slide">
                <div class="mask rgba-black-light"></div>
            </div>
            <div class="carousel-caption">
                <h3 class="h3-responsive">Thir is the second title</h3>
                <p>Secondary text</p>
            </div>
        </div>
        <div class="carousel-item">
            <!--Mask color-->
            <div class="view">
                <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(108).jpg"
                    alt="Third slide">
                <div class="mask rgba-black-light"></div>
            </div>
            <div class="carousel-caption">
                <h3 class="h3-responsive">This is the third title</h3>
                <p>Third text</p>
            </div>
        </div>
    </div>
    <!--/.Slides-->
    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->
</div>
<!--/.Carousel Wrapper-->
<br>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-auto">
                <h3>Inicio</h3>
            </div>
            <div class="col-md-auto">
                <button type="button" class="btn btn-sm btn-secondary"
                    onclick="location.href='{{ route('horarios.create')}}'"><i class="fas fa-plus"></i></button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <p>Descripcion de empresa</p>

        <h3>Servicios disponibles:</h3>


        <div class="row">

            <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                @foreach ($empresa->servicios as $servicio)

                <div class="card col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 text-center">
                    <img src="https://placehold.it/318x180/" class="card-img-top" alt="Card image" />

                    <div class="card-block">
                        <h4 class=""> <strong>{{$servicio->servicio}}</strong></h4>
                        <p class="card-text">{{$servicio->descripcion}}</p>
                    </div>
                    <div class="card-footer ">
                        <a href="{{ route('turnos.create') }}" class="btn btn-sm btn-primary">Ver Turnos</a>
                    </div>
                </div>
                @endforeach


            </div>
        </div>



    </div>
</div>
@endsection