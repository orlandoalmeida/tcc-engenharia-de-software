@extends('layout.base')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="topo-cadastros col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Editar Conta</h4>
                    </div>
                    <div class="">
                        <a href="{{ route('conta.index') }}" class="btn btn-primary pull-right"><i
                                class="fa fa-arrow-left"></i> Listar Contas</a>
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

                        <form action="{{ route('conta.update', $conta->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row form-group">
                                <div class="col">
                                    <label for="nome">Nome <span class="text-danger">*</span></label>
                                    <input type="text" id="nome" name="nome" value="{{ $conta->nome }}"
                                        class="form-control" required="required" placeholder="Conta de luz">
                                </div>
                                <div class="col">
                                    <label for="valor">Valor <span class="text-danger">*</span></label>
                                    <input type="text" id="valor" name="valor"
                                        value="{{ number_format($conta->valor, 2, '.', '') }}" class="form-control money"
                                        required="required" placeholder="Valor da conta">
                                </div>
                                <div class="col">
                                    <label for="data">Data da Conta
                                        <small id="msg_data_invalid" class="text-danger"></small>
                                    </label>
                                    <input type="text" id="data" name="data"
                                        value="{{ date('d/m/Y', strtotime($conta->data)) }}" class="form-control data">
                                </div>
                                <div class="col">
                                    {{-- tipo 1 = pagar  tipo 2 = receber --}}
                                    <label for="tipo">Tipo de Conta<span class="text-danger">*</span></label>
                                    <select name="tipo" id="tipo" class="form-control" required>
                                        <option value="1">Pagar</option>
                                        <option value="2">Receber</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col form-group text-center">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Gravar
                                        Dados</button>
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
    <script>
        $('#data').on('focusout', function() {
            let data = $(this).val();
            if (data.length > 0) {
                if (data && data != '//') {
                    data = data.split('/');
                    var dia = data[0];
                    var mes = data[1];
                    var ano = data[2];
                    var now = new Date();
                    var dia_corrente = now.getUTCDate();
                    var mes_corrente = (now.getUTCMonth() + 1);
                    var ano_corrente = now.getUTCFullYear();
                    var idade = '';
                    if (dia <= 31 && mes <= 12 && ano < (ano_corrente + 10)) {
                        if (mes_corrente >= mes) {
                            if (mes_corrente > mes) {
                                idade = ano_corrente - ano;
                            }
                            if (mes_corrente == mes) {
                                if (dia_corrente >= dia) {
                                    idade = ano_corrente - ano;
                                } else {
                                    idade = (ano_corrente - ano) - 1;
                                }
                            }
                        } else {
                            idade = (ano_corrente - ano) - 1;
                        }
                        if (idade > 100) {
                            $('#msg_data_invalid').text('Data maior que 100 anos').show();
                            $('#data').val('');
                            $('#data').focus();
                        } else {
                            $('#msg_data_invalid').hide();
                        }
                    } else {
                        if (ano > (ano_corrente + 10)) {
                            $('#msg_data_invalid').text('Data máxima até 10 anos').show();
                        } else {
                            $('#msg_data_invalid').text('Data inválida').show();
                        }
                        $('#data').val('');
                        $('#data').focus();
                    }
                } else {
                    $('#msg_data_invalid').text('Data inválida').show();
                    $('#data').val('');
                }
            }
        });
        setTimeout(() => {
            $('#tipo').val('{{$conta->tipo}}').trigger('change');
        }, 200);
    </script>
@endsection
