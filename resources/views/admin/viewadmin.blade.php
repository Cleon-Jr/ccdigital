@extends('layouts.main')

@section('links')
    <link rel="stylesheet" href="{{asset('css/view-style.css')}}">
@endsection

@section('content')

<section class="container">
    <div class="card">
        <h5 class="text-center">Visualizar Administrador</h5>
        <hr class="mx-auto" width="80%">

        <div class="card-body">
            <div class="row">
                <div class="col-md-3 text-right bg-light">
                    <strong>ID:</strong>
                </div>
                <div class="col-md bg-light">{{$id}}</div>
            </div>
            <div class="row">
                <div class="col-md-3 text-right bg-light">
                    <strong>CPF:</strong>
                </div>
                <div class="col-md bg-light">{{$cpf}}</div>
            </div>
            <div class="row">
                <div class="col-md-3 text-right bg-light">
                    <strong>Nome Completo:</strong>
                </div>
                <div class="col-md bg-light">{{$name}}</div>
            </div>
            <div class="row">
                <div class="col-md-3 text-right bg-light">
                    <strong>E-mail:</strong>
                </div>
                <div class="col-md bg-light">{{$email}}</div>
            </div>
            <div class="row">
                <div class="col-md-3 text-right bg-light">
                    <strong>Último Acesso:</strong>
                </div>
                <div class="col-md bg-light">{{$lastAccess}}</div>
            </div>
            <div class="row">
                <div class="col-md-3 text-right bg-light">
                    <strong>Data Cadastro:</strong>
                </div>
                <div class="col-md bg-light">{{$date}}</div>
            </div>
            <hr>
            <div class="form-row">
                <a href="/admin/administrator/{{$id}}" class="btn btn-warning">Editar</a>
                <a href="{{'/admin/userlist'}}" class="btn btn-light">Voltar</a>
            </div>

        </div>
    </div>
</section>

@endsection
