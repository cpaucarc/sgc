<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $servicios = [
            [
                'nombre' => 'Salud'
            ], // 1
            [
                'nombre' => 'Psicopedagogia'
            ],//2
            [
                'nombre' => 'Servicio Social'
            ],//3
            [
                'nombre' => 'Recreación y Deporte'
            ],//4
            [
                'nombre' => 'Comedor Universitario'
            ],//5
        ];
        \App\Models\Servicio::insert($servicios);
    }
}
