
@extends('layouts.main')

@section('title')
    <title>Contracheque Digital | Login</title>
@endsection


@section('links')
    <link rel="stylesheet" href="{{asset('css/p-login-style.css')}}">
@endsection


@section('content')
    <section class="card col-md-3">
        <img class="d-block mx-auto" src="{{asset('img/logo.png')}}">
        <h5 class="text-center">Login Usuário</h5>
        <hr class="mx-auto" width="80%">
        <div class="card-body">
            <form method="post" action="{{'/contrachequedigital'}}" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="form-group col-md-12">
                        <input type="text" name="cpf" class="form-control" value="{{old('login')}}" required>
                        <label>CPF</label>
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
                <h5 class="text-center text-white"><a href=" {{ '/createaccess' }} ">Primeiro Acesso</a></h5>
                <p class="text-center passForgot"><a href="#">Esqueci minha senha!</a></p>
            </form>
        </div>

        <p class="text-center">From Infortread Sistemas -  2025</p>
    </section>

@endsection

