<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome' => 'produto-'.rand(),
            'url' => $this->faker->unique()->slug,
            'estoque' => rand(3, 50),
            'estoque_min' => rand(1, 15),
            'preco' => $this->faker->randomFloat(2, 50, 1500),
            'descricao' => $this->faker->paragraph($nb =2),
            'img' => 'produtos/no-product.png',
        ];
    }
}
