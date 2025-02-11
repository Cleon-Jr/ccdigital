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
            <h4>Confira se as informações estão corretas e crie uma senha de acesso.</h4>
            <hr>

            <div class="row">
                <div class="col-md-4 text-right"><strong>CPF</strong></div>
                <div class="col-md-6">{{$cpf = session('cpf')}} </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-right"><strong>Nome</strong></div>
                <div class="col-md-6"> {{$userName = session('username')}} </div>
            </div>

            {{-- Card body FORM --}}
            <div class="card-body">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Senha</label>
                            <input type="password" name="pass" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Confirmar Senha</label>
                            <input type="password" name="pass-confirm" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-success btn-block">Salvar</button>
                        </div>
                        <div class="form-group col-md-6">
                            <button type="reset" class="btn btn-light btn-block">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
