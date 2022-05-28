<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    public function getAtivos(){
        return $this->select('produtos.*')->where('status', '=', 1)->get();
    }

    public function countAtivos()
    {
        $total = $this->selectRaw('COUNT(id) AS total')->where('status', '=', 1)->first();
        return $total->total;
    }

    public function listaEstoqueBaixo()
    {
        return $this->select('produtos.*')->where('status', '=', '1')->whereRaw('produtos.estoque <= produtos.estoque_min')->get();
    }

}
