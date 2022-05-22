<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;
use App\Models\Funcionario;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funcionario = (new Funcionario)->listaFuncionarios();
        $data = [
            'title' => 'Funcionários',
            'funcionarios' => $funcionario
        ];
        return view('funcionarios.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Novo Funcionário',
            'cargos' => (new Cargo)->all(),
        ];
        return view('funcionarios.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFuncionarioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|max:255',
            'telefone' => 'required',
            'cpf' => 'required|unique:funcionarios,cpf',
            'cep' => 'required',
            'email' => 'required|email|unique:funcionarios,email',
        ]);
        if ($validated) {
            $funcionario = new Funcionario();
            if (isset($request->foto_perfil)) {
                $funcionario->foto_perfil = $request->file('foto_perfil')->store('avatars');
            } else {
                $funcionario->foto_perfil = 'avatars/no-avatar.png';
            }
            $funcionario->nome = $request->nome;
            $funcionario->email = $request->email;
            $funcionario->telefone = $request->telefone;
            $funcionario->cpf = $request->cpf;
            $funcionario->rg = $request->rg;
            $funcionario->cargo = $request->cargo;

            if (isset($request->data_nascimento) && !empty($request->data_nascimento)) {
                $funcionario->data_nascimento = Carbon::createFromFormat('d/m/Y', $request->data_nascimento)->format('Y-m-d');
            } else {
                $funcionario->data_nascimento = null;
            }
            $funcionario->sexo = $request->sexo;
            if (isset($request->salario) && !empty($request->salario)) {
                $funcionario->salario = number_format(str_replace(',', '.', ($request->salario)), 2, '.', '');
            } else {
                $funcionario->salario = null;
            }
            $funcionario->cep = $request->cep;
            $funcionario->uf = $request->uf;
            $funcionario->cidade = $request->cidade;
            $funcionario->endereco = $request->endereco;
            $funcionario->bairro = $request->bairro;
            $funcionario->complemento = $request->complemento;
            $funcionario->numero = $request->numero;
            $funcionario->obs = $request->obs;
            $funcionario->save();
            Session::flash('success', 'Funcionário cadastrado com sucesso!');
            return redirect()->route('funcionario.index');
        } else {
            return redirect()->route('funcionario.create');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $funcionario = Funcionario::find($id);
        if (isset($funcionario->id)) {
            $data = [
                'funcionario' => $funcionario,
                'cargos' => (new Cargo)->all(),
                'title' => 'Editar Funcionário ' . $funcionario->nome,
            ];
            return view('funcionarios.edit', $data);
        } else {
            Session::flash('err', 'Funcionário não encontrado!');
            return redirect()->route('funcionario.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFuncionarioRequest  $request
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (isset($id) && intval($id) > 0) {
            $validated = $request->validate([
                'nome' => 'required|max:255',
                'telefone' => 'required',
                'cpf' => "required|unique:funcionarios,cpf,$id",
                'email' => "required|email|unique:funcionarios,email,$id",
                'cep' => 'required',
            ]);
            if ($validated) {
                $funcionario = Funcionario::find($id);
                if (isset($request->foto_perfil)) {
                    $funcionario->foto_perfil = $request->file('foto_perfil')->store('avatars');
                }
                $funcionario->nome = $request->nome;
                $funcionario->email = $request->email;
                $funcionario->telefone = $request->telefone;
                $funcionario->cpf = $request->cpf;
                $funcionario->rg = $request->rg;
                $funcionario->cargo = $request->cargo;

                if (isset($request->data_nascimento) && !empty($request->data_nascimento)) {
                    $funcionario->data_nascimento = Carbon::createFromFormat('d/m/Y', $request->data_nascimento)->format('Y-m-d');
                } else {
                    $funcionario->data_nascimento = null;
                }
                $funcionario->sexo = $request->sexo;
                if (isset($request->salario) && !empty($request->salario)) {
                    $funcionario->salario = number_format(str_replace(',', '.', ($request->salario)), 2, '.', '');
                } else {
                    $funcionario->salario = null;
                }
                $funcionario->cep = $request->cep;
                $funcionario->uf = $request->uf;
                $funcionario->cidade = $request->cidade;
                $funcionario->endereco = $request->endereco;
                $funcionario->bairro = $request->bairro;
                $funcionario->complemento = $request->complemento;
                $funcionario->numero = $request->numero;
                $funcionario->obs = $request->obs;
                $funcionario->save();
                Session::flash('success', 'Funcionário alterado com sucesso!');
                return redirect()->route('funcionario.index');
            } else {
                return redirect()->route('funcionario.edit', $id);
            }
        } else {
            Session::flash('err', 'Funcionário não encontrado!');
            return redirect()->route('usuario.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Funcionario::find($id)->delete($id);
    }

    public function seed()
    {
        Funcionario::factory()->count(25)->create();
        return redirect()->route('dash', 'debug');
    }
}
