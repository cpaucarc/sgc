<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaEstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat = [
            [
                'nombre' => 'Investigación'
            ],
            [
                'nombre' => 'Solicitud'
            ],
            [
                'nombre' => 'Convalidacion'
            ],
            [
                'nombre' => 'Sustentacion'
            ],
        ];
        \App\Models\CategoriaEstado::insert($cat);
    }
}
