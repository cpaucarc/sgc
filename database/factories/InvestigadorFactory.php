<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Investigador>
 */
class InvestigadorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $esDocente = $this->faker->boolean(65); //65% probab. de ser docente | 35% estudiante

        return [
            'es_docente' => $esDocente,
            'codigo_investigador' => $this->faker->unique(true)->numerify('###.####.###'),
        ];
    }
}
