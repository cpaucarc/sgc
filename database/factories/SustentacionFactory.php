<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sustentacion>
 */
class SustentacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fecha_sustentacion' => $this->faker->dateTimeBetween('-6 months', 'now')->format("Y-m-d"),
            'tesis_id' => $this->faker->unique(true)->numberBetween(1, 50),
            'estado_id' => $this->faker->numberBetween(9, 10),
        ];
    }
}
