<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Venda;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendas = (new Venda)->all();
        $data = [
            'title' => 'Vendas',
            'vendas' => $vendas
        ];
        return view('vendas.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produtos = (new Produto)->getForVendas();
        $clientes = (new Cliente)->all();
        $data = [
            'produtos' => $produtos,
            'clientes' => $clientes,
            'title' => 'Nova Venda',
        ];
        return view('vendas.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVendaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'quantidade' => 'required',
            'produto' => 'required',
            'cliente' => 'required',
        ]);
        if ($validated) {
            $venda = new Venda();
            if (isset($request->valor_unitario) && !empty($request->valor_unitario)) {
                $venda->valor_unitario = number_format(str_replace(',', '.', ($request->valor_unitario)), 2, '.', '');
            } else {
                $venda->valor_unitario = null;
            }
            if (isset($request->valor_total) && !empty($request->valor_total)) {
                $venda->valor_total = number_format(str_replace(',', '.', ($request->valor_total)), 2, '.', '');
            } else {
                $venda->valor_total = null;
            }
            $venda->cliente = $request->cliente;
            $venda->produto = $request->produto;
            $venda->quantidade = $request->quantidade;
            $venda->forma_pagamento = $request->forma_pagamento;
            $venda->data = date('Y-m-d H:i:s');
            $venda->save();
            $produto = new ProdutoController;
            $produto->descontaEstoque($request->produto_id, $request->quantidade);
            Session::flash('success', 'Venda efetuada com sucesso!');
            return redirect()->route('venda.index');
        } else {
            return redirect()->route('venda.create');
        }
    }

    public function relatorio()
    {
        $produtos = (new Produto)->getForVendas();
        $clientes = (new Cliente)->all();
        $data = [
            'produtos' => $produtos,
            'clientes' => $clientes,
            'title' => 'Relatório de Vendas',
        ];
        return view('vendas.relatorio', $data);
    }

    public function buscaRelatorio()
    {
        if (isset($_POST['dt_inicial']) && !empty($_POST['dt_inicial'])) {
            $de = explode('/', $_POST['dt_inicial']);
            $de = $de[2] . '-' . $de[1] . '-' . $de[0];
        } else {
            $de = date('Y-m-d');
        }
        if (isset($_POST['dt_final']) && !empty($_POST['dt_final'])) {
            $ate = explode('/', $_POST['dt_final']);
            $ate = $ate[2] . '-' . $ate[1] . '-' . $ate[0];
        } else {
            $ate = date('Y-m-d');
        }
        $where = " vendas.data BETWEEN STR_TO_DATE('" . $de . " 00:00:01', '%Y-%m-%d %H:%i:%s') AND STR_TO_DATE('" . $ate . " 23:59:59', '%Y-%m-%d %H:%i:%s')";
        $result = (new Venda)->getRelatorio($where);
        echo json_encode($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id > 0) {
            Venda::find($id)->delete($id);
        }
    }
}
