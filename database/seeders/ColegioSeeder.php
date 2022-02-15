<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColegioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $col = [
            [
                'nombre' => 'Colegio de Enfermeros del Perú'
            ],
            [
                'nombre' => 'Colegio de Obstetras del Perú'
            ],
            [
                'nombre' => 'Colegio Médico del Perú'
            ],
        ];
        \App\Models\Colegio::insert($col);
    }
}
