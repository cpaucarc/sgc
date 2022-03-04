<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Role::create(['name' => 'Dirección de Escuela']);
        Role::create(['name' => 'Departamento Academico']);
        Role::create(['name' => 'Oficina General de Estudios']);
        Role::create(['name' => 'Docente']);
        Role::create(['name' => 'Decanatura']);
        Role::create(['name' => 'Direccion de Unidad de Calidad']);
        Role::create(['name' => 'Biblioteca']);
        Role::create(['name' => 'Comite de Tutoria']);
        Role::create(['name' => 'Estudiante']);
        Role::create(['name' => 'Vicerrectorado Académico']);
        Role::create(['name' => 'Vicerrectorado de Investigación']);
        Role::create(['name' => 'Direccion de Unidad de Responsabilidad Social']);
        Role::create(['name' => 'Direccion de Unidad de Investigación']);
        Role::create(['name' => 'Administrador']);
    }
}
