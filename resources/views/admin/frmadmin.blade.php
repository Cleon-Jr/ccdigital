@extends('layouts.main')

@section('links')
    <link rel="stylesheet" href="{{asset('css/frm-style.css')}}">
@endsection

@section('content')
    <section class="container">

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

        <div class="card" id="carddAdmin">
            <h5 class="text-center">Cadastro de Administrador</h5>
            <hr class="mx-auto" width="80%">

            <div class="card-body">
                <form method="post" action="{{'/admin/adduser'}}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <input type="hidden" name="id" value="">
                            <label>CPF</label>
                            <input type="text" name="cpf" id="cpf" class="form-control" oninput="formatCPF(this)" value="" placeholder="Somente números">
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
                            <input type="email" name="email" id="email" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Senha</label>
                            <input type="password" name="pass" id="pass" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Confirmar Senha</label>
                            <input type="password" name="passConfirm" id="passconfirm" class="form-control" onblur="validatePass();">
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

    @if ($errors->any())
        <script>
            swal({
                title: "Contracheque Digital | Erro",
                text: "{{implode('\n', $errors->all())}}",
                icon: "error",
            });
        </script>
    @endif


    <script>
        function formatCPF(input) {
            let value = input.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
            let formattedValue = '';
                if (value.length > 0) {
                    formattedValue = value.substring(0, 3);
                }
                if (value.length >= 3) {
                    formattedValue += '.' + value.substring(3, 6);
                }
                if (value.length >= 6) {
                    formattedValue += '.' + value.substring(6, 9);
                }
                if (value.length >= 9) {
                    formattedValue += '-' + value.substring(9, 11);
                }                
                input.value = formattedValue;
            }

        function applyMask(){
            const cpf = document.getElementById('cpf');
            formatCNPJ(cpf);
        }

        window.onload = applyMask;
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
