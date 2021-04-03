<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('template/assets/libs/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
    <title>@yield('title')</title>

</head>
<body>
    @yield('content')
    <footer class="page-footer">
    <div class="d-flex justify-content-around align-items-center pie-pag fixed-bottom">
        <div>
            <img src="{{ asset('images/logoBUAP.png') }}" class="rounded float-left img-fluid" height="150px" width="150px" alt="logoBUAP">
        </div>
        <div class="">
            <ul class="text-white">
                <li class="text-body font-weight-bold h2">Contacto de encargado</li>
                <li>cristiam_17@live.com</li>
                <li>271-163-9880</li>
            </ul>
        </div>
        <div>
            <img src="{{ asset('images/logoFCC.png') }}" class="rounded float-right img-fluid " height="170px" width="175px" alt="logoFCC">
        </div>
    </div>
    </footer>
    <script src="{{ asset('template/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script> 
</body>
</html>