@extends('layouts.main')

@section('links')
    <link rel="stylesheet" href="{{asset('css/frm-style.css')}}">
@endsection

@section('content')
    <section class="container">

        <div class="card" id="carddAdmin">
            <h5 class="text-center">Cadastro de Administrador</h5>
            <hr class="mx-auto" width="80%">

            <div class="card-body">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>CPF</label>
                            <input type="text" name="cpf" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label>Nome Completo</label>
                            <input type="text" name="fullname" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label>E-mail</label>
                            <input type="email" name="email" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Senha</label>
                            <input type="password" name="pass" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Confirmar Senha</label>
                            <input type="password" name="passConfirm" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="form-row" id="footer">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-success">Salvar</button>
                            <a href="{{'/admin/userlist'}}" class="btn btn-light">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </section>
    <br>
@endsection
