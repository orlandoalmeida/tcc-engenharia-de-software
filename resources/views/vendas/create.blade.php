@extends('layout.base')
@section('app-css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
@endSection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="topo-cadastros col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Nova Venda</h4>
                    </div>
                    <div class="">
                        <a href="{{ route('venda.index') }}" class="btn btn-primary pull-right"><i
                                class="fa fa-arrow-left"></i> Listar Vendas</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('venda.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row form-group">
                                <div class="col">
                                    <label for="cliente">Cliente <span class="text-danger">*</span></label>
                                    <select name="cliente" id="cliente" class="form-control" required="required">
                                        <option value="" selected disabled>Selecione um cliente</option>
                                        @empty(!$clientes)
                                            @foreach ($clientes as $cliente)
                                                <option value="{{ $cliente->nome }}">{{ $cliente->nome }}</option>
                                            @endforeach
                                        @endempty
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="produto">Produto <span class="text-danger">*</span></label>
                                    <select name="produto" id="produto" class="form-control" required="required">
                                        <option value="" data-id="0" selected disabled>Selecione um produto</option>
                                        @empty(!$produtos)
                                            @foreach ($produtos as $produto)
                                                <option data-id="{{ $produto->id }}" data-estoque="{{ $produto->estoque }}"
                                                    data-preco="{{ number_format($produto->preco, 2, '.', '') }}"
                                                    value="{{ $produto->nome }}">{{ $produto->nome }} | R$
                                                    {{ number_format($produto->preco, 2, '.', '') }}</option>
                                            @endforeach
                                        @endempty
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label for="quantidade">Quantidade<span class="text-danger">*</span>&nbsp;
                                        <small id="estoque-maximo-aviso" class="text-danger"></small>
                                    </label>
                                    <input type="number" id="quantidade" name="quantidade" class="form-control"
                                        required="required">
                                </div>
                                <div class="col-2">
                                    <label for="forma_pagamento">Forma de pagamento<span
                                            class="text-danger">*</span></label>
                                    <select name="forma_pagamento" id="forma_pagamento" class="form-control">
                                        <option value="1">Cartão de Crédito</option>
                                        <option value="2">Cartão de Débito</option>
                                        <option value="3">Pix</option>
                                        <option value="4">Dinheiro</option>
                                        <option value="5">Boleto</option>
                                        <option value="6">Cheque</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12 d-none" id="total-pagar-div">
                                    <h4>Total a pagar: R$ <span id="total_pagar_span"></span></h4>
                                </div>
                            </div>
                            <br>
                            <div class="row mt-3">
                                <div class="col form-group text-center">
                                    <input type="hidden" name="valor_unitario" id="valor_unitario">
                                    <input type="hidden" name="valor_total" id="valor_total">
                                    <input type="hidden" name="produto_id" id="produto_id">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>&nbsp;
                                        Efetuar Venda</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endSection
@section('app-js')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script>
        $('#cliente').select2();
        $('#produto').select2();
        $('#forma_pagamento').select2();
        var id = 0;
        var preco = 0.00;
        var estoque = 0;
        $('#produto').on('change', () => {
            id = $('#produto').find(":selected").data('id');
            if (id > 0) {
                $('#produto_id').val(id);
                $('#estoque-maximo-aviso').text('');
                estoque = $('#produto').find(":selected").data('estoque');
                preco = $('#produto').find(":selected").data('preco');
                $('#quantidade').val(1);
                $('#total-pagar-div').removeClass('d-none');
                $('#total_pagar_span').html(preco);
                $('#valor_unitario').val(preco);
                $('#valor_total').val(preco);
            }
        });

        $('#quantidade').on('change', ()=>{
            let qtd = $('#quantidade').val();
            $('#total-pagar-div').removeClass('d-none');
            $('#total_pagar_span').html(preco);
            if(qtd > 0){
                if(qtd > estoque){
                    $('#estoque-maximo-aviso').text('máximo: ' + estoque);
                    let novo_preco = (preco * estoque).toFixed(2);
                    $('#quantidade').val(estoque);
                    $('#total_pagar_span').html(novo_preco);
                    $('#valor_total').val(novo_preco);
                }else{
                    $('#estoque-maximo-aviso').text('');
                    let novo_preco = (preco * qtd).toFixed(2);
                    $('#total_pagar_span').html(novo_preco);
                    $('#valor_total').val(novo_preco);
                }
            }else{
                $('#estoque-maximo-aviso').text('');
                $('#quantidade').val(1);
                $('#total_pagar_span').html(preco);
                $('#valor_unitario').val(preco);
                $('#valor_total').val(preco);
            }
        });
    </script>
@endSection
