@extends('layouts.main')

@section('links')
    <link rel="stylesheet" href="{{asset('css/uploads-style.css')}}">
@endsection


@section('content')

<h4 id="pageTitle">Envio de Dados</h4>

    <section class="container-fluid">
        <div class="row">
            <div class="col-md-7">
                <div class="card" id="cardUploads">
                    <h5 class="text-center">Seleção de Arquivos (Json)</h5>
                    <hr class="mx-auto" width="80%">

                    <div class="card-body">
                        <form method="POST" action="{{'/admin/send'}}" enctype="multipart/form-data" onsubmit="showLoader()">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md">
                                <input type="file" name="jsonfile1" class="custom-file-input" id="jsonFile1">
                                <label class="custom-file-label" for="jsonfile1">Selecione o arquivo 1-competencia</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <input type="file" name="jsonfile2" class="custom-file-input" id="jsonFile2">
                                <label class="custom-file-label" for="jsonfile2">Selecione o arquivo 2-servidores</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <input type="file" name="jsonfile3" class="custom-file-input" id="jsonFile3">
                                <label class="custom-file-label" for="jsonfile3">Selecione o arquivo 3-contracheque</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <input type="file" name="jsonfile4" class="custom-file-input" id="jsonFile4">
                                <label class="custom-file-label" for="jsonfile4">Selecione o arquivo 4-ítens</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-success btn-block">Enviar Arquivos</button>
                            </div>
                            <div class="form-group col-md-6">
                                <div id="cloader"></div>
                                <h5 class="text-success text-center" id="txt">Aguarde...</h5>
                            </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card" id="cardInfo">
                    <h5 class="text-center">Informações de Envio</h5>
                    <hr class="mx-auto" width="80%">

                    <div class="card-body">
                        <spam id="dt"><strong>Data:</strong> {{date('d-m-Y H:i:s')}}</spam>
                        <p><strong>Últmo envio:</strong> {{$sendLast}}</p>
                        <p><strong>Quantidade Servidores/Matrículas:</strong> {{$numberEmployee}}/{{$numberRegister}}</p>
                        <p><strong>Competência:</strong> {{$competence}} </p>
                        <hr class="mx-auto" width="80%">
                        <h5 class="text-center">Valor da Folha</h5>
                        <p><strong>Total Bruto:</strong> R$ {{$earning}}</p>
                        <p><strong>Total Descontos:</strong> R$ {{$discount}}</p>
                        <p><strong>Total Líquindo:</strong> R$ {{$netvl}}</p>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <br>

    @if (Session::has('error'))
        <script>
            swal({
                title: "Contracheque Digital | ERRO",
                text: "{{Session::get('error')}}",
                icon: "error"
            })
        </script>
    @endif

    @if ($errors->any())
        <script>
            swal({
                title: "Contracheque Digital | ERRO",
                text: "{{implode('\n', $errors->all())}}",
                icon: "error"
            })
        </script>
    @endif

    @if (Session::has('sends_ok'))
        <script>
            swal({
                title: "Contracheque Digital | SUCESSO",
                text: "{{Session::get('sends_ok')}}",
                icon: "error"
            })
        </script>
    @endif

    <script type="text/javascript" src="{{asset('js/jquery-3.4.0.min.js')}}"></script>

    <script>
        $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    <script type="text/javascript">
        function showLoader(){
            document.getElementById('txt').classList.toggle('view');
            document.getElementById('cloader').classList.toggle('loadActive');
        }
    </script>

@endsection
