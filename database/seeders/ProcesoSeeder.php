<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProcesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $procesos = [
            ['nombre' => 'Enseñanza y Aprendizaje',],
            ['nombre' => 'Tutoria y Consejeria',],
            ['nombre' => 'Gestion de la Escuela',],
            ['nombre' => 'Matricula',],
            ['nombre' => 'Titulo Profesional',],
            ['nombre' => 'Docente',],
            ['nombre' => 'Biblioteca',],
            ['nombre' => 'Investigacion',],
            ['nombre' => 'Responsabilidad Social',],
            ['nombre' => 'Plan de Estudios',],
            ['nombre' => 'Gestion de la Calidad',],
            ['nombre' => 'Grado Bachiller',],
            ['nombre' => 'Bolsa de Trabajo',],
            ['nombre' => 'Bienestar Universitario',],
            ['nombre' => 'Convenios',],
            ['nombre' => 'Convalidaciones',],
        ];

        \App\Models\Proceso::insert($procesos);
    }
}
