<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <a class="navbar-brand" href="#">PeluPapa</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link " href="{{ route('home') }}">Home</a>
        <a class="nav-item nav-link" href=" {{ route('users.index') }} ">Clientes</a>
        <a class="nav-item nav-link" href=" {{route('turnos.index')}} ">Turnos</a>
        <a class="nav-item nav-link" href="{{ route('horarios.index') }}">Horarios</a>
        <a class="nav-item nav-link" href="{{ route('servicios.index') }}">Servicios</a>
      </div>
      <div class="navbar-nav ml-auto">
        <a class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right mr-3" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">
                    Configuracion
                    <i class="fas fa-cog"></i>
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                    <i class="fas fa-sign-out-alt"></i>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </a>
      </div>
    </div>
  </nav>
