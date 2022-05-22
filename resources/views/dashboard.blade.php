@extends('layout.base')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Início</h4>
                    </div>
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col">
            <div class="card bg-primary border-primary">
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="card-title mb-0 text-white">Usuários do sistema</h5>
                    </div>
                    <div class="row d-flex align-items-center mb-4">
                        <div class="col-8">
                            <h3 class="d-flex align-items-center mb-0 text-white">
                                {{$total_usuarios}} <?= $total_usuarios != 1 ? 'Usuários' : 'Usuário' ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->


        <div class="col">
            <div class="card bg-warning border-warning">
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="card-title mb-0 text-white">Funcionários</h5>
                    </div>
                    <div class="row d-flex align-items-center mb-4">
                        <div class="col-8">
                            <h3 class="d-flex align-items-center text-white mb-0">
                                {{$total_funcionarios}} <?= $total_funcionarios != 1 ? 'Funcionários' : 'Funcionário' ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col">
            <div class="card bg-info border-info">
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="card-title mb-0 text-white">Clientes</h5>
                    </div>
                    <div class="row d-flex align-items-center mb-4">
                        <div class="col-8">
                            <h3 class="d-flex align-items-center text-white mb-0">
                                {{$total_clientes}} <?= $total_clientes != 1 ? 'Clientes' : 'Cliente' ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->
    </div>

    </div>
@endsection