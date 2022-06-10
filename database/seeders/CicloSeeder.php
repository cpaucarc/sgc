<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CicloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ciclo = [
            [
                'romano' => 'I',
            ],
            [
                'romano' => 'II',
            ],
            [
                'romano' => 'III',
            ],
            [
                'romano' => 'IV',
            ],
            [
                'romano' => 'V',
            ],
            [
                'romano' => 'VI',
            ],
            [
                'romano' => 'VII',
            ],
            [
                'romano' => 'VIII',
            ],
            [
                'romano' => 'IX',
            ],
            [
                'romano' => 'X',
            ],
        ];

        \App\Models\Ciclo::insert($ciclo);
    }
}
