
@extends('layouts.main')

@section('links')
<link rel="stylesheet" href="{{asset('css/dash-style.css')}}">
@endsection

@section('content')

    <h4 id="pageTitle">Painel de Controle</h4>

    <section class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" id="cardIdentification">
                    <h5 class="text-center">Instituição</h5>
                    <hr class="mx-auto" width="80%">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <span><strong>CNPJ:</strong> {{@$cnpj}}</span>
                            </div>
                            <div class="col-md">
                                <span><strong>Instituição:</strong> {{@$desc}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <span><strong>Telefone:</strong> {{@$tel}}</span>
                            </div>
                            <div class="col-md">
                                <span><strong>E-mail:</strong> {{@$email}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <span><strong>Endereço:</strong> {{@$address.' '.@$location}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card" id="cardLasts">
                    <h5 class="text-center">Últimos Envios</h5>
                    <hr class="mx-auto" width="80%">
                    <div class="card-body">
                        <p><strong>Último Envio:</strong> {{$lastDate}}</p>
                        <p><strong>Quantidade Servidores/Matrículas:</strong> {{@$register}}</p>
                        <p><strong>Competência:</strong> {{@$competence}}
                        <p><strong>Valor da Folha:</strong> R$ {{@$earning}}</p>
                        <hr class="mx-auto" width="80%">
                        <a href="#" class="btn btn-success btn-block text-white">Enviar Folha</a>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card" id="cardGraphic">
                    <h5 class="text-center">Progresso Anual</h5>
                    <hr class="mx-auto" width="80%">

                    <canvas id="graphic1"></canvas>

                </div>
            </div>

        </div>
    </section>
    <br>


    <script type="text/javascript" src="{{asset('js/jquery-3.4.0.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('bootstrap-4.1.3-dist/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/Chart.min.js')}}"></script>

    <script type="text/javascript">
            var config = {
                type: 'bar',
                data:{
                    labels:['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro'],
                    datasets:[{
                        //    type:'line',
                            label:['Faturamento'],
                            backgroundColor: '#00c853',
                            data:[0,0,0,500,420,527,670,876,654,678]
                    },
                    {
                        label:['Despesas'],
                        backgroundColor: '#e53935',
                        data:[0,23,0,10,0,1.5,10,100,0,0]
                    }]
                },
                options:{
                    responsive: true,
                    maintainAspectRatio: false
                }

            };

            var contexto = document.getElementById('graphic1').getContext('2d');
            var graphic1 = new Chart(contexto,config);

        </script>

@endsection
{{-- </body>
</html> --}}
