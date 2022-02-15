<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineaInvestigacionSeeder extends Seeder
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
                'nombre' => 'Salud pública y prevención de enfermedades endémicas',
                'area_id' => 1
            ],
        ];

        \App\Models\LineaInvestigacion::insert($lineas);
    }
}
