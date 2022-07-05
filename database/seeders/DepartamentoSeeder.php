<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deptos = [
            [
                'id' => 46,
                'nombre' => 'ADMINISTRACION Y TURISMO',
                'facultad_id' => 3
            ],
            [
                'id' => 51,
                'nombre' => 'AGRONOMIA',
                'facultad_id' => 2
            ],
            [
                'id' => 40,
                'nombre' => 'CIENCIA Y TECNOLOGIA DE ALIMENTOS',
                'facultad_id' => 4
            ],
            [
                'id' => 57,
                'nombre' => 'CIENCIAS BASICAS',
                'facultad_id' => 1
            ],
            [
                'id' => 44,
                'nombre' => 'CIENCIAS DEL AMBIENTE',
                'facultad_id' => 5
            ],
            [
                'id' => 50,
                'nombre' => 'CIENCIAS SOCIALES Y CIENCIAS DE LA COMUNICACION',
                'facultad_id' => 11
            ],
            [
                'id' => 45,
                'nombre' => 'CONTABILIDAD',
                'facultad_id' => 12
            ],
            [
                'id' => 48,
                'nombre' => 'DERECHO Y CIENCIAS POLITICAS',
                'facultad_id' => 10
            ],
            [
                'id' => 61,
                'nombre' => 'ECONOMIA',
                'facultad_id' => 12
            ],
            [
                'id' => 49,
                'nombre' => 'EDUCACION',
                'facultad_id' => 11
            ],
            [
                'id' => 54,
                'nombre' => 'ENFERMERIA',
                'facultad_id' => 8
            ],
            [
                'id' => 68,
                'nombre' => 'ESTADISTICA',
                'facultad_id' => 1
            ],
            [
                'id' => 41,
                'nombre' => 'INGENIERIA AGRICOLA',
                'facultad_id' => 2
            ],
            [
                'id' => 42,
                'nombre' => 'INGENIERIA CIVIL',
                'facultad_id' => 7
            ],
            [
                'id' => 43,
                'nombre' => 'INGENIERIA DE MINAS',
                'facultad_id' => 6
            ],
            [
                'id' => 52,
                'nombre' => 'INGENIERIA DE SISTEMAS Y TELECOMUNICACIONES',
                'facultad_id' => 1
            ],
            [
                'id' => 56,
                'nombre' => 'MATEMATICA',
                'facultad_id' => 1
            ],
            [
                'id' => 53,
                'nombre' => 'OBSTETRICIA',
                'facultad_id' => 8
            ],
            [
                'id' => 55,
                'nombre' => 'PROPEDEUTICA',
                'facultad_id' => 8
            ],
        ];

        \App\Models\Departamento::insert($deptos);
    }
}
