<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Pelu</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href=" {{ asset('admin-lte/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    {{-- Datatable --}}
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    {{-- Bootstrap DatePicker --}}
    <link rel="stylesheet" href=" {{asset('css/bootstrap-datepicker.min.css')}} ">
    {{-- Toastr (es para alertas) --}}
    <link rel="stylesheet" href=" {{asset('admin-lte/plugins/toastr/toastr.min.css')}} ">
    {{-- Multiselect --}}
    <link rel="stylesheet" href="{{asset('admin-lte/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    {{-- Checkbox --}}
    <link rel="stylesheet" href="{{asset('admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('admin.header')

        @include('admin.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{auth()->user()->empresa->nombre}}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active">Pagina de Inicio</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">

                    @yield('content')

                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        @include('admin.footer')

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{asset('admin-lte/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('admin-lte/dist/js/adminlte.min.js')}}"></script>
    {{-- Datatables --}}
    <script src="{{asset('admin-lte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    {{-- Trasformador de Datatable --}}
    <script src="{{asset('js/includeDataTable.js')}}"></script>
    {{-- Bootstrap Datepicker --}}
    <script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
    {{-- Cambiar Idioma DatePicker --}}
    <script src="{{asset('js/idioma_datepicker.js')}}"></script>
    {{-- Bootstrap FileStyle --}}
    <script type="text/javascript" src="{{ asset('js/bootstrap-filestyle.min.js') }}"> </script>
    {{-- Toastr --}}
    <script type="text/javascript" src="{{ asset('admin-lte/plugins/toastr/toastr.min.js') }}"> </script>
    {{-- Mostrar alertas con toastr --}}
    <script>
        @if(Session::has('mensaje'))
        var tipo = "{{ Session::get('tipo_alerta', 'info') }}";
        switch(tipo){
            case 'info':
                toastr.info("{{ Session::get('mensaje') }}", "{{ Session::get('accion') }}");
                break;

            case 'warning':
                toastr.warning("{{ Session::get('mensaje') }}","{{ Session::get('accion') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('mensaje') }}", "{{ Session::get('accion') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('mensaje') }}", "{{ Session::get('accion') }}");
                break;
        }
      @endif
    </script>
    {{-- Input mask --}}
    <script src="{{asset('admin-lte/plugins/inputmask/jquery.inputmask.js')}}"></script>
    {{-- Multiselect --}}
    <script src="{{asset('admin-lte/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
        $('.select2').select2({theme: 'bootstrap4'});
    </script>
    @stack('scripts')
</body>

</html>