<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;

    protected $table = 'contas';

    public function get_all(){
        return $this->selectRaw("contas.*, DATE_FORMAT(contas.data, '%d/%m/%Y') AS data_formatada")->get();
    }

    public function listaUltimas($limit = 5){
        return $this->selectRaw("contas.*, DATE_FORMAT(contas.data, '%d/%m/%Y') AS data_formatada")->limit($limit)->orderByDesc('contas.id')->get();
    }
}
