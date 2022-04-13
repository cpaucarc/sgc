<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConvalidacionPostulante>
 */
class ConvalidacionPostulanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $esInterno = $this->faker->boolean(65);
        return [
            'es_estudiante_interno' => $esInterno,
            'dni_estudiante' => $esInterno ? $this->faker->unique(true)->numerify('########') : null,
            'convalidacion_id' => rand(1, 6),
            'estudiante_externo_id' => $esInterno ? null : rand(1, 50),
            'estado_id' => rand(7,8)
        ];
    }
}
