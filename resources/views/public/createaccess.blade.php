@extends('layouts.p_basiclayout')

@section('title')
    <title>CC Digital | Primeiro Acesso</title>
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
        <h5 class="text-center">Vamos confirmar sua identidade para continuarmos com a criação de seu acesso.</h5>
        <hr>

        <div class="card col-md-8 mx-auto">
            <h4 class="text-center">Informe os Dados</h4>
            <hr>

            @if(Session::has('error'))
                <script>
                    swal({
                        title: "Contracheque Digital | ATENÇÃO",
                        text: "{{ session::get('error') }}",
                        icon: "error"
                    });
                </script>
            @endif
            <div class="card-body">
                <form method="post" action="{{'/confirmation'}}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>CPF</label>
                            <input type="text" maxlength="11" name="cpf" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Data de Nascimento</label>
                            <input type="date" name="birth" class="form-control">
                        </div>
                    </div>
                    <!-- <div class="form-row">
                        <div class="form-group col-md">
                            <label>E-mail</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                    </div> -->
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-success btn-block">Confirmar</button>
                        </div>
                        <div class="form-group col-md-6">
                            <a href="{{ '/' }}" class="btn btn-light btn-block">Cancelar e Voltar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
