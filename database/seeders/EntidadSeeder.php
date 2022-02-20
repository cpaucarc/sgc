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
                'oficina_id' => 1
            ],
            [
                'nombre' => 'Dirección de Escuela de Obstetricia',
                'oficina_id' => 1
            ],
            [
                'nombre' => 'Departamento Academico de Enfermeria',
                'oficina_id' => 2
            ],
            [
                'nombre' => 'Departamento Academico de Obstetricia',
                'oficina_id' => 2
            ],
            [
                'nombre' => 'Oficina General de Estudios',
                'oficina_id' => 3
            ],
            [
                'nombre' => 'Docente de Enfermeria',
                'oficina_id' => 4
            ],
            [
                'nombre' => 'Docente de Obstetricia',
                'oficina_id' => 4
            ],
            [
                'nombre' => 'Decanatura FCM',
                'oficina_id' => 5
            ],
            [
                'nombre' => 'Direccion de Unidad de Calidad',
                'oficina_id' => 6
            ],
            [
                'nombre' => 'Biblioteca FCM',
                'oficina_id' => 7
            ],
            [
                'nombre' => 'Comite de Tutoria de Enfermeria',
                'oficina_id' => 8
            ],
            [
                'nombre' => 'Comite de Tutoria de Obstetricia',
                'oficina_id' => 8
            ],
            [
                'nombre' => 'Estudiante de Enfermeria',
                'oficina_id' => 9
            ],
            [
                'nombre' => 'Estudiante de Obstetricia',
                'oficina_id' => 9
            ],
            [
                'nombre' => 'Vicerrectorado Académico',
                'oficina_id' => 10
            ],
            [
                'nombre' => 'Vicerrectorado de Investigación',
                'oficina_id' => 11
            ],
            [
                'nombre' => 'Direccion de Unidad de Responsabilidad Social',
                'oficina_id' => 12
            ],
            [
                'nombre' => 'Direccion de Unidad de Investigación de FCM',
                'oficina_id' => 13
            ]
        ];

        \App\Models\Entidad::insert($entidades);
    }
}
