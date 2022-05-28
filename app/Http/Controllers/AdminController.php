<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\Produto;
use App\Models\Usuario;

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
            'ultimas_vendas' => '', 
        ];
        return view('dashboard', $data);
    }
}
