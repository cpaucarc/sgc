<?php

namespace Database\Factories;

use App\Models\Escuela;
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
            'uuid' => $this->faker->uuid,
            'dni_estudiante' => GradoEstudiante::inRandomOrder()->first()->dni_estudiante,
            'escuela_id'=>Escuela::inRandomOrder()->first()->id,
            'tipo_solicitud_id' => rand(1, 3),
            'estado_id' => rand(1, 10),
        ];
    }
}
