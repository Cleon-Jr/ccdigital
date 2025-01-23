@extends('layouts.main')

@section('links')
    <link rel="stylesheet" href="{{asset('css/p_dash-style.css')}}">
@endsection

@section('content')
<nav class="header">
    <h4 class="text-center">Demonstrativo Financeiro</h4>
</nav>

<section class="container">

    <div class="accordion">
        <div class="card">
            <div class="card-title">
                <a href="#" data-toggle="collapse" data-target="#infoUser" aria-expanded="true" aria-controls="infoUser" onclick="calcHeight()">
                    <h5 class="text-center">Informações Cadastrais <i class="bi bi-caret-down-fill"></i></h5>
                </a>
                <hr class="mx-auto" width="80%">
            </div>
            <div class="row" id="titleRow">
                <div class="col-md-4 bg-light"><strong>Nome completo</strong></div>
                <div class="col-md bg-light">Cleon Oliveira</div>
            </div>

            <div class="collapse" id="infoUser">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 bg-light"><strong>CPF</strong></div>
                        <div class="col-md bg-light">598.182.472-72</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 bg-light"><strong>RG</strong></div>
                        <div class="col-md bg-light">1334389-0</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 bg-light"><strong>PISPASE</strong></div>
                        <div class="col-md bg-light">12341354</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 bg-light"><strong>Nome da Mãe</strong></div>
                        <div class="col-md bg-light">Tereza Ângela Bezerra</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 bg-light"><strong>Data Nascimento</strong></div>
                        <div class="col-md bg-light">08/02/1978</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 bg-light"><strong>Idade</strong></div>
                        <div class="col-md bg-light">47</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 bg-light"><strong>E-mail</strong></div>
                        <div class="col-md bg-light">cleon@gmail.com</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

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
