@extends('layouts.p_main')

@section('links')
    <link rel="stylesheet" href="{{asset('css/p_dash-style.css')}}">
@endsection

@section('content')
<nav class="header">
    <h4 class="text-center">Demonstrativo Financeiro</h4>
</nav>

<section class="container">
    {{-- Informações Pessoais --}}
    <div class="accordion" id="accordionUserInfo">
        <div class="card">
            <h4 class="text-center">Informações Cadastrais</h4>
            
            
            {{-- Collapse --}}
            <div class="collapse" id="collapseUserInfo" data-parent="#accordionUserInfo" aria-labelledby="headerUserInfo">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4"><strong>CPF</strong></div>
                        <div class="col-md">598.182.472-72</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>RG</strong></div>
                        <div class="col-md">1334389-0</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>Data de Nascimento</strong></div>
                        <div class="col-md">08/02/1978</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>Nome da Mãe</strong></div>
                        <div class="col-md">Tereza Ângela Bezerra</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>PISPASEP</strong></div>
                        <div class="col-md">123454646848</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>E-mail</strong></div>
                        <div class="col-md">cleon@gmail.com</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><strong>Cidade</strong></div>
                        <div class="col-md">Manaus</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    {{-- MODAL SELECT --}}
    <div class="modal fade" id="modalSelect" tabindex="-1" aria-labelledby="modalSelect" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Filtro de Folha de Pagamento</h5>
                    <button class="close" data-dismiss="modal"><i class="bi-x-circle-fill"></i></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Nome do Colaborador</label>
                                <input type="text" name="fullname" class="form-control" value="Cleon Oliveira" readonly>
                            </div>
                        </div>                        
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Ano</label>
                                <select name="year" class="form-control">
                                    <option value="">2024</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Mês</label>
                                <select name="year" class="form-control">
                                    <option value="">Fevereiro</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Sequência</label>
                                <select name="year" class="form-control">
                                    <option value="">0</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <button type="submit" class="btn btn-success">Visualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Folhas de pagamento --}}
            {{-- Collapse --}}
            <div class="collapse show" id="collapsePayInfo" data-parent="#accordionPayInfo" aria-labelledby="headerPayInfo">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4"><strong>SEC MUN DE DES. RURAL, PROD E ABAST</strong></div>
                        <div class="col-sm-4"><strong>PROGRAMAS DE ASSISTENCIA SOCIAL</strong></div>
                        <div class="col-sm-4"><strong>PROGRAMA - SAUDE DA FAMILIA - EFETIVOS</strong></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><strong>Admissão:</strong> 01/11/2019</div>
                        <div class="col-sm-2"><strong>CBO:</strong> 231205</div>
                        <div class="col-sm-4"><strong>Cargo:</strong> AGENTE COMUNITARIO DE SAUDE</div>
                        <div class="col-sm-2"><strong>C/HM:</strong> 200</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">                            
                            <h5 class="text-center">Ítens de Contracheque</h5>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col-sm-2"><strong>Código:</strong></div>
                        <div class="col-sm-4"><strong>Descrição:</strong></div>
                        <div class="col-sm-2"><strong>Referência:</strong></div>
                        <div class="col-sm-2"><strong>Vencimentos:</strong></div>
                        <div class="col-sm-2"><strong>Descontos:</strong></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">1</div>
                        <div class="col-sm-4">SALÁRIO BASE</div>
                        <div class="col-sm-2">30,00</div>
                        <div class="col-sm-2">1.458,54</div>
                        <div class="col-sm-2"></div>                        
                    </div>
                    <div class="row">
                        <div class="col-sm-2">997</div>
                        <div class="col-sm-4">INSS</div>
                        <div class="col-sm-2">12,00</div>
                        <div class="col-sm-2"></div>
                        <div class="col-sm-2">178,32</div>                        
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            Imprimir Contracheque
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>


</section>

<!-- Ajuste da altura do iframe -->
<script type="text/javascript">
    function calcHeight(){
        var the_height = 0;
        the_height = document.getElementById('myFrame')
        .contentWindow.document.body.scrollHeight;
        document.getElementById('myFrame').height = the_height;
    }
</script>
@endsection
