<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actividades = [
            [
                'nombre' => 'Planificar la gestión de Enseñanza - Aprendizaje',
                'tipo_actividad_id' => 1,
                'proceso_id' => 1,
            ],
            [
                'nombre' => 'Elaborar y publicar silabo',
                'tipo_actividad_id' => 2,
                'proceso_id' => 1,
            ],
            [
                'nombre' => 'Requerir recursos',
                'tipo_actividad_id' => 2,
                'proceso_id' => 1,
            ],
            [
                'nombre' => 'Desarrollar sesiones de clase',
                'tipo_actividad_id' => 2,
                'proceso_id' => 1,
            ],
            [
                'nombre' => 'Realizar Tutoría',
                'tipo_actividad_id' => 2,
                'proceso_id' => 1,
            ],
            [
                'nombre' => 'Evaluar desempeño del estudiante',
                'tipo_actividad_id' => 2,
                'proceso_id' => 1,
            ],
            [
                'nombre' => 'Evaluar desempeño del docente',
                'tipo_actividad_id' => 2,
                'proceso_id' => 1,
            ],
            [
                'nombre' => 'Cierre de Semestre Académico',
                'tipo_actividad_id' => 2,
                'proceso_id' => 1,
            ],
            [
                'nombre' => 'Evaluar proceso E-A',
                'tipo_actividad_id' => 3,
                'proceso_id' => 1,
            ],
            [
                'nombre' => 'Mejorar proceso E-A',
                'tipo_actividad_id' => 4,
                'proceso_id' => 1,
            ],
            [
                'nombre' => 'Comunicar a interesados',
                'tipo_actividad_id' => 2,
                'proceso_id' => 1,
            ],
        ];

        \App\Models\Actividad::insert($actividades);
    }
}
