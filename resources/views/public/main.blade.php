@extends('layouts.main')

@section('title')
    <title>| Contracheque Digital |</title>
@endsection

@section('links')
    <link rel="stylesheet" href="{{asset('css/p_main-style.css')}}">
@endsection

@section('content')
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

<section>
    <iframe id="myFrame" name="myframe" src="{{'/dashboard'}}" height="1" frameborder="0" width="100%" scrolling="no" onload="calcHeight();"></iframe>
</section>



<footer>
    <h6>Instituição: 11460137000145 | Cleon Oliveira</h6>
    @if (!@$cnpj)
        <h6>Sistema sem Gestão. Registre uma Instituição no sistema!</h6>
    @else
        <h6>Registrado para {{@$cnpj}} - {{$description}}</h6>
    @endif

</footer>

<!-- Ajuste da altura do iframe -->
<script type="text/javascript">
    function calcHeight(){
        var the_height = 0;
        the_height = document.getElementById('myFrame')
        .contentWindow.document.body.scrollHeight;
        document.getElementById('myFrame').height = the_height;
    }
</script>

@endsection
