<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EscuelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $escuelas = [
            [
                'nombre' => 'Enfermeria',
                'abrev' => 'ENF',
                'facultad_id' => 1,
            ],
            [
                'nombre' => 'Obstetricia',
                'abrev' => 'OBS',
                'facultad_id' => 1,
            ],
        ];

        \App\Models\Escuela::insert($escuelas);
    }
}
