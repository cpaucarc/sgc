<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OficinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oficinas = [
            ['nombre' => 'Dirección de Escuela',], //id:1
            ['nombre' => 'Departamento Academico',], //id:2
            ['nombre' => 'Oficina General de Estudios',], //id:3
            ['nombre' => 'Docente',], //id:4
            ['nombre' => 'Decanatura',], //id:5
            ['nombre' => 'Direccion de Unidad de Calidad',], //id:6
            ['nombre' => 'Biblioteca',], //id:7
            ['nombre' => 'Comite de Tutoria',], //id:8
            ['nombre' => 'Estudiante',], //id:9
            ['nombre' => 'Vicerrectorado Académico',], //id:10
            ['nombre' => 'Vicerrectorado de Investigación',], //id:11
            ['nombre' => 'Direccion de Unidad de Responsabilidad Social',], //id:12
            ['nombre' => 'Direccion de Unidad de Investigación',], //id:13
            ['nombre' => 'Consejo de Facultad',], //id:14
            ['nombre' => 'Oficina General de Calidad Universitaria',], //id:15
            ['nombre' => 'Dirección de Evaluación y Acreditación',], //id:16
            ['nombre' => 'Rectorado',], //id:17
            ['nombre' => 'Comité de Calidad',], //id:18
            ['nombre' => 'Dirección General de Administración',], //id:19
            ['nombre' => 'Dirección de Abastecimiento y Servicios Auxiliares',], //id:20
            ['nombre' => 'Entidad Evaluadora Externa',], //id:21
            ['nombre' => 'Consejo Universitario',], //id:22
            ['nombre' => 'Plan de Estudios',], //id:23
        ];

        \App\Models\Oficina::insert($oficinas);
    }
}
