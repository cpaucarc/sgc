<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CargoJuradoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cargos = [
            [
                'nombre' => 'Presidente'
            ],
            [
                'nombre' => 'Secretario'
            ],
            [
                'nombre' => 'Vocal'
            ],
        ];
        \App\Models\CargoJurado::insert($cargos);
    }
}
