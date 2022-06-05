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
                        <h4 class="mb-0 font-size-18">Relatório de Vendas</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="vm">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                <h3 class="text-center">Selecione um intervalo de datas</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 form-group">
                                <label for="dt_inicial">Data Início
                                    <span id="msg_data_inicial" class="text-danger"></span>
                                </label>
                                <input type="text" id="dt_inicial" name="dt_inicial" class="form-control data">
                            </div>
                            <div class="col-lg-4 form-group">
                                <label for="dt_final">Data Fim
                                    <span id="msg_data_final" class="text-danger"></span>
                                </label>
                                <input type="text" id="dt_final" name="dt_final" class="form-control data">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <a class="btn btn-primary text-white" style="cursor: pointer" v-on:click="buscarVendas()">
                                    <i class="fa fa-search"></i> Buscar Vendas no período selecionado
                                </a>
                            </div>
                        </div>
                        <br><br><br>

                        <div id="resultado-busca" class="d-none">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="venda in vendas">
                                        <td data-sort=""># @{{ venda.id }}</td>
                                        <td>@{{ venda.cliente }}</td>
                                        <td>@{{ venda.produto }}</td>
                                        <td :data-sort="venda.valor_unitario">R$ @{{ venda.valor_unitario }}</td>
                                        <td :data-sort="venda.quantidade">@{{ venda.quantidade }}</td>
                                        <td :data-sort="venda.valor_total">R$ @{{ venda.valor_total }}</td>
                                        <td>
                                            <span v-if="venda.forma_pagamento == 1">Cartão de Crédito</span>
                                            <span v-if="venda.forma_pagamento == 2">Cartão de Débito</span>
                                            <span v-if="venda.forma_pagamento == 3">Pix</span>
                                            <span v-if="venda.forma_pagamento == 4">Dinheiro</span>
                                            <span v-if="venda.forma_pagamento == 5">Boleto</span>
                                            <span v-if="venda.forma_pagamento == 6">Cheque</span>
                                        </td>
                                        <td>@{{ venda.data_formatada }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="load-busca" class="d-none">
                            <h1 class="text-center"><i class="fa fa-2x fa-spin fa-spinner"></i>&nbsp; Buscando dados</h1>
                        </div>
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
    <script src="{{ asset('js/vue.min.js') }}"></script>
    <script>
        var vm = new Vue({
            el: '#vm',
            data: {
                vendas: null,
            },
            methods: {
                buscarVendas: function() {
                    $('#load-busca').removeClass('d-none');
                    $('#resultado-busca').addClass('d-none');
                    var self = this;
                    $.ajax({
                        url: '{{ url('') }}/buscaRelatorio',
                        method: 'POST',
                        data: {
                            "_token": '{{ csrf_token() }}',
                            'dt_inicial': $('#dt_inicial').val(),
                            'dt_final': $('#dt_final').val(),
                        },
                        success: function(rs) {
                            self.vendas = JSON.parse(rs);
                            setTimeout(() => {
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
                                                columns: [0, 1, 2, 3, 4, 5, 6,
                                                    7
                                                ]
                                            }
                                        },
                                        {
                                            extend: 'csvHtml5',
                                            exportOptions: {
                                                columns: [0, 1, 2, 3, 4, 5, 6,
                                                    7
                                                ]
                                            }
                                        },
                                        {
                                            extend: 'pdfHtml5',
                                            exportOptions: {
                                                columns: [0, 1, 2, 3, 4, 5, 6,
                                                    7
                                                ]
                                            },
                                            pageSize: 'A4'
                                        },
                                    ],
                                    destroy: true,
                                    retrieve: true,
                                    language: datatable_ptBr,
                                    drawCallback: function() {
                                        $(".dataTables_paginate > .pagination")
                                            .addClass("pagination-rounded");
                                    },
                                }).buttons().container().appendTo(
                                    "#datatable-buttons_wrapper .col-md-6:eq(0)");
                                $('#load-busca').addClass('d-none');
                                $('#resultado-busca').removeClass('d-none');
                                vm.$forceUpdate();
                            }, 500);
                        }
                    });
                },
            },
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.data').mask('99/99/9999', {
                placeholder: "__/__/____"
            });

        });

        $('#dt_inicial').on('focusout', function() {
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
                        $('#msg_data_inicial').hide();
                    } else {
                        $('#msg_data_inicial').text('Data inválida').show();
                        $('#dt_inicial').val('');
                        $('#dt_inicial').focus();
                    }
                } else {
                    $('#msg_data_inicial').text('Data inválida').show();
                    $('#dt_inicial').val('');
                }
            }
        });

        $('#dt_final').on('focusout', function() {
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
                        $('#msg_data_final').hide();
                    } else {
                        $('#msg_data_final').text('Data inválida').show();
                        $('#dt_final').val('');
                        $('#dt_final').focus();
                    }
                } else {
                    $('#msg_data_final').text('Data inválida').show();
                    $('#dt_final').val('');
                }
            }
        });
    </script>
@endSection
