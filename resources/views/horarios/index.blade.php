@include('raiz')
<div class="card">
    <div class="card-header">
        <h3>Horarios Laborales Creados</h3>
        <button type="button" class="btn btn-sm btn-secondary"
            onclick="location.href='{{ route('horarios.create')}}'"><i class="fas fa-plus"></i></button>
    </div>
    <div class="card-body">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Hora de Comienzo</th>
                    <th>Hora de Fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($horarios as $horario)
                <tr>
                    <th>{{$horario->nombre}}</th>
                    <th>{{$horario->comienzo}}</th>
                    <td>{{$horario->fin}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
