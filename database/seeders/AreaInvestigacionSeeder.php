<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaInvestigacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = [
            [
                'nombre' => 'Ciencias Médicas y de la Salud',
                'facultad_id' => 8
            ]
        ];

        \App\Models\AreaInvestigacion::insert($areas);
    }
}
