<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EstudianteExterno>
 */
class EstudianteExternoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombres' => $this->faker->firstName . ' ' . $this->faker->firstName,
            'apellidos' => $this->faker->lastName . ' ' . $this->faker->lastName,
            'correo' => $this->faker->unique()->safeEmail(),
            'codigo' => $this->faker->unique(true)->numerify('###.####.###'),
            'institucion_id' => rand(1, 25)
        ];
    }
}
