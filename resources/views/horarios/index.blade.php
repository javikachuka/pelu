@include('raiz')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-auto">
                <h3>Horarios Laborales Creados</h3>
            </div>
            <div class="col-md-auto">
                <button type="button" class="btn btn-sm btn-secondary"
                    onclick="location.href='{{ route('horarios.create')}}'"><i class="fas fa-plus"></i></button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Dias de Trabajo</th>
                    <th>Hora de Comienzo</th>
                    <th>Hora de Fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($horarios as $horario)
                <tr>
                    <th>{{$horario->nombre}}</th>
                    <th>
                    @foreach ($horario->dias as $dia)
                        <span class="badge badge-info">{{$dia->dia}}</span>
                    @endforeach
                    </th>
                    <th>{{$horario->comienzo}}</th>
                    <td>{{$horario->fin}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
