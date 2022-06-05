<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class ContaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // tipo 1 = pagar 
        // tipo 2 = receber
        $contas = (new Conta)->get_all();
        $data = [
            'title' => 'Contas a Pagar e Receber',
            'contas' => $contas
        ];
        return view('contas.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Nova Conta',
        ];
        return view('contas.create', $data);
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
            'valor' => 'required',
            'data' => 'required',
            'tipo' => 'required',
        ]);
        if ($validated) {
            $conta = new Conta();
            $conta->nome = $request->nome;
            $conta->tipo = $request->tipo;
            $conta->data = Carbon::createFromFormat('d/m/Y', $request->data)->format('Y-m-d');
            $conta->valor = number_format(str_replace(',', '.', ($request->valor)), 2, '.', '');
            $conta->save();
            Session::flash('success', 'Conta cadastrada com sucesso!');
            return redirect()->route('conta.index');
        } else {
            return redirect()->route('conta.create');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conta = Conta::find($id);
        if (isset($conta->id)) {
            $data = [
                'conta' => $conta,
                'title' => 'Editar Conta ' . $conta->nome,
            ];
            return view('contas.edit', $data);
        } else {
            Session::flash('err', 'Conta não encontrado!');
            return redirect()->route('conta.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (isset($id) && intval($id) > 0) {
            $validated = $request->validate([
                'nome' => 'required|max:255',
                'valor' => 'required',
                'data' => 'required',
                'tipo' => 'required',
            ]);
            if ($validated) {
                $conta = Conta::find($id);
                $conta->nome = $request->nome;
                $conta->tipo = $request->tipo;
                $conta->data = Carbon::createFromFormat('d/m/Y', $request->data)->format('Y-m-d');
                $conta->valor = number_format(str_replace(',', '.', ($request->valor)), 2, '.', '');
                $conta->save();
                Session::flash('success', 'Conta alterada com sucesso!');
                return redirect()->route('conta.index');
            }else{
                return redirect()->route('conta.edit', $id);
            }
        } else {
            Session::flash('err', 'Conta não encontrado!');
            return redirect()->route('conta.index');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Conta::find($id)->delete($id);
    }
}
