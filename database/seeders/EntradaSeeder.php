<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntradaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $entradas = [
            [
                'codigo' => 'E1',
                'nombre' => 'Informe de evaluación E-A del semestre anterior',
            ],
            [
                'codigo' => 'E2',
                'nombre' => 'POI asignado',
            ],
            [
                'codigo' => 'E3',
                'nombre' => 'Plan Estratégico Escuela',
            ],
            [
                'codigo' => 'E4',
                'nombre' => 'Reglamento de la Programación, Ejecución y Control de las Actividades Académicas',
            ],
            [
                'codigo' => 'E5',
                'nombre' => 'Modelo educativo',
            ],
            [
                'codigo' => 'E6',
                'nombre' => 'Guía de elaboración de silabo',
            ],
            [
                'codigo' => 'E7',
                'nombre' => 'Lista de Libros de consulta (Bibliografía)',
            ],
            [
                'codigo' => 'E8',
                'nombre' => 'Plan de trabajo de E-A aprobado',
            ],
            [
                'codigo' => 'E9',
                'nombre' => 'Guía de investigación formativa',
            ],
            [
                'codigo' => 'E10',
                'nombre' => 'Esquema de sesión de aprendizaje',
            ],
            [
                'codigo' => 'E11',
                'nombre' => 'Formato de entrega de silabo',
            ],
            [
                'codigo' => 'E12',
                'nombre' => 'Formato de avance de silabo',
            ],
            [
                'codigo' => 'E13',
                'nombre' => 'Formato de asistencia de estudiantes',
            ],
            [
                'codigo' => 'E14',
                'nombre' => 'Procedimiento Tutoría',
            ],
            [
                'codigo' => 'E15',
                'nombre' => 'Procedimiento de Supervisión al desempeño docente',
            ],
            [
                'codigo' => 'E16',
                'nombre' => 'Formato de registro de notas',
            ],
            [
                'codigo' => 'E17',
                'nombre' => 'Procedimiento medir',
            ],
            [
                'codigo' => 'E18',
                'nombre' => 'Procedimiento analizar',
            ],
            [
                'codigo' => 'E19',
                'nombre' => 'Lista de indicadores de E-A',
            ],
            [
                'codigo' => 'E20',
                'descripcion' => 'Procedimiento mejorar',
            ],
            [
                'codigo' => 'E21',
                'nombre' => 'Formato de Plan de mejora',
            ],
            [
                'codigo' => 'E22',
                'nombre' => 'Informe de evaluación de E-A',
            ],
            [
                'codigo' => 'E23',
                'nombre' => 'Procedimiento Comunicar a interesados',
            ],
        ];

        \App\Models\Entrada::insert($entradas);
    }
}
