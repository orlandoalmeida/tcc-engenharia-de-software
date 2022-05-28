<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = (new Produto)->getAtivos();
        $data = [
            'title' => 'Produtos',
            'produtos' => $produtos
        ];
        return view('produtos.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Novo Produto',
        ];
        return view('produtos.create', $data);
    }


      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|max:255',
            'preco' => 'required',
            'estoque' => 'required',
            'estoque_min' => 'required',
        ]);
        if ($validated) {
            $produto = new Produto();
            if (isset($request->img)) {
                $produto->img = $request->file('img')->store('produtos');
            } else {
                $produto->img = 'produtos/no-product.png';
            }
            $produto->nome = $request->nome;
            if (isset($request->preco) && !empty($request->preco)) {
                $produto->preco = number_format(str_replace(',', '.', ($request->preco)), 2, '.', '');
            } else {
                $produto->preco = null;
            }
            $produto->estoque = $request->estoque;
            $produto->estoque_min = $request->estoque_min;
            $produto->descricao = $request->descricao;
            $produto->save();
            Session::flash('success', 'Produto cadastrado com sucesso!');
            return redirect()->route('produto.index');
        } else {
            return redirect()->route('produto.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = Produto::find($id);
        if (isset($produto->id)) {
            $data = [
                'produto' => $produto,
                'title' => 'Editar Produto ' . $produto->nome,
            ];
            return view('produtos.edit', $data);
        } else {
            Session::flash('err', 'Produto não encontrado!');
            return redirect()->route('produto.index');
        }
    }


    public function update(Request $request, $id)
    {
        if (isset($id) && intval($id) > 0) {
            $validated = $request->validate([
                'nome' => 'required|max:255',
                'preco' => 'required',
                'estoque' => 'required',
                'estoque_min' => 'required',
            ]);
            if ($validated) {
                $produto = Produto::find($id);
                if (isset($request->img)) {
                    $produto->img = $request->file('img')->store('produtos');
                }
                $produto->nome = $request->nome;
                if (isset($request->preco) && !empty($request->preco)) {
                    $produto->preco = number_format(str_replace(',', '.', ($request->preco)), 2, '.', '');
                } else {
                    $produto->preco = null;
                }
                $produto->estoque = $request->estoque;
                $produto->estoque_min = $request->estoque_min;
                $produto->descricao = $request->descricao;
                $produto->save();
                Session::flash('success', 'Produto alterado com sucesso!');
                return redirect()->route('produto.index');
            }else{
                return redirect()->route('produto.edit', $id);
            }
        } else {
            Session::flash('err', 'Produto não encontrado!');
            return redirect()->route('produto.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id > 0){
            $produto = Produto::find($id);
            $produto->status = 0;
            $produto->save();
        }
    }

    public function seed()
    {
        Produto::factory()->count(10)->create();
        return redirect()->route('dash', 'debug');
    }
}
