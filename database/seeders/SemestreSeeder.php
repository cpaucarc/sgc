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
                'nombre' => '2020-2',
                'fecha_inicio' => '2021-02-08',
                'fecha_fin' => '2021-06-04',
                'activo' => false
            ],
            [
                'nombre' => '2021-1',
                'fecha_inicio' => '2021-07-05',
                'fecha_fin' => '2021-10-29',
                'activo' => false
            ],
            [
                'nombre' => '2021-2',
                'fecha_inicio' => '2022-01-31',
                'fecha_fin' => '2022-05-27',
                'activo' => true
            ],
        ];

        \App\Models\Semestre::insert($semestre);
    }
}
