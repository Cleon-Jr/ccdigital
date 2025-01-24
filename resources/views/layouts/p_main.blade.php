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
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" role="navigation">
        <div class="navbar-brand">
            <img class="img-fluid" src="{{asset('img/logo-w.png')}}">
            {{-- <H4 class="userLogged text-white"> | Cleon Oliveira</H4> --}}
        </div>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#myCollapse" aria-controls="myCollapse" aria-expanded="false">
            <i class="bi bi-list"></i>
        </button>

        <div class="collapse navbar-collapse" id="myCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <div class="barItem"></div>
                    <a href="{{'/dashboard'}}" target="myframe" class="nav-link active" onclick="$('#myCollapse').collapse('hide')">Home</a>
                </li>
                <li class="nav-item">
                    <div class="barItem"></div>
                    <a href="{{'#'}}" target="myframe" class="nav-link" onclick="$('#myCollapse').collapse('hide')">Envio de Folha</a>
                </li>
                <li class="nav-item">
                    <div class="barItem"></div>
                    <a href="{{'#'}}" target="myframe" class="nav-link" onclick="$('#myCollapse').collapse('hide')">Usuários</a>
                </li>
                <li class="nav-item dropdown">
                    <div class="barItem"></div>
                    <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">Configurações</a>
                    <div class="dropdown-menu">
                        <a href="{{'#'}}" target="myframe" class="dropdown-item" onclick="$('#myCollapse').collapse('hide')">Instituição</a>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="barItem"></div>
                    <a href="{{'#'}}" class="nav-link" onclick="$('#myCollapse').collapse('hide')">Sair</a>
                </li>
            </ul>
        </div>
    </nav>


    @yield('content')

    <script type="text/javascript" src="{{asset('js/jquery-3.4.0.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('bootstrap-4.1.3-dist/js/bootstrap.min.js')}}"></script>
</body>
</html>
