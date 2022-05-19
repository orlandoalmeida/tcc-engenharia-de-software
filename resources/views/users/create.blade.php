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
                        <h4 class="mb-0 font-size-18">Novo Usuário</h4>
                    </div>
                    <div class="">
                        <a href="{{ route('usuario.index') }}" class="btn btn-primary pull-right"><i
                                class="fa fa-arrow-left"></i> Listar Usuários</a>
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

                        <form action="{{ route('usuario.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row form-group">
                                <div class="col">
                                    <label for="name">Nome <span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                                        class="form-control" required="required" placeholder="Fulano de tal">
                                </div>
                                <div class="col">
                                    <label for="email">Email <span class="text-danger">*</span> <span
                                            id="msg_email_invalid" class="text-danger"></span></label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                        class="form-control" required="required" placeholder="meuemail@gmail.com">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <label for="password">Senha <span class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        required="required">
                                </div>
                                <div class="col">
                                    <label for="password">Confirmar Senha <span class="text-danger">*</span>
                                        <span id="msg_password_dont_match"></span>
                                    </label>
                                    <input type="password" id="confirm_password" name="confirm_password"
                                        class="form-control" required="required">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="input-file-now-custom-1">Selecione uma imagem para o avatar do usuário
                                        screen</label>
                                    <input type="file" id="input-file-now-custom-1" name="profile_picture"
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
    <script src="{{ asset('js/verify-if-exist.js') }}"></script>
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
                        $('#email').focus();
                    }
                }
            });

            $('#password').on('focusout', () => {
                check_password();
            });
            $('#confirm_password').on('focusout', () => {
                check_password();
            });

            function check_password() {
                let pass = $('#password').val();
                let confirm_pass = $('#confirm_password').val();
                if (confirm_pass.length > 0) {
                    if (confirm_pass === pass && confirm_pass.length == pass.length) {
                        $('#msg_password_dont_match').empty().append('').removeAttr('class');;
                        $('#msg_password_dont_match').prepend(
                                '<i class="fa fa-check-circle"></i> As senhas conferem').addClass('text-success')
                            .show();
                    } else {
                        $('#msg_password_dont_match').empty().append('').removeAttr('class');
                        $('#msg_password_dont_match').prepend(
                                '<i class="fa fa-times-circle"></i> As senhas não conferem').addClass('text-danger')
                            .show();
                    }
                }
            }

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
