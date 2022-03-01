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
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E2',
                'nombre' => 'POI asignado',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E3',
                'nombre' => 'Plan Estratégico Escuela',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E4',
                'nombre' => 'Reglamento de la Programación, Ejecución y Control de las Actividades Académicas',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E5',
                'nombre' => 'Modelo educativo',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E6',
                'nombre' => 'Guía de elaboración de silabo',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E7',
                'nombre' => 'Lista de Libros de consulta (Bibliografía)',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E8',
                'nombre' => 'Plan de trabajo de E-A aprobado',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E9',
                'nombre' => 'Guía de investigación formativa',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E10',
                'nombre' => 'Esquema de sesión de aprendizaje',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E11',
                'nombre' => 'Formato de entrega de silabo',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E12',
                'nombre' => 'Formato de avance de silabo',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E13',
                'nombre' => 'Formato de asistencia de estudiantes',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E14',
                'nombre' => 'Procedimiento Tutoría',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E15',
                'nombre' => 'Procedimiento de Supervisión al desempeño docente',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E16',
                'nombre' => 'Formato de registro de notas',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E17',
                'nombre' => 'Procedimiento medir',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E18',
                'nombre' => 'Procedimiento analizar',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E19',
                'nombre' => 'Lista de indicadores de E-A',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E20',
                'descripcion' => 'Procedimiento mejorar',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E21',
                'nombre' => 'Formato de Plan de mejora',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E22',
                'nombre' => 'Informe de evaluación de E-A',
                'proceso_id' => 1
            ],
            [
                'codigo' => 'E23',
                'nombre' => 'Procedimiento Comunicar a interesados',
                'proceso_id' => 1
            ],
        ];

        \App\Models\Entrada::insert($entradas);
    }
}
