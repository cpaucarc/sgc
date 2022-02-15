<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = [
            //Investigación
            [
                'nombre' => 'En ejecución',
                'color' => 'green',
                'categoria_id' => 1
            ],
            [
                'nombre' => 'Denegado',
                'color' => 'red',
                'categoria_id' => 1
            ],
            [
                'nombre' => 'Concluido',
                'color' => 'gray',
                'categoria_id' => 1
            ],
            //Solicitud
            [
                'nombre' => 'En Evaluacion',
                'color' => 'indigo',
                'categoria_id' => 2
            ],
            [
                'nombre' => 'Denegado',
                'color' => 'red',
                'categoria_id' => 2
            ],
            [
                'nombre' => 'Aprobado',
                'color' => 'green',
                'categoria_id' => 2
            ],
            //Convalidacion
            [
                'nombre' => 'Denegado',
                'color' => 'red',
                'categoria_id' => 3
            ],
            [
                'nombre' => 'Aprobado',
                'color' => 'green',
                'categoria_id' => 3
            ],
            //Sustentacion
            [
                'nombre' => 'Denegado',
                'color' => 'red',
                'categoria_id' => 4
            ],
            [
                'nombre' => 'Aprobado',
                'color' => 'green',
                'categoria_id' => 4
            ],
        ];

        \App\Models\Estado::insert($estados);
    }
}
