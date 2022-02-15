<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradoAcademicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grado = [
            [
                'nombre' => 'Estudiante',
                'color' => 'green'
            ],
            [
                'nombre' => 'Egresado',
                'color' => 'gray'
            ],
            [
                'nombre' => 'Bachiller',
                'color' => 'indigo'
            ],
            [
                'nombre' => 'Titulado',
                'color' => 'yellow'
            ],
            [
                'nombre' => 'Magister',
                'color' => 'gray'
            ],
            [
                'nombre' => 'Doctor',
                'color' => 'gray'
            ],
            [
                'nombre' => 'PhD',
                'color' => 'gray'
            ],
        ];

        \App\Models\GradoAcademico::insert($grado);
    }
}
