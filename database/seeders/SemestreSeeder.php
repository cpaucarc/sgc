<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemestreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $semestre = [
            [
                'nombre' => '2020-II',
                'fecha_inicio' => '2020-12-01',
                'fecha_fin' => '2021-05-04',
            ],
            [
                'nombre' => '2021-I',
                'fecha_inicio' => '2021-07-01',
                'fecha_fin' => '2021-12-04',
            ],
            [
                'nombre' => '2021-II',
                'fecha_inicio' => '2022-01-01',
                'fecha_fin' => '2022-05-04',
            ],
        ];

        \App\Models\Semestre::insert($semestre);
    }
}
