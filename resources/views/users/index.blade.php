@include('raiz')
<div class="card">
    <div class="card-header">
        <h3>Clientes Registrados</h3>
        <button type="button" class="btn btn-sm btn-secondary"
            onclick="location.href='{{ route('users.create')}}'"><i class="fas fa-plus"></i></button>
    </div>
    <div class="card-body">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>Cumpleanios</th>
                    <th>Edad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <th>{{$user->name}}</th>
                    <th>{{$user->apellido}}</th>
                    <th>{{$user->dni}}</th>
                    <td>{{$user->fecha_nacimiento}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
