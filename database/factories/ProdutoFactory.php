<?php

namespace Database\Factories;

use App\Models\Campanha;
use App\Models\Produto;
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
        for ($i=0; $i < 100 ; $i++) {
            $campanhas = Campanha::get();

            $rand = random_int(0, $campanhas->count());

            $produto = new Produto();

            $produto->nome = $this->faker->name();
            $produto->preco = bcdiv(random_int(0, 100000), '100', 2);

            $produto->save();

            if ($rand) {
                $produto->campanhas()->attach($campanhas->random($rand)->pluck('id')->toArray());
            }
        }

        return true;
    }
}
