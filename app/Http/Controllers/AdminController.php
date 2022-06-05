<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Conta;
use App\Models\Funcionario;
use App\Models\Produto;
use App\Models\Usuario;
use App\Models\Venda;

class AdminController extends Controller
{
    public function dashboard(){
        
        $data = [
            'title' => 'Home',
            'total_usuarios' => (new Usuario)->count(),
            'total_funcionarios' => (new Funcionario)->count(),
            'total_clientes' => (new Cliente)->count(),
            'total_produtos' => (new Produto)->countAtivos(),
            'produtos_estoque_baixo' => (new Produto)->listaEstoqueBaixo(),
            'ultimas_contas' => (new Conta)->listaUltimas(5),
            'ultimas_vendas' => (new Venda)->listaUltimas(5), 
        ];
        return view('dashboard', $data);
    }
}
