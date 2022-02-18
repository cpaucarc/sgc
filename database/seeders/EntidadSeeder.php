<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entidades = [
            [
                'nombre' => 'Dirección de Escuela de Enfermeria',
                'oficina_id' => 1,
                'entidadable_id' => 1,
                'entidadable_type' => "App\\Models\Escuela"
            ],
            [
                'nombre' => 'Dirección de Escuela de Obstetricia',
                'oficina_id' => 1,
                'entidadable_id' => 2,
                'entidadable_type' => "App\\Models\Escuela"
            ],
            [
                'nombre' => 'Departamento Academico de Enfermeria',
                'oficina_id' => 2,
                'entidadable_id' => 1,
                'entidadable_type' => "App\\Models\Escuela"
            ],
            [
                'nombre' => 'Departamento Academico de Obstetricia',
                'oficina_id' => 2,
                'entidadable_id' => 2,
                'entidadable_type' => "App\\Models\Escuela"
            ],
            [
                'nombre' => 'Oficina General de Estudios',
                'oficina_id' => 3,
                'entidadable_id' => null,
                'entidadable_type' => null
            ],
            [
                'nombre' => 'Docente de Enfermeria',
                'oficina_id' => 4,
                'entidadable_id' => 1,
                'entidadable_type' => "App\\Models\Escuela"
            ],
            [
                'nombre' => 'Docente de Obstetricia',
                'oficina_id' => 4,
                'entidadable_id' => 2,
                'entidadable_type' => "App\\Models\Escuela"
            ],
            [
                'nombre' => 'Decanatura FCM',
                'oficina_id' => 5,
                'entidadable_id' => 1,
                'entidadable_type' => "App\\Models\Facultad"
            ],
            [
                'nombre' => 'Direccion de Unidad de Calidad',
                'oficina_id' => 6,
                'entidadable_id' => null,
                'entidadable_type' => null
            ],
            [
                'nombre' => 'Biblioteca FCM',
                'oficina_id' => 7,
                'entidadable_id' => 1,
                'entidadable_type' => "App\\Models\Facultad"
            ],
            [
                'nombre' => 'Comite de Tutoria de Enfermeria',
                'oficina_id' => 8,
                'entidadable_id' => 1,
                'entidadable_type' => "App\\Models\Escuela"
            ],
            [
                'nombre' => 'Comite de Tutoria de Obstetricia',
                'oficina_id' => 8,
                'entidadable_id' => 1,
                'entidadable_type' => "App\\Models\Escuela"
            ],
            [
                'nombre' => 'Estudiante de Enfermeria',
                'oficina_id' => 9,
                'entidadable_id' => 1,
                'entidadable_type' => "App\\Models\Escuela"
            ],
            [
                'nombre' => 'Estudiante de Obstetricia',
                'oficina_id' => 9,
                'entidadable_id' => 1,
                'entidadable_type' => "App\\Models\Escuela"
            ],
            [
                'nombre' => 'Vicerrectorado Académico',
                'oficina_id' => 10,
                'entidadable_id' => null,
                'entidadable_type' => null
            ],
            [
                'nombre' => 'Vicerrectorado de Investigación',
                'oficina_id' => 11,
                'entidadable_id' => null,
                'entidadable_type' => null
            ],
            [
                'nombre' => 'Direccion de Unidad de Responsabilidad Social',
                'oficina_id' => 12,
                'entidadable_id' => null,
                'entidadable_type' => null
            ],
            [
                'nombre' => 'Direccion de Unidad de Investigación de FCM',
                'oficina_id' => 13,
                'entidadable_id' => null,
                'entidadable_type' => null
            ]
        ];

        \App\Models\Entidad::insert($entidades);
    }
}
