<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente = (new Cliente)->lazy()->all();
        $data = [
            'title' => 'Clientes',
            'clientes' => $cliente
        ];
        return view('clientes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Novo Cliente',
        ];
        return view('clientes.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|max:255',
            'telefone' => 'required',
            'email' => 'required|email|unique:clientes,email',
        ]);
        if ($validated) {
            $cliente = new Cliente();
            if (isset($request->foto_perfil)) {
                $cliente->foto_perfil = $request->file('foto_perfil')->store('avatars');
            } else {
                $cliente->foto_perfil = 'avatars/no-avatar.png';
            }
            $cliente->nome = $request->nome;
            $cliente->email = $request->email;
            $cliente->telefone = $request->telefone;
            $cliente->cpf = $request->cpf;
            $cliente->rg = $request->rg;
            $cliente->sexo = $request->sexo;
            $cliente->cep = $request->cep;
            $cliente->uf = $request->uf;
            $cliente->cidade = $request->cidade;
            $cliente->endereco = $request->endereco;
            $cliente->bairro = $request->bairro;
            $cliente->complemento = $request->complemento;
            $cliente->numero = $request->numero;
            $cliente->obs = $request->obs;
            $cliente->save();
            Session::flash('success', 'Cliente cadastrado com sucesso!');
            return redirect()->route('cliente.index');
        } else {
            return redirect()->route('cliente.create');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        if (isset($cliente->id)) {
            $data = [
                'cliente' => $cliente,
                'title' => 'Editar Cliente ' . $cliente->nome,
            ];
            return view('clientes.edit', $data);
        } else {
            Session::flash('err', 'Cliente não encontrado!');
            return redirect()->route('cliente.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClienteRequest  $request
     * @param  \App\Models\Cliente  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (isset($id) && intval($id) > 0) {
            $validated = $request->validate([
                'nome' => 'required|max:255',
                'telefone' => 'required',
                'email' => "required|email|unique:clientes,email,$id",
            ]);
            if ($validated) {
                $cliente = Cliente::find($id);
                if (isset($request->foto_perfil)) {
                    $cliente->foto_perfil = $request->file('foto_perfil')->store('avatars');
                }
                $cliente->nome = $request->nome;
                $cliente->email = $request->email;
                $cliente->telefone = $request->telefone;
                $cliente->cpf = $request->cpf;
                $cliente->rg = $request->rg;
                $cliente->sexo = $request->sexo;
                $cliente->cep = $request->cep;
                $cliente->uf = $request->uf;
                $cliente->cidade = $request->cidade;
                $cliente->endereco = $request->endereco;
                $cliente->bairro = $request->bairro;
                $cliente->complemento = $request->complemento;
                $cliente->numero = $request->numero;
                $cliente->obs = $request->obs;
                $cliente->save();
                Session::flash('success', 'Cliente alterado com sucesso!');
                return redirect()->route('cliente.index');
            }else{
                return redirect()->route('cliente.edit', $id);
            }
        } else {
            Session::flash('err', 'Cliente não encontrado!');
            return redirect()->route('usuario.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cliente::find($id)->delete($id);
    }

    public function seed(){
        Cliente::factory()->count(50)->create();
        return redirect()->route('dash', 'debug');
    }
}
