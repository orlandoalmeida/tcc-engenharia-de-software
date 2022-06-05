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
                        <h4 class="mb-0 font-size-18">Listar Vendas</h4>
                    </div>
                    <div class="">
                        <a href="{{ route('venda.create') }}" class="btn btn-primary pull-right"><i
                                class="fa fa-plus-circle"></i> Nova Venda</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Vendas</h4>
                        <table id="datatable-buttons" class="table table-stripeds">
                            <thead class="thead-light">
                                <tr>
                                    <th>#ID</th>
                                    <th>Cliente</th>
                                    <th>Produto</th>
                                    <th>Valor unitário</th>
                                    <th>Quantidade</th>
                                    <th>Valor total</th>
                                    <th>Forma de pagamento</th>
                                    <th>Data da venda</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($vendas)
                                    @foreach ($vendas as $prod)
                                        <tr id="venda-{{ $prod->id }}">
                                            <td data-sort="{{ $prod->id }}">#{{ $prod->id }}</td>
                                            <td>{{ $prod->cliente }}</td>
                                            <td>{{ $prod->produto }}</td>
                                            <td data-sort="{{ number_format($prod->valor_unitario, 2, '.', '') }}">R$
                                                {{ number_format($prod->valor_unitario, 2, '.', '') }}</td>
                                            <td data-sort="{{ $prod->quantidade }}">{{ $prod->quantidade }}</td>
                                            <td data-sort="{{ number_format($prod->valor_total, 2, '.', '') }}">R$
                                                {{ number_format($prod->valor_total, 2, '.', '') }}</td>
                                            <td>
                                                @switch($prod->forma_pagamento)
                                                    @case(1)
                                                        Cartão de Crédito
                                                    @break

                                                    @case(2)
                                                        Cartão de Débito
                                                    @break

                                                    @case(3)
                                                        Pix
                                                    @break

                                                    @case(4)
                                                        Dinheiro
                                                    @break

                                                    @case(5)
                                                        Boleto
                                                    @break

                                                    @case(6)
                                                        Cheque
                                                    @break

                                                    @default
                                                @endswitch
                                            </td>
                                            <td>
                                                {{ date('d/m/Y H:i', strtotime($prod->data)) }}
                                            </td>
                                            <td>
                                                <a onclick="removeVenda({{ $prod }}, '{{ csrf_token() }}')"
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
    <script src="{{ asset('js/vendas/index.js') }}"></script>
    <script>
        $(document).ready(function() {
            var a = $("#datatable-buttons").DataTable({
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'Tudo'],
                ],
                order: [
                    [0, 'desc']
                ],
                buttons: [{
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
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
