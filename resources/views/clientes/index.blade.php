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
                        <h4 class="mb-0 font-size-18">Lista de Clientes</h4>
                    </div>
                    <div class="">
                        <a href="{{ route('cliente.create') }}" class="btn btn-primary pull-right"><i
                                class="fa fa-plus-circle"></i> Novo Cliente</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Clientes</h4>
                        <table id="datatable-buttons" class="table table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>Avatar</th>
                                    <th>#ID</th>
                                    <th>Nome</th>
                                    <th width="80">Telefone</th>
                                    <th>Email</th>
                                    <th width="80">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($clientes)
                                    @foreach ($clientes as $user)
                                        <tr id="cliente-{{ $user->id }}">
                                            <td>
                                                <img class="rounded-circle header-profile-user"
                                                    src="{{ asset("$user->foto_perfil") }}">
                                            </td>
                                            <td data-sort="{{$user->id}}">#{{ $user->id }}</td>
                                            <td>{{ $user->nome }}</td>
                                            <td>{{ $user->telefone }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="{{ route('cliente.edit', $user->id) }}"
                                                    class="btn btn-primary btn-sm btn-rounded text-white">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                &nbsp;
                                                <a onclick="removeUsuario({{ $user }}, '{{ csrf_token() }}')"
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
    <script src="{{ asset('js/clientes/index.js') }}"></script>
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
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [1, 2, 2, 4]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [1, 2, 2, 4]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [1, 2, 2, 4]
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
