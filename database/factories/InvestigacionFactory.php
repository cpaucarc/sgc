<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Investigacion>
 */
class InvestigacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence(15),
            'uuid' => $this->faker->uuid,
            'resumen' => $this->faker->paragraph() . " " . $this->faker->paragraph(),
            'fecha_publicacion' => ($this->faker->dateTimeBetween('-1 years', 'now'))->format("Y-m-d"),
            'escuela_id' => $this->faker->numberBetween(10, 11),
            'sublinea_id' => $this->faker->numberBetween(1, 7),
            'estado_id' => $this->faker->numberBetween(1, 3)
        ];
    }
}
