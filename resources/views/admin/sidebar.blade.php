<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-orange elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('admin-lte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{auth()->user()->empresa->nombre}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy " data-widget="treeview"
                role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('empresas.index',auth()->user()->empresa->slug)}}"
                        class="nav-link  {{ (request()->routeIs('empresas.*')) ? 'active' : '' }}">
                        <i class="fal fa-home nav-icon"></i>
                        <p>Mi Inicio</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('misTurnos.misTurnos')}}"
                        class="nav-link  {{ (request()->routeIs('misTurnos.*')) ? 'active' : '' }}">
                        <i class="fal fa-circle-notch nav-icon"></i>
                        <p>Mis turnos en esperas</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link {{ (request()->is('home')) ? 'active' : '' }}">
                        <i class="fal fa-home nav-icon"></i>
                        <p>Home</p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{route('turnos.index')}}"
                        class="nav-link  {{ (request()->routeIs('turnos.*')) ? 'active' : '' }}">
                        <i class="fal fa-circle-notch nav-icon"></i>
                        <p>Turnos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('users.index')}}"
                        class="nav-link  {{ (request()->routeIs('users.*')) ? 'active' : '' }}">
                        <i class="fal fa-circle-notch nav-icon"></i>
                        <p>Usuarios</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('servicios.index')}}"
                        class="nav-link  {{ (request()->routeIs('servicios.*')) ? 'active' : '' }}">
                        <i class="fal fa-circle-notch nav-icon"></i>
                        <p>Servicios</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('horarios.index')}}"
                        class="nav-link  {{ (request()->routeIs('horarios.*')) ? 'active' : '' }}">
                        <i class="fal fa-circle-notch nav-icon"></i>
                        <p>Horarios</p>
                    </a>
                </li>


                {{-- Listado desplegable para agrupar elementos --}}
                {{-- <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Gestion
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Active Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inactive Page</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
