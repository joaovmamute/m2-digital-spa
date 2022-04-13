<?php

namespace Database\Factories;

use App\Models\Campanha;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campanha>
 */
class CampanhaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        for ($i=0; $i < 10 ; $i++) {
            $produtos = Produto::get();

            $rand = random_int(0, $produtos->count());

            $campanha = new Campanha();

            $campanha->nome = $this->faker->name();
            $campanha->desconto = bcdiv(random_int(0, 10000), '10000', 4);
            $campanha->ativa = boolval(rand(0,1));

            $campanha->save();

            if ($rand) {
                $campanha->produtos()->attach($produtos->random($rand)->pluck('id')->toArray());
            }
        }

        return true;
    }
}
