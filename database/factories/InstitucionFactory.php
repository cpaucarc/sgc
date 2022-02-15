<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Institucion>
 */
class InstitucionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $esUniv = $this->faker->boolean(85); //85%=[1] Universidad, 15%=[2] Instituto

        return [
            'nombre' => $this->faker->company,
            'tipo_institucion_id' => $esUniv ? 1 : 2,
        ];
    }
}
