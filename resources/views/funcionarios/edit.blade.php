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
                        <h4 class="mb-0 font-size-18">Editar Funcionário</h4>
                    </div>
                    <div class="">
                        <a href="{{ route('funcionario.index') }}" class="btn btn-primary pull-right"><i
                                class="fa fa-arrow-left"></i> Listar Funcionários</a>
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

                        <form action="{{ route('funcionario.update', $funcionario->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row form-group">
                                <div class="col">
                                    <label for="nome">Nome <span class="text-danger">*</span></label>
                                    <input type="text" id="nome" name="nome" value="{{ $funcionario->nome }}"
                                        class="form-control" required="required" placeholder="Fulano de tal">
                                </div>
                                <div class="col">
                                    <label for="email">Email <span class="text-danger">*</span>
                                        <span id="msg_email_invalid" class="text-danger"></span>
                                    </label>
                                    <input type="email" id="email" name="email" value="{{ $funcionario->email }}"
                                        class="form-control" required="required" placeholder="meuemail@gmail.com">
                                </div>
                                <div class="col">
                                    <label for="telefone">Telefone <span class="text-danger">*</span></label>
                                    <input type="text" id="telefone" name="telefone" value="{{ $funcionario->telefone }}"
                                        class="form-control telefone" required="required"
                                        placeholder="Telefone para contato do funcionário">
                                </div>


                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label for="telefone">Cpf <span class="text-danger">*</span>
                                        <span id="msg_cpf_invalid" class="text-danger"></span>
                                    </label>
                                    <input type="text" id="cpf" name="cpf" value="{{ $funcionario->cpf }}"
                                        class="form-control cpf" required="required" placeholder="CPF">
                                </div>
                                <div class="col">
                                    <label for="rg">RG</label>
                                    <input type="text" id="rg" name="rg" value="{{ $funcionario->rg }}"
                                        class="form-control rg" placeholder="RG do funcionário">
                                </div>
                                <div class="col">
                                    <label for="data_nascimento">Data de Nascimento
                                        <span id="msg_data_nascimento_invalid" class="text-danger"></span>
                                    </label>
                                    <input type="text" id="data_nascimento" name="data_nascimento"
                                        value="{{ date('d/m/Y', strtotime($funcionario->data_nascimento)) }}"
                                        class="form-control data" placeholder="Data de nascimento do funcionário">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label for="sexo">Sexo</label>
                                    <select class="form-control" name="sexo" id="sexo">
                                        <option value="1">Masculino</option>
                                        <option value="2">Feminino</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="salario">Salário</label>
                                    <input type="text" id="salario" name="salario" value="{{ number_format($funcionario->salario, 2, '.', '') }}"
                                        class="form-control money" placeholder="Salário do funcionário">
                                </div>
                                <div class="col">
                                    <label for="cargo">Cargo</label>
                                    <select class="form-control" name="cargo" id="cargo">
                                        @foreach ($cargos as $cargo)
                                            <option value="{{ $cargo->id }}">{{ $cargo->nome }}</option>
                                        @endforeach
                                    </select>
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
                                        value="{{ $funcionario->cep }}">
                                </div>
                                <div class="col-5">
                                    <label for="endereco">Endereço</label>
                                    <input type="text" name="endereco" id="endereco" class="form-control rua"
                                        value="{{ $funcionario->endereco }}">
                                </div>
                                <div class="col-2">
                                    <label for="numero">Número</label>
                                    <input type="text" name="numero" id="numero" class="form-control numero"
                                        value="{{ $funcionario->numero }}">
                                </div>
                                <div class="col-3">
                                    <label for="bairro">Bairro</label>
                                    <input type="text" name="bairro" id="bairro" class="form-control bairro"
                                        value="{{ $funcionario->bairro }}">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col">
                                    <label for="complemento">Complemento</label>
                                    <input type="text" name="complemento" id="complemento" class="form-control complemento"
                                        value="{{ $funcionario->complemento }}">
                                </div>
                                <div class="col">
                                    <label for="cidade">Cidade</label>
                                    <input type="text" name="cidade" id="cidade" class="form-control cidade"
                                        value="{{ $funcionario->cidade }}">
                                </div>
                                <div class="col">
                                    <label for="uf">UF/Estado</label>
                                    <input type="text" name="uf" id="uf" class="form-control uf"
                                        value="{{ $funcionario->uf }}">
                                </div>
                            </div>

                            <br>
                            <h4>Foto de perfil</h4>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="input-file-now-custom-1">Selecione uma imagem para a foto de perfil do
                                        funcionário</label>
                                    <input type="file" id="input-file-now-custom-1" name="foto_perfil"
                                        data-allowed-file-extensions="png jpeg jpg" class="dropify"
                                        data-default-file="{{ asset("$funcionario->foto_perfil") }}" />
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
        $('#menu-funcionarios-index a').addClass('active mm-active');
        $('#menu-funcionarios ul').addClass("mm-show active mm-active").attr("aria-expanded", "true");

        $(document).ready(function() {
            $('#sexo').val("{{ $funcionario->sexo }}");
            $('#cargo').val("{{ $funcionario->cargo }}");

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
