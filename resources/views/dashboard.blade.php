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
                            <h2 class="d-flex align-items-center mb-0 text-white">
                                {{$total_users}} <?= $total_users > 1 ? 'Usuários' : 'Usuário' ?>
                            </h2>
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
                            <h2 class="d-flex align-items-center text-white mb-0">
                                1,15,187
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col">
            <div class="card bg-info border-info">
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="card-title mb-0 text-white">FOO</h5>
                    </div>
                    <div class="row d-flex align-items-center mb-4">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center text-white mb-0">
                                1,15,187
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->
    </div>

    </div>
@endsection