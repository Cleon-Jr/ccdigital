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
            <hr class="mx-auto" width="80%">
            
            <button type="button" class="btn" data-toggle="collapse" data-target="#collapseUserInfo" aria-expanded="false" aria-controls="collapseUserInfo">
                <div class="row">
                    <div class="col-md-12">
                        <i class="bi bi-caret-down-fill"></i>
                        <h4>Cleon Oliveira</h4>                        
                    </div>
                </div>
            </button>

            {{-- Collapse --}}
            <div class="collapse" id="collapseUserInfo" data-parent="#accordionUserInfo">
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

    <!-- FOLHA DE PAGAMENTOS -->
     @if (!Session::has('payCheck'))
         
        <div class="accordion" id="accordionPay">
            <div class="card">
                <button type="button" class="btn" data-toggle="collapse" data-target="#collapsePay" aria-expanded="false" aria-controls="collapsePay">
                    <div class="row">
                        <div class="col-md-12">                            
                            <h4><i class="bi bi-caret-down-fill"></i>Matrícula: 1245</h4>
                            <h4>Competência: 01/2024<i class="bi bi-caret-down-fill"></i></h4>
                        </div>
                    </div>
                    <div class="box">
                        <span class="badge badge-pill badge-dark mr-auto">Sequência 0</span>
                    </div>
                </button>

                <div class="collapse" id="collapsePay" data-parent="#accordionPay">
                    <div class="card-body">                        
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card" id="cardEarnings">
                                    <h5>Vencimentos</h5>
                                    <p class="text-primary" >R$ 2.658,25</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card" id="cardDiscounts">
                                    <h5>Descontos</h5>
                                    <p class="text-danger">R$ 362,00</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card" id="cardNetValues">
                                    <h5>Valor Líquido</h5>
                                    <p class="text-success">R$ 1.568,21</p>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <h5 class="text-center">Detalhes</h5>

                        <div class="row" id="rowDetail1">
                            <div class="col-sm-4"><strong>PREFEITURA MUNICIPAL DE SANTO ANTONIO DO IÇA</strong></div>
                            <div class="col-sm-4"><strong>GABINETE DO PREFEITO</strong></div>
                            <div class="col-sm-4"><strong>PODER EXECUTIVO</strong></div>
                        </div>
                        <div class="row" id="rowDetail2">
                            <div class="col-sm-4"><strong>Cargo:</strong> AUXILIAR ADMINISTRATIVO</div>
                            <div class="col-sm-4"><strong>CBO:</strong> 411030</div>
                            <div class="col-sm-4"><strong>Data de Admissão:</strong> 02/01/2012</div>
                        </div>
                        <hr>
                        <h5 class="text-center">Ítens de Contracheque</h5>
                        <div class="row" id="rowItems">
                            <div class="col-sm-1"><strong>Código</strong></div>
                            <div class="col-sm-3"><strong>Descrição</strong></div>
                            <div class="col-sm-2"><strong>Referência</strong></div>
                            <div class="col-sm-3"><strong>Remunerações</strong></div>
                            <div class="col-sm-3"><strong>Descontos</strong></div>
                        </div>
                        <div class="row" id="rowItems">
                            <div class="col-sm-1"><strong>1</strong></div>
                            <div class="col-sm-3"><strong>SALARIO BASE</strong></div>
                            <div class="col-sm-2"><strong>30,00</strong></div>
                            <div class="col-sm-3"><strong>1.412,00</strong></div>
                            <div class="col-sm-3"><strong></strong></div>
                        </div>
                        <div class="row" id="rowItems">
                            <div class="col-sm-1"><strong>505</strong></div>
                            <div class="col-sm-3"><strong>CONSIGNAÇÃO BRADESCO</strong></div>
                            <div class="col-sm-2"><strong></strong></div>
                            <div class="col-sm-3"><strong></strong></div>
                            <div class="col-sm-3"><strong>491,95</strong></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

     @endif

    
    {{-- MODAL SELECT --}}
    <div class="modal fade" id="modalSelect" tabindex="-1" aria-labelledby="modalSelect" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
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
