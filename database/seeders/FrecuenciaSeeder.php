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
                'tiempo_semanas' => 4 // 1 mes = 4 semanas
            ],
            [
                'nombre' => 'Semestral',
                'tiempo_semanas' => 16 // 1 mes = 4 semanas -> 4 meses = 16 semanas
            ],
            [
                'nombre' => 'Semanal',
                'tiempo_semanas' => 1
            ],
        ];

        \App\Models\Frecuencia::insert($frecuencias);
    }
}
