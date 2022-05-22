<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Funcionario>
 */
class FuncionarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'cpf' => $this->faker->cpf(),
            'rg' => $this->faker->rg(),
            'telefone' => sprintf('(%s) %s', $this->faker->areaCode(), $this->faker->landline()),
            'sexo' => rand(1, 2),
            'data_nascimento' => $this->faker->dateTimeBetween('1990-01-01', '2012-12-31'),
            'cep' => $this->faker->postcode(),
            'cargo' => rand(1, 9),
            'endereco' => $this->faker->address(),
            'cidade' => $this->faker->city(),
            'numero' => rand(1, 777),
            'uf' => $this->faker->state(),
            'bairro' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'foto_perfil' => 'avatars/no-avatar.png',
            'salario' => $this->faker->randomFloat(2, 12, 150000),
        ];
    }
}
