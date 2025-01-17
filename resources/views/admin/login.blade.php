
@extends('layouts.main')

@section('title')
    <title>Contracheque Digital | Login</title>
@endsection

@section('links')
    <link rel="stylesheet" href="{{asset('css/login-style.css')}}">
@endsection


@section('content')
    <section class="card col-md-3">
        <img class="d-block mx-auto" src="{{asset('img/logo-w.png')}}">
        <h5 class="text-center text-white">Login Admin</h5>
        <hr class="mx-auto" width="80%">
        <div class="card-body">
            <form method="post" action="{{'/admin/login'}}">
                @csrf
                <div class="row">
                    <div class="form-group col-md-12">
                        <input type="text" name="login" class="form-control" value="{{old('login')}}" required>
                        <label>E-mail</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-gorup col-md-12">
                        <input type="password" name="pass" class="form-control" required>
                        <label>Senha</label>
                    </div>
                </div>
                <hr class="mx-auto" width="80%">
                <div class="row">
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-light btn-block">Entrar</button>
                    </div>
                </div>
                <h5 class="text-center text-white"><a href="#" data-toggle="modal" data-target="#myModal">Novo Administrador</a></h5>
                <p class="text-center passForgot"><a href="#">Esqueci minha senha!</a></p>
            </form>
        </div>

        <p class="text-center">Produzido por Infortread Sistemas -  2025</p>
    </section>

    @if (Session::has('login-success'))
        <script>
            swal({
                title: "Contracheque Online | SUCESSO",
                text: "{{Session::get('login-success')}}",
                icon: "success",
                button: {
                    text: "Ok"
                }
            }).then((value) =>{
                window.location.href="{{'/admin/main'}}";
            });
        </script>
    @endif

    @if (Session::has('login-error'))
        <script>
            swal({
                title: "Contracheque Online | ERRO",
                text: "{{Session::get('login-error')}}",
                icon: "error",
            });
        </script>
    @endif


    <!-- MODAL FORM -->
    <section class="modal fade" id="myModal" aria-labelledby="mymodal" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastro de Administrador</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="bi bi-x-circle-fill"></i></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{'/admin/adduser'}}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <input type="text" name="fullname" class="form-control" placeholder="Nome completo">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <input type="text" name="cpf" class="form-control" placeholder="CPF">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <input type="email" name="email" class="form-control" placeholder="Seu E-email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="password" name="pass" class="form-control" placeholder="Informe uma senha">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="password" name="passconfirm" class="form-control" placeholder="Confirme sua senha">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-light btn-block">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @if (Session::has('success'))
        <script>
            swal({
                title: "Contracheque Online | SUCESSO",
                text: "{{Session::get('success')}}",
                icon: "success",
            });
        </script>
    @endif

    @if (Session::has('error'))
            <script>
                swal({
                    title: "Contracheque Online | ERRO",
                    text: "{{Session::get('error')}}",
                    icon: "error",
                });
            </script>
    @endif

    @if ($errors->any())
        <script>
            swal({
                title: "Contracheque Online | ERRO",
                text: "{{implode('\n', $errors->all())}}",
                icon: "error",
            });
        </script>
    @endif


@endsection
