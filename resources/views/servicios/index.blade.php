@include('raiz')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-auto">
                <h3>Servicios Creados</h3>
            </div>
            <div class="col-md-auto">
                <button type="button" class="btn btn-sm btn-secondary"
                    onclick="location.href='{{ route('servicios.create')}}'"><i class="fas fa-plus"></i></button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Servicio</th>
                    <th>Duracion (Minutos)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($servicios as $servicio)
                <tr>
                    <th>{{$servicio->id}}</th>
                    <th>{{$servicio->servicio}}</th>
                    <th>{{$servicio->duracion}}</th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
