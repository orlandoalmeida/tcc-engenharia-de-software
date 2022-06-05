@extends('layout.base')
@section('app-css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/select.bootstrap4.css') }}">
@endSection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="topo-cadastros col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Lista de Produtos</h4>
                    </div>
                    <div class="">
                        <a href="{{ route('produto.create') }}" class="btn btn-primary pull-right"><i
                                class="fa fa-plus-circle"></i> Novo Produto</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Produtos</h4>
                        <table id="datatable-buttons" class="table table-stripeds">
                            <thead class="thead-light">
                                <tr>
                                    <th>Avatar</th>
                                    <th>#ID</th>
                                    <th>Nome</th>
                                    <th>Preço</th>
                                    <th>Estoque</th>
                                    <th>Estoque Mínimo</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($produtos)
                                    @foreach ($produtos as $prod)
                                        <tr id="produto-{{ $prod->id }}" <?= $prod->estoque <= $prod->estoque_min ? 'class="alert-danger"' : '' ?>>
                                            <td>
                                                <img class="rounded-circle header-profile-user"
                                                    src="{{ asset("$prod->img") }}">
                                            </td>
                                            <td data-sort="{{ $prod->id }}">#{{ $prod->id }}</td>
                                            <td>{{ $prod->nome }}</td>
                                            <td data-sort="{{ number_format($prod->preco, 2, '.', '') }}">R$ {{ number_format($prod->preco, 2, '.', '') }}</td>
                                            <td data-sort="{{ $prod->estoque }}">
                                                <?= $prod->estoque <= $prod->estoque_min ? '<i class="fa fa-exclamation-triangle" title="Produto com estoque baixo"></i> ' : '' ?>
                                                {{ $prod->estoque }}
                                            </td>
                                            <td data-sort="{{ $prod->estoque_min }}">{{ $prod->estoque_min }}</td>
                                            <td>
                                                <a href="{{ route('produto.edit', $prod->id) }}"
                                                    class="btn btn-primary btn-sm btn-rounded text-white">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                &nbsp;
                                                <a onclick="removeProduto({{ $prod }}, '{{ csrf_token() }}')"
                                                    class="btn btn-danger btn-sm btn-rounded text-white"
                                                    style="cursor: pointer;">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endSection
@section('app-js')
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/produtos/index.js') }}"></script>
    <script>
        $(document).ready(function() {
            var a = $("#datatable-buttons").DataTable({
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'Tudo'],
                ],
                order: [
                    [1, 'desc']
                ],
                buttons: [{
                        extend: 'print',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5]
                        },
                        pageSize: 'A4'
                    },
                ],
                destroy: true,
                language: datatable_ptBr,
                drawCallback: function() {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
                },
            }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");
        });
    </script>
    @if (Session::has('success'))
        :
        <script>
            msgSuccess("{{ Session::get('success') }}");
        </script>
    @endif;
    @if (Session::has('err'))
        :
        <script>
            msgError("{{ Session::get('err') }}");
        </script>
    @endif;
@endSection
