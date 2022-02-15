<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SublineaInvestigacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lineas = [
            [
                'nombre' => 'Cuidados de enfermería en salud familiar y mental',
                'linea_id' => 1
            ],
            [
                'nombre' => 'Cuidados de enfermería de las afecciones transmisibles y no transmisibles',
                'linea_id' => 1
            ],
            [
                'nombre' => 'Gestión y desempeño de enfermería',
                'linea_id' => 1
            ],
            [
                'nombre' => 'Estudio del Binomio Madre - Niño en sus diversos aspectos',
                'linea_id' => 1
            ],
            [
                'nombre' => 'Salud sexual, reproductiva, y emergencias obstétricas',
                'linea_id' => 1
            ],
            [
                'nombre' => 'Estudio de la medicina tradicional alternativa y complementaria, y de salud familiar y comunitaria',
                'linea_id' => 1
            ],
            [
                'nombre' => 'Salud pública, y sistemas de servicio de salud',
                'linea_id' => 1
            ],
        ];

        \App\Models\SublineaInvestigacion::insert($lineas);
    }
}
