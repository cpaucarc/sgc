<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Dirección de Escuela']);  //id:1
        Role::create(['name' => 'Departamento Academico']); //id:2
        Role::create(['name' => 'Oficina General de Estudios']); //id:3
        Role::create(['name' => 'Docente']); //id:4
        Role::create(['name' => 'Decanatura']); //id:5
        Role::create(['name' => 'Direccion de Unidad de Calidad']); //id:6
        Role::create(['name' => 'Biblioteca']); //id:7
        Role::create(['name' => 'Comite de Tutoria']); //id:8
        Role::create(['name' => 'Estudiante']); //id:9
        Role::create(['name' => 'Vicerrectorado Académico']); //id:10
        Role::create(['name' => 'Vicerrectorado de Investigación']); //id:11
        Role::create(['name' => 'Direccion de Unidad de Responsabilidad Social']); //id:12
        Role::create(['name' => 'Direccion de Unidad de Investigación']); //id:13
        Role::create(['name' => 'Consejo de Facultad']); //id:14
        Role::create(['name' => 'Oficina General de Calidad Universitaria']); //id:15
        Role::create(['name' => 'Dirección de Evaluación y Acreditación']); //id:16
        Role::create(['name' => 'Rectorado']); //id:17
        Role::create(['name' => 'Comité de Calidad']); //id:18
        Role::create(['name' => 'Dirección General de Administración']); //id:19
        Role::create(['name' => 'Dirección de Abastecimiento y Servicios Auxiliares']); //id:20
        Role::create(['name' => 'Entidad Evaluadora Externa']); //id:21
        Role::create(['name' => 'Consejo Universitario']); //id:22
        Role::create(['name' => 'Plan de Estudios']); //id:23
        Role::create(['name' => 'Administrador']);
    }
}
