<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocenteDedicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dedicacion = [
            [
                'nombre' => 'TIEMPO COMPLETO',
            ],
            [
                'nombre' => 'TIEMPO PARCIAL',
            ],
            [
                'nombre' => 'DEDICACION EXCLUSIVA',
            ],
        ];

        \App\Models\DocenteDedicacion::insert($dedicacion);
    }
}
