<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RsuParticipante>
 */
class RsuParticipanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $esResponsable = $this->faker->boolean(10);
        $esEstudiante = $this->faker->boolean(60);

        return [
            'fecha_incorporacion' => $this->faker->dateTimeBetween('-6 months', 'now')->format("Y-m-d"),
            'es_responsable' => $esResponsable,
            'es_estudiante' => $esEstudiante,
            'codigo_participante' => $this->faker->unique(true)->numerify('###.####.###'),
            'responsabilidad_social_id' => rand(1, 50)
        ];
    }
}
