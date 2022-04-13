<?php

namespace Database\Factories;

use App\Models\GradoEstudiante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Solicitud>
 */
class SolicitudFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
//            'dni_estudiante' => $this->faker->unique(true)->numerify('########'),
            'dni_estudiante' => GradoEstudiante::inRandomOrder()->first()->dni_estudiante,
            'tipo_solicitud_id' => rand(1, 3),
            'estado_id' => rand(1, 10),
        ];
    }
}
