<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $curso = [
            [
                "escuela_id" => "10",
                "curricula" => "07",
                "codigo" => "EO-F01",
                "curso" => "INTRODUCCIÓN AL ESTUDIO DE LA OBSTETRICIA",
                "ciclo" => 1,
                "horas_teoria" => "2",
                "horas_prac" => "4",
            ],
        ];

        \App\Models\Curso::insert($curso);
    }
}
