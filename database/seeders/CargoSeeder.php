<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cargos = [
            ['nome' => 'Administrativo'],
            ['nome' => 'Gerente de vendas'],
            ['nome' => 'Vendedor'],
            ['nome' => 'Estoquista'],
            ['nome' => 'Gerente geral'],
            ['nome' => 'Financeiro'],
            ['nome' => 'Gerente de compras'],
            ['nome' => 'Auxiliar de compras'],
            ['nome' => 'Diretor']
        ];
        DB::table('cargos')->insert($cargos);
    }
}
