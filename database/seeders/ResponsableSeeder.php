<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResponsableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $responsables = [
            [
                'actividad_id' => 1,
                'oficina_id' => 1
            ],
            [
                'actividad_id' => 2,
                'oficina_id' => 4
            ],
            [
                'actividad_id' => 3,
                'oficina_id' => 1
            ],
            [
                'actividad_id' => 4,
                'oficina_id' => 4
            ],
            [
                'actividad_id' => 5,
                'oficina_id' => 4
            ],
            [
                'actividad_id' => 6,
                'oficina_id' => 4
            ],
            [
                'actividad_id' => 7,
                'oficina_id' => 1
            ],
            [
                'actividad_id' => 7,
                'oficina_id' => 2
            ],
            [
                'actividad_id' => 8,
                'oficina_id' => 1
            ],
            [
                'actividad_id' => 8,
                'oficina_id' => 4
            ],
            [
                'actividad_id' => 9,
                'oficina_id' => 1
            ],
            [
                'actividad_id' => 10,
                'oficina_id' => 1
            ],
            [
                'actividad_id' => 11,
                'oficina_id' => 1
            ],
        ];

        \App\Models\Responsable::insert($responsables);
    }
}
