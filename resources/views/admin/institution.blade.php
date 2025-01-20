@extends('layouts.main')

@section('links')
    <link rel="stylesheet" href="{{asset('css/institution-style.css')}}">
@endsection

@section('content')

    @if (Session::has('success_json'))
        <script>
            swal({
                title: "Contracheque Digital | SUCESSO",
                text: "{{Session::get('success_json')}}",
                icon: "success",
            })
        </script>
    @endif

    @if (Session::has('error_json'))
        <script>
            swal({
                title: "Contracheque Digital | ERRO",
                text: "{{Session::get('error_json')}}",
                icon: "error",
            })
        </script>
    @endif

    <section class="container">
        <h4 id="pageTitle">Gestão do Sistema</i> </h4>
            <div class="card" id="cardInstitution">
                <h5 class="text-center">Cadastro da Instituição</h5>
                <hr class="mx-auto" width="80%">
                <!-- Accordion -->
                 <div class="accordion" id="myAccordion">
                    <div class="card">
                        <div class="card-title" id="card-title">
                            <h4>
                                <a href="#" class="btn btn-light btn-block text-left" data-toggle="collapse" data-target="#collapseUp" aria-expanded="true" aria-controls="collapseUp">
                                Registrar Instituição via Upload <i class="bi bi-chevron-down"></i>
                                </a>
                            </h4>
                        </div>
                        <div class="collapse" id="collapseUp">
                            <div class="card-body">
                                <form method="POST" action="{{'/admin/addinstjson'}}" enctype="multipart/form-data" onsubmit="showLoader()">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <input type="file" name="jsonfile" class="custom-file-input" id="jsonFile1">
                                            <label class="custom-file-label" for="jsonfile">Arquivo instituicao</label>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <button type="submit" class="btn btn-success btn-block text-white">Enviar Arquivo</button>
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
                 </div>

                 @if (Session::has('success'))
                     <script>
                        swal({
                            title: "Contracheque Digital | SUCESSO",
                            text: "{{Session::get('success')}}",
                            icon: "success",
                        });
                     </script>
                 @endif

                 @if (Session::has('error'))
                     <script>
                        swal({
                            title: "Contracheque Digital | ERRO",
                            text: "{{Session::get('error')}}",
                            icon: "error",
                        });
                     </script>
                 @endif
                <div class="card-body">
                    <form method="post" action="{{'/admin/saveinst'}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md text-right">
                                <input type="file" name="logo" id="file" class="inputfile">
                                <label for="file" title="Selecione uma image do Brasão ou Logomarca da Instituição!">
                                    <i class="bi bi-upload"></i>
                                </label>
                            </div>
                            <div class="form-group col-md">
                                <img class="img-thumbnail" id="imgThumbnail" src=" {{asset('img/brand/'.$logo)}} ">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <input type="hidden" name="id" value="{{$id}}">
                                <label>CNPJ</label>
                                <input type="text" name="cnpj" class="form-control" value="{{$cnpj}}" required>
                            </div>
                        </div>                        
                        <div class="form-row">
                            <div class="form-group col-md-10">
                                <label>Nome Instituição</label>
                                <input type="text" name="description" class="form-control" value="{{$desc}}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label>CEP</label>
                                <input type="text" name="cep" class="form-control" value="{{$cep}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Endereço</label>
                                <input type="text" name="address" class="form-control" value="{{$address}}" required>
                            </div>
                            <div class="form-group col-md-1">
                                <label>Número</label>
                                <input type="text" name="number" class="form-control" value="{{$number}}">
                            </div>
                            <div class="form-group col-md">
                                <label>Bairro</label>
                                <input type="text" name="district" class="form-control" value="{{$district}}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-1">
                                <label>UF</label>
                                <select name="uf" class="form-control">
                                    <option value="{{$uf}}">{{$uf}}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                                <label>Cidade</label>
                                <select name="city" class="form-control">
                                    <option value="{{$city}}">{{$city}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Telefone 1</label>
                                <input type="text" name="tel1" class="form-control" value="{{$tel1}}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Telefone 2</label>
                                <input type="text" name="tel2" class="form-control" value="{{$tel2}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>E-mail</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{$email}}">
                            </div>
                        </div>
                        <hr>
                        <div class="form-row" id="footer">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success">Salvar</button>
                                <a href="#" class="btn btn-light">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
    @if ($errors->any())
        <script>
            swal({
                title: "Contracheque Digital | Erro",
                text: "{{implode('\n', $errors->all())}}",
                icon: "error",
            });
        </script>
    @endif

    </section>
    <br>


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

    <script type="text/javascript">
        $(function(){
            $('#file').change(function(){
                const file = $(this)[0].files[0];
                const fileReader = new FileReader();
                fileReader.onloadend = function(){
                $('#imgThumbnail').attr('src',fileReader.result);
                };
            fileReader.readAsDataURL(file);
            });
        });
    </script>

@endsection
