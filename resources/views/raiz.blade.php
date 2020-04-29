<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href=" {{asset('css/app.css')}} ">
    <link rel="stylesheet" href=" {{asset('css/bootstrap-datepicker.min.css')}} ">
</head>

<body>
    @include('navbar')
    <div class="content mt-3">
        <div class="container">
            @yield('content')
        </div>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('js/idioma_datepicker.js')}}"></script>
    @stack('scripts')
</body>

</html>
