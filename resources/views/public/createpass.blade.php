@extends('layouts.p_basiclayout')

@section('title')
    <title>CC Digital | Criação de Acesso</title>
@endsection

@section('links')
    <link rel="stylesheet" href="{{asset('css/p_createaccess-style.css')}}">
@endsection

@section('content')

    <nav class="navbar navbar-expand-lg navbar-light fixed-top" role="navigation">
        <div class="navbar-brand">
            <img class="img-fluid" src="{{asset('img/logo-w.png')}}">
        </div>

        <h3 class="mx-auto">Seja bem-vindo ao Contracheque Digital!</h3>
    </nav>

    <div class="container">
        <h5 class="text-center">Criação da Senha de Acesso!</h5>
        <hr>

        <div class="card col-md-8 mx-auto">
            <h4 class="text-center">Confira se as informações estão corretas e crie uma senha de acesso.</h4>
            <hr>
            <!-- Informações do usuário caso esteja em folha -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-right bg-light">
                            <strong>CPF:</strong>
                        </div>
                        <div class="col-md bg-light"> {{ $cpf = session('cpf') }} </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right bg-light">
                            <strong>Nome:</strong>
                        </div>
                        <div class="col-md bg-light"> {{ $username = session('username') }} </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right bg-light">
                            <strong>Data Nascimento:</strong>
                        </div>
                        <div class="col-md bg-light"> {{ $birth = session('birth') }} </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right bg-light">
                            <strong>Nome da Mãe:</strong>
                        </div>
                        <div class="col-md bg-light"> {{ $mother = session('mother') }} </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right bg-light">
                            <strong>E-mail:</strong>
                        </div>
                        <div class="col-md bg-light"> {{ strtolower($email = session('email')) }} </div> 
                    </div>
                    
                </div>
            </div>

            <!-- Pegando mensagens de erro -->
            @if (Session::has('success'))
                <script>
                    swal({
                        title: "Contracheque Digital | SUCESSO",
                        text: "{{ Session::get('success') }}",
                        icon: "success",
                        button: {
                            text: "Ok"
                        }
                    }).then((value) =>{
                        window.location.href="{{ '/' }}";
                    });
                </script>                
            @endif

            @if (Session::has('error'))
                <script>
                    swal({
                        title: "Contracheque Digital | ERRO",
                        text: "{{ Session::get('error') }}",
                        icon: "error"
                    });
                </script>
            @endif
            {{-- Card body FORM --}}
            <div class="card-body">
                <form method="post" action="{{ '/createpass' }}">
                    @csrf
                    <input type="hidden" name="cpf" value="{{ $cpf = session('cpf') }}">
                    <input type="hidden" name="username" value="{{ $username = session('username') }}">
                    <input type="hidden" name="birthdate" value="{{ $birth = session('birth') }}">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Senha</label>
                            <input type="password" name="pass" id="pass" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Confirmar Senha</label>
                            <input type="password" name="pass-confirm" id="passconfirm" class="form-control" onblur="validatePass();">
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-success btn-block">Salvar</button>
                        </div>
                        <div class="form-group col-md-6">
                            <button type="button" class="btn btn-light btn-block" onclick="window.history.back();">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('keydown', function(event){
            if(event.key === 'F5' || (event.ctrlKey && event.key === 'r') || event.key === 'Enter'){
                event.preventDefault();
            }
        });

        winfow.addEventListener('beforeunLoad', function(event){
            event.preventDefault();
            event.returnValue = '';
        });
    </script>

    <script type="text/javascript">
            function validatePass(){
                var vl1 = document.getElementById('pass').value;
                var vl2 = document.getElementById('passconfirm').value;

                    if(vl1 != vl2){
                        swal({
                            title: "Contracheque Digital | ATENÇÃO",
                            text: "Confirmação de senha inválida!",
                            icon: "warning"
                        });
                        document.getElementById('passconfirm').value = "";
                        document.getElementById('pass').value = "";
                    }
            }
    </script>


@endsection
