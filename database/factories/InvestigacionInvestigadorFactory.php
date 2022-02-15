<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvestigacionInvestigador>
 */
class InvestigacionInvestigadorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'es_responsable' => $this->faker->boolean(75),
            'investigacion_id' => $this->faker->numberBetween(1, 30),
            'investigador_id' => $this->faker->numberBetween(1, 50)
        ];
    }
}
