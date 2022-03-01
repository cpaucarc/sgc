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
                'proceso_id' => 1
            ],
            [
                'codigo' => 'S2',
                'nombre' => 'Silabo de la asignatura aprobado',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'S3',
                'nombre' => 'Silabo publicado',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'S4',
                'nombre' => 'Requerimiento de recursos',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'S5',
                'nombre' => 'Plan de prácticas de la asignatura',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'S6',
                'nombre' => 'Registro de entrega del sílabo a los estudiantes',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'S7',
                'nombre' => 'Registro de entrega de material de clases',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'S8',
                'nombre' => 'Registro de formato de avance silábico',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'S9',
                'nombre' => 'Plan de responsabilidad social',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'S10',
                'nombre' => 'Lista de grupos de práctica',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E11',
                'nombre' => 'Informe de Tutoría',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E12',
                'nombre' => 'Registro de notas',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'S13',
                'nombre' => 'Informe de evaluación docente',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'S14',
                'nombre' => 'Pre actas firmadas',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'S15',
                'nombre' => 'Actas firmadas',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'S16',
                'nombre' => 'Informe de situación académica del estudiante',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'S17',
                'nombre' => 'Informe de evaluación de E-A',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'S18',
                'nombre' => 'Resultado de los indicadores',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'S19',
                'nombre' => 'Acciones y/o Plan de mejora',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'S20',
                'nombre' => 'Registro y envío de comunicaciones',
                'proceso_id' => 1
            ],
        ];

        \App\Models\Salida::insert($salidas);
    }
}
