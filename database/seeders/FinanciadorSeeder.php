<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinanciadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $financiador = [
            [
                'nombre' => 'Recursos Ordinarios',
            ],
            [
                'nombre' => 'Recursos Determinados Canon, SobreCanon y Regalias',
            ],
            [
                'nombre' => 'FONDECYT',
            ],
            [
                'nombre' => 'Otro',
            ],
        ];

        \App\Models\Financiador::insert($financiador);
    }
}
