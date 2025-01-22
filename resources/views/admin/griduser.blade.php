@extends('layouts.main')

@section('links')
    <link rel="stylesheet" href="{{asset('css/grid-style.css')}}">
@endsection

@section('content')

<h4 id="pageTitle">Usuários</h4>
<hr class="mx-auto" width="98%">

<div class="container-fluid">
    <div class="top-control">
        <a href="{{'/admin/administrator/0'}}" class="btn btn-light" title="Adicionar novo administrador">Adicionar</a>
        <form method="get" action="/admin/search" class="form form-inline col-md">
            {{-- @csrf --}}
            <input type="text" name="search" class="form-control col-md-4" placeholder="Procure por CPF ou Nome">
            <button type="submit" class="btn btn-search" title="Procurar registro"><i class="bi bi-search"></i></button>
        </form>
    </div>

    @if (Session::has('attention'))
        <script>
            swal({
                title: "Contracheque Digital | ATENÇÃO",
                text: "{{Session::get('attention')}}",
                icon: "warning",
            });
        </script>
    @endif

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
                    <td class="text-center"><a href="/admin/viewadministrator/{{$item->adm_id}}"><i class="bi bi-view-stacked text-success" title="Visualizar registro"></i></a></td>
                    <td class="text-center"><a href="/admin/administrator/{{$item->adm_id}}"><i class="bi bi-pencil-square text-warning" title="Editar registro"></i></a></td>
                    <td class="text-center"><a href="#" onclick="del({{$item->adm_id}})"><i class="bi bi-trash-fill text-danger" title="Excluir registro"></i></a></td>
                </tr>
            @endforeach
        </tbody>
        <tr id="tfooter">
            <td colspan="8">Quantidade de registros: {{$qnt}}</td>
        </tr>
    </table>
    {{$adminUser->links('vendor.pagination.default')}}
    <br>
    <br>
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

<script type="text/javascript">
    function del(id){
        swal({
            title: "Contracheque Digital | ATENÇÃO",
            text: "Você tem certeza que deseja excluir o registro de ID " + id + "?",
            icon: "warning",
            buttons: ["Não", "Sim"],
            dangerMode:true,
        }).then((willDelete) => {
            if(willDelete){
                window.location.href="{{'/admin/deladmin/'}}" + id;
            }
        });
    }
</script>

@endsection
