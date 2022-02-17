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
                'entidad_id' => 1
            ],
            [
                'actividad_id' => 1,
                'entidad_id' => 2
            ],
            [
                'actividad_id' => 2,
                'entidad_id' => 6
            ],
            [
                'actividad_id' => 2,
                'entidad_id' => 7
            ],
            [
                'actividad_id' => 3,
                'entidad_id' => 1
            ],
            [
                'actividad_id' => 3,
                'entidad_id' => 2
            ],
            [
                'actividad_id' => 4,
                'entidad_id' => 6
            ],
            [
                'actividad_id' => 4,
                'entidad_id' => 7
            ],
            [
                'actividad_id' => 5,
                'entidad_id' => 6
            ],
            [
                'actividad_id' => 5,
                'entidad_id' => 7
            ],
            [
                'actividad_id' => 6,
                'entidad_id' => 6
            ],
            [
                'actividad_id' => 6,
                'entidad_id' => 7
            ],
            [
                'actividad_id' => 7,
                'entidad_id' => 1
            ],
            [
                'actividad_id' => 7,
                'entidad_id' => 2
            ],
            [
                'actividad_id' => 7,
                'entidad_id' => 3
            ],
            [
                'actividad_id' => 7,
                'entidad_id' => 4
            ],
            [
                'actividad_id' => 8,
                'entidad_id' => 1
            ],
            [
                'actividad_id' => 8,
                'entidad_id' => 2
            ],
            [
                'actividad_id' => 8,
                'entidad_id' => 6
            ],
            [
                'actividad_id' => 8,
                'entidad_id' => 7
            ],
            [
                'actividad_id' => 9,
                'entidad_id' => 1
            ],
            [
                'actividad_id' => 9,
                'entidad_id' => 2
            ],
            [
                'actividad_id' => 10,
                'entidad_id' => 1
            ],
            [
                'actividad_id' => 10,
                'entidad_id' => 2
            ],
            [
                'actividad_id' => 11,
                'entidad_id' => 1
            ],
            [
                'actividad_id' => 11,
                'entidad_id' => 2
            ],
        ];

        \App\Models\Responsable::insert($responsables);
    }
}
