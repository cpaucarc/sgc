<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FrecuenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $frecuencias = [
            [
                'nombre' => 'Mensual',
                'tiempo_meses' => 1
            ],
            [
                'nombre' => 'Semestral',
                'tiempo_meses' => 6
            ],
        ];

        \App\Models\Frecuencia::insert($frecuencias);
    }
}
