<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JuradoSustentacion>
 */
class JuradoSustentacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nota_jurado' => rand(12, 20),
            'jurado_id' => $this->faker->numberBetween(1, 25),
            'sustentacion_id' => $this->faker->numberBetween(1, 30),
            'cargo_jurado_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
