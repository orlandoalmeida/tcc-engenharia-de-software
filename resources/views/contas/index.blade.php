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
                        <h4 class="mb-0 font-size-18">Lista de Contas a Pagar e Receber</h4>
                    </div>
                    <div class="">
                        <a href="{{ route('conta.create') }}" class="btn btn-primary pull-right"><i
                                class="fa fa-plus-circle"></i> Novo Conta</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Contas a Pagar e Receber</h4>
                        <table id="datatable-buttons" class="table table-stripeds">
                            <thead class="thead-light">
                                <tr>
                                    <th>#ID</th>
                                    <th>Identificação</th>
                                    <th>Valor a pagar ou receber</th>
                                    <th>Data</th>
                                    <th>Tipo</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($contas)
                                {{--  tipo 1 = pagar  tipo 2 = receber --}}
                                    @foreach ($contas as $conta)
                                        <tr id="conta-{{ $conta->id }}" <?= $conta->tipo == 1 ? 'class="alert-danger"' : 'class="alert-success"' ?>>
                                            <td data-sort="{{ $conta->id }}">#{{ $conta->id }}</td>
                                            <td>{{ $conta->nome }}</td>
                                            <td data-sort="{{ number_format($conta->valor, 2, '.', '') }}">R$ {{ number_format($conta->valor, 2, '.', '') }}</td>
                                            <td data-sort="{{$conta->data}}">
                                                {{$conta->data_formatada}}
                                            </td>
                                            <td data-sort="{{ $conta->tipo }}">
                                                <?= $conta->tipo == 1 ? 'A Pagar' : 'Receber' ?> &nbsp; <i <?= $conta->tipo == 1 ? 'class="fa fa-arrow-down"' : 'class="fa fa-arrow-up"' ?>></i><i class="fa fa-money"></i>
                                            </td>
                                            <td>
                                                <a href="{{ route('conta.edit', $conta->id) }}"
                                                    class="btn btn-primary btn-sm btn-rounded text-white">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                &nbsp;
                                                <a onclick="removeConta({{ $conta }}, '{{ csrf_token() }}')"
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
    <script src="{{ asset('js/contas/index.js') }}"></script>
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
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
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
