<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GradoEstudiante>
 */
class GradoEstudianteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $created_at = $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now');

        return [
            'codigo_estudiante' => $this->faker->unique(true)->numerify('###.####.###'),
            'grado_academico_id' => rand(1, 7),
            'created_at' => $created_at,
            'updated_at' => $created_at,
            'escuela_id' => rand(10, 11),
        ];
    }
}
