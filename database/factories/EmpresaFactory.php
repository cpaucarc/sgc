<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empresa>
 */
class EmpresaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->company,
            'ruc' => $this->faker->numberBetween(20000000000, 29999999999),
            'telefono' => $this->faker->numberBetween(900000000, 999999999),
            'correo' => $this->faker->companyEmail,
            'direccion' => $this->faker->streetAddress,
            'ubicacion' => $this->faker->city . ' - ' . $this->faker->state,
            'user_id' => $this->faker->numberBetween(2, 7),
        ];
    }
}
