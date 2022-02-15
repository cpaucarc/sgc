<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $salidas = [
            [
                'codigo' => 'S1',
                'nombre' => 'Plan de trabajo de E-A aprobado',
            ],
            [
                'codigo' => 'S2',
                'nombre' => 'Silabo de la asignatura aprobado',
            ],
            [
                'codigo' => 'S3',
                'nombre' => 'Silabo publicado',
            ],
            [
                'codigo' => 'S4',
                'nombre' => 'Requerimiento de recursos',
            ],
            [
                'codigo' => 'S5',
                'nombre' => 'Plan de prácticas de la asignatura',
            ],
            [
                'codigo' => 'S6',
                'nombre' => 'Registro de entrega del sílabo a los estudiantes',
            ],
            [
                'codigo' => 'S7',
                'nombre' => 'Registro de entrega de material de clases',
            ],
            [
                'codigo' => 'S8',
                'nombre' => 'Registro de formato de avance silábico',
            ],
            [
                'codigo' => 'S9',
                'nombre' => 'Plan de responsabilidad social',
            ],
            [
                'codigo' => 'S10',
                'nombre' => 'Lista de grupos de práctica',
            ],
            [
                'codigo' => 'E11',
                'nombre' => 'Informe de Tutoría',
            ],
            [
                'codigo' => 'E12',
                'nombre' => 'Registro de notas',
            ],
            [
                'codigo' => 'S13',
                'nombre' => 'Informe de evaluación docente',
            ],
            [
                'codigo' => 'S14',
                'nombre' => 'Pre actas firmadas',
            ],
            [
                'codigo' => 'S15',
                'nombre' => 'Actas firmadas',
            ],
            [
                'codigo' => 'S16',
                'nombre' => 'Informe de situación académica del estudiante',
            ],
            [
                'codigo' => 'S17',
                'nombre' => 'Informe de evaluación de E-A',
            ],
            [
                'codigo' => 'S18',
                'nombre' => 'Resultado de los indicadores',
            ],
            [
                'codigo' => 'S19',
                'nombre' => 'Acciones y/o Plan de mejora',
            ],
            [
                'codigo' => 'S20',
                'nombre' => 'Registro y envío de comunicaciones'
            ],
        ];

        \App\Models\Salida::insert($salidas);
    }
}
