<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // tipo 1 = pagar 
        // tipo 2 = receber
        $contas = [
            [
                'nome' => 'Conta de luz',
                'valor' => 350.00,
                'data' => date('Y-m-d', strtotime('2022-06-30')),
                'tipo' => 1,
            ],
            [
                'nome' => 'Conta de água',
                'valor' => 90.00,
                'data' => date('Y-m-d', strtotime('2022-06-30')),
                'tipo' => 1,
            ],
            [
                'nome' => 'Internet',
                'valor' => 200.00,
                'data' => date('Y-m-d', strtotime('2022-07-20')),
                'tipo' => 1,
            ],
            [
                'nome' => 'Fornecedor',
                'valor' => 4750.73,
                'data' => date('Y-m-d', strtotime('2022-08-30')),
                'tipo' => 1,
            ],
            [
                'nome' => 'Pagamento de promissória',
                'valor' => 200.00,
                'data' => date('Y-m-d', strtotime('2022-07-30')),
                'tipo' => 2,
            ],
            [
                'nome' => 'Recebimento de cliente',
                'valor' => 750.29,
                'data' => date('Y-m-d', strtotime('2022-07-30')),
                'tipo' => 2,
            ],
        ];
        DB::table('contas')->insert($contas);
    }
}
