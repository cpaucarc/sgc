<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ResponsabilidadSocial>
 */
class ResponsabilidadSocialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $enEmpresa = $this->faker->boolean(45);

        return [
            'titulo' => $this->faker->sentence(10),
            'descripcion' => $this->faker->paragraph(),
            'lugar' => $this->faker->city . ' - ' . $this->faker->state,
            'fecha_inicio' => $this->faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
            'fecha_fin' => $this->faker->dateTimeBetween($startDate = '+1 months', $endDate = '+7 months'),
            'semestre_id' => $this->faker->numberBetween(1, 3),
            'escuela_id' => $this->faker->numberBetween(1, 2),
            'empresa_id' => $enEmpresa ? $this->faker->numberBetween(1, 50) : null,
        ];
    }
}
