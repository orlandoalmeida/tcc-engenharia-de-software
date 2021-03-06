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
                        <h4 class="mb-0 font-size-18">Editar Produto</h4>
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

                        <form action="{{ route('produto.update', $produto->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row form-group">
                                <div class="col">
                                    <label for="nome">Nome <span class="text-danger">*</span></label>
                                    <input type="text" id="nome" name="nome" value="{{$produto->nome}}"
                                        class="form-control" required="required" placeholder="Iphone XYZ">
                                </div>
                                <div class="col">
                                    <label for="preco">Pre??o <span class="text-danger">*</span></label>
                                    <input type="text" id="preco" name="preco" value="{{ number_format($produto->preco, 2, '.', '') }}"
                                        class="form-control money" required="required" placeholder="Pre??o do produto">
                                </div>
                                <div class="col">
                                    <label for="estoque">Estoque Atual <span class="text-danger">*</span></label>
                                    <input type="number" id="estoque" name="estoque" value="{{$produto->estoque}}"
                                        class="form-control" required="required" placeholder="50">
                                </div>
                                <div class="col">
                                    <label for="email">Estoque M??nimo <span class="text-danger">*</span></label>
                                    <input type="number" id="estoque_min" name="estoque_min"
                                        value="{{$produto->estoque_min}}" class="form-control" required="required"
                                        placeholder="3">
                                </div>
                            </div>

                            <br>
                            <div class="row form-group">
                                <div class="col">
                                    <h4><label for="descricao">Descri????o do produto</label></h4>
                                    <textarea id="descricao" name="descricao" class="summernote">
                                        {{ $produto->descricao }}
                                    </textarea>
                                </div>
                            </div>

                            <br>
                            <h4>Foto do produto</h4>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="input-file-now-custom-1">Selecione uma imagem para o produto</label>
                                    <input type="file" id="input-file-now-custom-1" name="img"
                                        data-allowed-file-extensions="png jpeg jpg" class="dropify"
                                        data-default-file="{{ asset("$produto->img") }}" />
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
        $('#menu-produtos-index a').addClass('active mm-active');
        $('#menu-produtos ul').addClass("mm-show active mm-active").attr("aria-expanded", "true");
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
