<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(){
        $data = [
            'title' => 'Home',
            'total_usuarios' => (new Usuario)->count(),
            'total_funcionarios' => (new Funcionario)->count(),
            'total_clientes' => (new Cliente)->count(),
        ];
        return view('dashboard', $data);
    }
}
