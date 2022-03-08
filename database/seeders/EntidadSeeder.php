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
            ], //id:1
            [
                'nombre' => 'Dirección de Escuela de Obstetricia',
                'oficina_id' => 1
            ], //id:2
            [
                'nombre' => 'Departamento Academico de Enfermeria',
                'oficina_id' => 2
            ], //id:3
            [
                'nombre' => 'Departamento Academico de Obstetricia',
                'oficina_id' => 2
            ], //id:4
            [
                'nombre' => 'Oficina General de Estudios',
                'oficina_id' => 3
            ], //id:5
            [
                'nombre' => 'Docente de Enfermeria',
                'oficina_id' => 4
            ], //id:6
            [
                'nombre' => 'Docente de Obstetricia',
                'oficina_id' => 4
            ], //id:7
            [
                'nombre' => 'Decanatura FCM',
                'oficina_id' => 5
            ], //id:8
            [
                'nombre' => 'Direccion de Unidad de Calidad',
                'oficina_id' => 6
            ], //id:9
            [
                'nombre' => 'Biblioteca FCM',
                'oficina_id' => 7
            ], //id:10
            [
                'nombre' => 'Comite de Tutoria de Enfermeria',
                'oficina_id' => 8
            ], //id:11
            [
                'nombre' => 'Comite de Tutoria de Obstetricia',
                'oficina_id' => 8
            ], //id:12
            [
                'nombre' => 'Estudiante de Enfermeria',
                'oficina_id' => 9
            ], //id:13
            [
                'nombre' => 'Estudiante de Obstetricia',
                'oficina_id' => 9
            ], //id:14
            [
                'nombre' => 'Vicerrectorado Académico',
                'oficina_id' => 10
            ], //id:15
            [
                'nombre' => 'Vicerrectorado de Investigación',
                'oficina_id' => 11
            ], //id:16
            [
                'nombre' => 'Direccion de Unidad de Responsabilidad Social',
                'oficina_id' => 12
            ], //id:17
            [
                'nombre' => 'Direccion de Unidad de Investigación de FCM',
                'oficina_id' => 13
            ], //id:18
            [
                'nombre' => 'Consejo de Facultad de FCM',
                'oficina_id' => 14
            ], //id:19
            [
                'nombre' => 'Oficina General de Calidad Universitaria (OGCU)',
                'oficina_id' => 15
            ], //id:20
            [
                'nombre' => 'Dirección de Evaluación y Acreditación (DEA)',
                'oficina_id' => 16
            ], //id:21
            [
                'nombre' => 'Rector de la UNASAM',
                'oficina_id' => 17
            ], //id:22
            [
                'nombre' => 'Comité de Calidad de Enfermería',
                'oficina_id' => 18
            ], //id:23
            [
                'nombre' => 'Comité de Calidad de Obstetricia',
                'oficina_id' => 18
            ], //id:24
            [
                'nombre' => 'Dirección General de Administración',
                'oficina_id' => 19
            ], //id:25
            [
                'nombre' => 'Dirección de Abastecimiento y Servicios Auxiliares (DASA)',
                'oficina_id' => 20
            ], //id:26
            [
                'nombre' => 'Entidad Evaluadora Externa',
                'oficina_id' => 21
            ], //id:27
            [
                'nombre' => 'SINEACE',
                'oficina_id' => 21
            ] //id:28
        ];

        \App\Models\Entidad::insert($entidades);
    }
}
