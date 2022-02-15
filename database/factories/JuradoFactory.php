<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jurado>
 */
class JuradoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo_colegiatura' => $this->faker->unique(true)->numerify('######'),
            'codigo_docente' => $this->faker->unique(true)->numerify('###.####.###'),
            'colegio_id' => rand(1, 3),
        ];
    }
}
