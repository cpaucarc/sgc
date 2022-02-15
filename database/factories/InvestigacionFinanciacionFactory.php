<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvestigacionFinanciacion>
 */
class InvestigacionFinanciacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'presupuesto' => $this->faker->randomFloat(2, 1000, 10000),
            'investigacion_id' => $this->faker->numberBetween(1, 30),
            'financiador_id' => $this->faker->numberBetween(1, 4)
        ];
    }
}
