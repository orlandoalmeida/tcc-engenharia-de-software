<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $table = 'vendas';

    public function listaUltimas($limit = 5){
        return $this->selectRaw("vendas.*, DATE_FORMAT(vendas.data, '%d/%m/%Y %H:%i') AS data_formatada")->limit($limit)->orderByDesc('vendas.id')->get();
    }

    public function getRelatorio($where = '')
    {
        return $this->selectRaw("vendas.*, DATE_FORMAT(vendas.data, '%d/%m/%Y %H:%i') AS data_formatada")
        ->whereRaw("$where")
        ->orderByDesc('vendas.data')
        ->get();
    }
}
