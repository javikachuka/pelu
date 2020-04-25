<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">PeluPapa</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link " href="#">Home</a>
        <a class="nav-item nav-link" href=" {{ route('users.index') }} ">Clientes</a>
        <a class="nav-item nav-link" href=" {{route('turnos.create')}} ">Turnos</a>
        <a class="nav-item nav-link" href="{{ route('horarios.index') }}">Horarios</a>
      </div>
    </div>
  </nav>
