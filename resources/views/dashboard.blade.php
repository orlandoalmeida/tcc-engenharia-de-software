@extends('layout.base')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h3 class="mb-0 font-size-18">Início</h3>
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
                            <div class="col-12">
                                <h3 class="d-flex align-items-center mb-0 text-white">
                                    {{ $total_usuarios }} <?= $total_usuarios != 1 ? 'Usuários' : 'Usuário' ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col">
                <div class="card bg-warning border-warning">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="card-title mb-0 text-white">Funcionários</h5>
                        </div>
                        <div class="row d-flex align-items-center mb-4">
                            <div class="col-12">
                                <h3 class="d-flex align-items-center text-white mb-0">
                                    {{ $total_funcionarios }}
                                    <?= $total_funcionarios != 1 ? 'Funcionários' : 'Funcionário' ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-info border-info">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="card-title mb-0 text-white">Clientes</h5>
                        </div>
                        <div class="row d-flex align-items-center mb-4">
                            <div class="col-12">
                                <h3 class="d-flex align-items-center text-white mb-0">
                                    {{ $total_clientes }} <?= $total_clientes != 1 ? 'Clientes' : 'Cliente' ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-info border-info">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="card-title mb-0 text-white">Produtos</h5>
                        </div>
                        <div class="row d-flex align-items-center mb-4">
                            <div class="col-12">
                                <h3 class="d-flex align-items-center text-white mb-0">
                                    {{ $total_produtos }} <?= $total_produtos != 1 ? 'Produtos' : 'Produto' ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @if (!empty($produtos_estoque_baixo[0]))
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Produtos com o estoque baixo</h4>
                            <div class="table-responsive">
                                <table class="table table-centered table-hover table-xl mb-0" id="recent-orders">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0 text-center">Produto</th>
                                            <th width="120" class="border-top-0 text-center">Preço</th>
                                            <th class="border-top-0 text-center">Estoque atual</th>
                                            <th class="border-top-0 text-center">Estoque Mínimo</th>
                                            <th class="border-top-0 text-center">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($produtos_estoque_baixo as $prod)
                                            <tr class="alert-danger">
                                                <td class="text-center"> {{ $prod->nome }}</td>
                                                <td class="text-center">R$ {{ number_format($prod->preco, 2, '.', '') }}</td>
                                                <td class="text-center"> {{ $prod->estoque }}</td>
                                                <td class="text-center"> {{ $prod->estoque_min }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('produto.edit', $prod->id) }}"
                                                        class="btn btn-primary btn-sm btn-rounded text-white">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            @endif

            @if (!empty($ultimas_vendas[0]))
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ultimas vendas realizadas</h4>
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover table-centered table-nowrap mb-0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h5 class="font-size-15 mb-1 font-weight-normal">4257 **** ****
                                                    7852</h5>
                                                <span class="text-muted font-size-12">11 April 2019</span>
                                            </td>
                                            <td>
                                                <h5 class="font-size-15 mb-1 font-weight-normal">$79.49</h5>
                                                <span class="text-muted font-size-12">Amount</span>
                                            </td>
                                            <td>
                                                <h5 class="font-size-17 mb-1 font-weight-normal"><i
                                                        class="fab fa-cc-visa"></i>
                                                </h5>
                                                <span class="text-muted font-size-12">Card</span>
                                            </td>
                                            <td>
                                                <h5 class="font-size-15 mb-1 font-weight-normal">Helen Warren
                                                </h5>
                                                <span class="text-muted font-size-12">Pay</span>
                                            </td>
                                        </tr>



                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>
@endsection
