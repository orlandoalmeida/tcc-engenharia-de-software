@extends('layout.base')
@section('app-css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropify/dist/css/dropify.min.css') }}">
@endSection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="topo-cadastros col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Novo Cliente</h4>
                    </div>
                    <div class="">
                        <a href="{{ route('cliente.index') }}" class="btn btn-primary pull-right"><i
                                class="fa fa-arrow-left"></i> Listar Clientes</a>
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

                        <form action="{{ route('cliente.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row form-group">
                                <div class="col">
                                    <label for="nome">Nome <span class="text-danger">*</span></label>
                                    <input type="text" id="nome" name="nome" value="{{ old('nome') }}"
                                        class="form-control" required="required" placeholder="Fulano de tal">
                                </div>
                                <div class="col">
                                    <label for="email">Email <span class="text-danger">*</span>
                                        <span id="msg_email_invalid" class="text-danger"></span>
                                    </label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                        class="form-control" required="required" placeholder="meuemail@gmail.com">
                                </div>
                                <div class="col">
                                    <label for="telefone">Telefone <span class="text-danger">*</span></label>
                                    <input type="text" id="telefone" name="telefone" value="{{ old('telefone') }}"
                                        class="form-control telefone" required="required"
                                        placeholder="Telefone para contato do cliente">
                                </div>

                            </div>
                            <br>
                            <h4>Endereço</h4>
                            <hr>
                            <div class="row form-group">
                                <div class="col-2">
                                    <label for="cep">Cep <span class="text-danger">*</span>
                                        <span id="cep-invalido" class="text-danger"></span>
                                    </label>
                                    <input type="text" name="cep" id="cep" class="form-control cep" required="required"
                                        value="{{ old('cep') }}">
                                </div>
                                <div class="col-5">
                                    <label for="endereco">Endereço</label>
                                    <input type="text" name="endereco" id="endereco" class="form-control rua"
                                        value="{{ old('endereco') }}">
                                </div>
                                <div class="col-2">
                                    <label for="numero">Número</label>
                                    <input type="text" name="numero" id="numero" class="form-control numero"
                                        value="{{ old('numero') }}">
                                </div>
                                <div class="col-3">
                                    <label for="bairro">Bairro</label>
                                    <input type="text" name="bairro" id="bairro" class="form-control bairro"
                                        value="{{ old('bairro') }}">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col">
                                    <label for="complemento">Complemento</label>
                                    <input type="text" name="complemento" id="complemento" class="form-control complemento"
                                        value="{{ old('complemento') }}">
                                </div>
                                <div class="col">
                                    <label for="cidade">Cidade</label>
                                    <input type="text" name="cidade" id="cidade" class="form-control cidade"
                                        value="{{ old('cidade') }}">
                                </div>
                                <div class="col">
                                    <label for="uf">UF/Estado</label>
                                    <input type="text" name="uf" id="uf" class="form-control uf"
                                        value="{{ old('uf') }}">
                                </div>
                            </div>

                            <br>
                            <h4>Foto de perfil</h4>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="input-file-now-custom-1">Selecione uma imagem para a foto de perfil do
                                        cliente</label>
                                    <input type="file" id="input-file-now-custom-1" name="foto_perfil"
                                        data-allowed-file-extensions="png jpeg jpg" class="dropify"
                                        data-default-file="" />
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
    <script src="{{ asset('assets/plugins/dropify/dist/js/dropify.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#msg_email_invalid').hide();
            $('#msg_password_dont_match').hide();
            $('#email').on('focusout', () => {
                let email = $('#email').val();
                if (email.length > 0) {
                    let is_valid = validateEmail(email);
                    if (is_valid) {
                        $('#msg_email_invalid').hide();
                    } else {
                        $('#msg_email_invalid').text('E-mail inválido').show();
                        $('#email').val('');
                        $('#email').focus();
                    }
                }
            });

            $('#cpf').on('focusout', () => {
                let cpf = $('#cpf').val();
                if (cpf.length > 0) {
                    let is_valid = validateCPF(cpf);
                    if (is_valid) {
                        $('#msg_cpf_invalid').hide();
                    } else {
                        $('#msg_cpf_invalid').text('CPF inválido').show();
                        $('#cpf').val('');
                        $('#cpf').focus();
                    }
                }
            });

            $('#data_nascimento').on('focusout', function() {
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
                        if (dia <= 31 && mes <= 12 && ano <= ano_corrente) {
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
                                $('#msg_data_nascimento_invalid').text('Idade maior que 100 anos').show();
                                $('#data_nascimento').val('');
                                $('#data_nascimento').focus();
                            } else {
                                $('#msg_data_nascimento_invalid').hide();
                            }
                        } else {
                            $('#msg_data_nascimento_invalid').text('Data de nascimento inválida').show();
                            $('#data_nascimento').val('');
                            $('#data_nascimento').focus();
                        }
                    } else {
                        $('#msg_data_nascimento_invalid').text('Data de nascimento inválida').show();
                        $('#data_nascimento').val('');
                    }
                }
            });

            $(".cep").keyup(function() {
                if ($(this).val().length >= 9) {
                    completaEndereco($(this).val());
                    if ($(".numero").length) {
                        $(".num").focus();
                    } else {
                        $(".cep").blur();
                    }
                }
            });

            $('.dropify').dropify({
                messages: {
                    default: 'Clique aqui para selecionar uma imagem',
                    replace: 'Clique em remover para selecionar uma nova imagem',
                    remove: 'Remover',
                    error: 'Ocorreu um erro ao alterar a imagem'
                },
            });

        });
    </script>
@endSection
