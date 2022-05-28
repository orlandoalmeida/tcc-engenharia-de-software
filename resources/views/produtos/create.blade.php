@extends('layout.base')
@section('app-css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropify/dist/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote.min.css') }}">
@endSection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="topo-cadastros col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Novo Produto</h4>
                    </div>
                    <div class="">
                        <a href="{{ route('produto.index') }}" class="btn btn-primary pull-right"><i
                                class="fa fa-arrow-left"></i> Listar Produtos</a>
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

                        <form action="{{ route('produto.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row form-group">
                                <div class="col">
                                    <label for="nome">Nome <span class="text-danger">*</span></label>
                                    <input type="text" id="nome" name="nome" value="{{ old('nome') }}"
                                        class="form-control" required="required" placeholder="Iphone XYZ">
                                </div>
                                <div class="col">
                                    <label for="preco">Preço <span class="text-danger">*</span></label>
                                    <input type="text" id="preco" name="preco" value="{{ old('preco') }}"
                                        class="form-control money" required="required" placeholder="Preço do produto">
                                </div>
                                <div class="col">
                                    <label for="estoque">Estoque Atual <span class="text-danger">*</span></label>
                                    <input type="number" id="estoque" name="estoque" value="{{ old('estoque') }}"
                                        class="form-control" required="required" placeholder="50">
                                </div>
                                <div class="col">
                                    <label for="email">Estoque Mínimo <span class="text-danger">*</span></label>
                                    <input type="number" id="estoque_min" name="estoque_min"
                                        value="{{ old('estoque_min') }}" class="form-control" required="required"
                                        placeholder="3">
                                </div>
                            </div>

                            <br>
                            <div class="row form-group">
                                <div class="col">
                                    <h4><label for="descricao">Descrição do produto</label></h4>
                                    <textarea id="descricao" name="descricao" class="summernote">
                                        {{ old('descricao') }}
                                    </textarea>
                                </div>
                            </div>

                            <br>
                            <h4>Foto do produto</h4>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="input-file-now-custom-1">Selecione uma imagem para o produto</label>
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
    <script src="{{ asset('assets/plugins/summernote/summernote.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify({
                messages: {
                    default: 'Clique aqui para selecionar uma imagem',
                    replace: 'Clique em remover para selecionar uma nova imagem',
                    remove: 'Remover',
                    error: 'Ocorreu um erro ao alterar a imagem'
                },
            });


            $('.summernote').summernote({
                height: 200,
            });

        });
    </script>
@endSection
