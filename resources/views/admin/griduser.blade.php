@extends('layouts.main')

@section('links')
    <link rel="stylesheet" href="{{asset('css/grid-style.css')}}">
@endsection

@section('content')

<h4 id="pageTitle">Usuários</h4>
<hr class="mx-auto" width="98%">

<div class="container-fluid">
    <div class="top-control">
        <a href="{{'/admin/administrator'}}" class="btn btn-light" title="Adicionar novo administrador">Adicionar</a>
        <form class="form form-inline col-md">
            <input type="text" name="search" value="" class="form-control col-md-4" placeholder="Procure por CPF ou Nome">
            <button type="submit" class="btn btn-search" title="Procurar registro"><i class="bi bi-search"></i></button>
        </form>
    </div>

    <table class="table table-hover table-bordered table-light">
        <thead>
            <tr>
                <th>ID</td>
                <th>CPF</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Data</th>
                <th colspan="3" class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adminUser as $item)
                <tr>
                    <td>{{$item->adm_id}}</td>
                    <td>{{$item->adm_cpf}}</td>
                    <td>{{$item->adm_name}}</td>
                    <td>{{$item->adm_email}}</td>
                    <td>{{$item->adm_date}}</td>
                    <td class="text-center"><i class="bi bi-view-stacked text-success" title="Visualizar registro"></i></td>
                    <td class="text-center"><i class="bi bi-pencil-square text-warning" title="Editar registro"></i></td>
                    <td class="text-center"><i class="bi bi-trash-fill text-danger" title="Excluir registro"></i></td>
                </tr>
            @endforeach
        </tbody>
        <tr id="tfooter">
            <td colspan="8">Footer</td>
        </tr>
    </table>
    {{$adminUser->links('vendor.pagination.default')}}
    <br>
    <br>
</div>

@endsection
