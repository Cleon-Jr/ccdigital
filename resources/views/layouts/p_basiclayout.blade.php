<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @yield('title')

    <link rel="stylesheet" href="{{asset('bootstrap-4.1.3-dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/global-style.css')}}">
    <link rel="stylesheet" href="{{asset('css/p_main-style.css')}}">

    @yield('links')

    <script src="{{asset('js/sweetalert.min.js')}}"></script>

</head>
<body>

    @yield('content')

    <script type="text/javascript" src="{{asset('js/jquery-3.4.0.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('bootstrap-4.1.3-dist/js/bootstrap.min.js')}}"></script>
</body>
</html>
