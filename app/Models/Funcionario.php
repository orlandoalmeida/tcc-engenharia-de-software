<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Funcionario extends Model
{
    protected $table = 'funcionarios';
    use HasFactory;

    public function listaFuncionarios()
    {
        return $this->select('funcionarios.*', 'cargos.nome AS cargo_nome')->join('cargos', 'cargos.id', '=', 'funcionarios.cargo')->get();
    }
}
