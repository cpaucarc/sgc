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
                'role_id' => 1
            ], //id:1
            [
                'nombre' => 'Dirección de Escuela de Obstetricia',
                'role_id' => 1
            ], //id:2
            [
                'nombre' => 'Departamento Academico de Enfermeria',
                'role_id' => 2
            ], //id:3
            [
                'nombre' => 'Departamento Academico de Obstetricia',
                'role_id' => 2
            ], //id:4
            [
                'nombre' => 'Oficina General de Estudios',
                'role_id' => 3
            ], //id:5
            [
                'nombre' => 'Docente de Enfermeria',
                'role_id' => 4
            ], //id:6
            [
                'nombre' => 'Docente de Obstetricia',
                'role_id' => 4
            ], //id:7
            [
                'nombre' => 'Decanatura FCM',
                'role_id' => 5
            ], //id:8
            [
                'nombre' => 'Direccion de Unidad de Calidad',
                'role_id' => 6
            ], //id:9
            [
                'nombre' => 'Biblioteca FCM',
                'role_id' => 7
            ], //id:10
            [
                'nombre' => 'Comite de Tutoria de Enfermeria',
                'role_id' => 8
            ], //id:11
            [
                'nombre' => 'Comite de Tutoria de Obstetricia',
                'role_id' => 8
            ], //id:12
            [
                'nombre' => 'Estudiante de Enfermeria',
                'role_id' => 9
            ], //id:13
            [
                'nombre' => 'Estudiante de Obstetricia',
                'role_id' => 9
            ], //id:14
            [
                'nombre' => 'Vicerrectorado Académico',
                'role_id' => 10
            ], //id:15
            [
                'nombre' => 'Vicerrectorado de Investigación',
                'role_id' => 11
            ], //id:16
            [
                'nombre' => 'Direccion de Unidad de Responsabilidad Social',
                'role_id' => 12
            ], //id:17
            [
                'nombre' => 'Direccion de Unidad de Investigación de FCM',
                'role_id' => 13
            ], //id:18
            [
                'nombre' => 'Consejo de Facultad de FCM',
                'role_id' => 14
            ], //id:19
            [
                'nombre' => 'Oficina General de Calidad Universitaria (OGCU)',
                'role_id' => 15
            ], //id:20
            [
                'nombre' => 'Dirección de Evaluación y Acreditación (DEA)',
                'role_id' => 16
            ], //id:21
            [
                'nombre' => 'Rector de la UNASAM',
                'role_id' => 17
            ], //id:22
            [
                'nombre' => 'Comité de Calidad de Enfermería',
                'role_id' => 18
            ], //id:23
            [
                'nombre' => 'Comité de Calidad de Obstetricia',
                'role_id' => 18
            ], //id:24
            [
                'nombre' => 'Dirección General de Administración',
                'role_id' => 19
            ], //id:25
            [
                'nombre' => 'Dirección de Abastecimiento y Servicios Auxiliares (DASA)',
                'role_id' => 20
            ], //id:26
            [
                'nombre' => 'Entidad Evaluadora Externa',
                'role_id' => 21
            ], //id:27
            [
                'nombre' => 'SINEACE',
                'role_id' => 21
            ], //id:28
            [
                'nombre' => 'Consejo Universitario',
                'role_id' => 22
            ], //id:29
            [
                'nombre' => 'Comisión de Diseño del Plan de Estudios',
                'role_id' => 23
            ], //id:30
            [
                'nombre' => 'Comisión de Evaluación y Actualización del Plan de estudios',
                'role_id' => 23
            ], //id:31
        ];

        \App\Models\Entidad::insert($entidades);
    }
}
