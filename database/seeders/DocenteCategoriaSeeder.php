<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocenteCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [
            [
                'nombre' => 'AUXILIAR',
            ],
            [
                'nombre' => 'ASOCIADO',
            ],
            [
                'nombre' => 'PRINCIPAL',
            ],
            [
                'nombre' => 'DC A1',
            ],
            [
                'nombre' => 'DC A2',
            ],
            [
                'nombre' => 'DC B1',
            ],
            [
                'nombre' => 'DC B2',
            ],
            [
                'nombre' => 'JEFE DE PRACTICAS',
            ],
            [
                'nombre' => 'SERVICIO ACADEMICO PROFESIONAL',
            ],
        ];

        \App\Models\DocenteCategoria::insert($categorias);
    }
}
