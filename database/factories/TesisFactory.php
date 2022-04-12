<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tesis>
 */
class TesisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'numero_registro' => $this->faker->unique(true)->numerify('T-######'),
            'titulo' => $this->faker->paragraph(),
            'anio' => $this->faker->numberBetween(2015, 2022),
            'codigo_estudiante' => $this->faker->unique(true)->numerify('###.####.###'),
            'escuela_id' => rand(10, 11),
            'asesor_id' => rand(1, 25),
            'tipo_tesis_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
