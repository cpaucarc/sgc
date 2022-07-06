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
                'uuid' => Str::uuid(),
                'nombre' => 'Salud'
            ], // 1
            [
                'uuid' => Str::uuid(),
                'nombre' => 'Psicopedagogia'
            ],//2
            [
                'uuid' => Str::uuid(),
                'nombre' => 'Servicio Social'
            ],//3
            [
                'uuid' => Str::uuid(),
                'nombre' => 'Recreación y Deporte'
            ],//4
            [
                'uuid' => Str::uuid(),
                'nombre' => 'Comedor Universitario'
            ],//5
        ];
        \App\Models\Servicio::insert($servicios);
    }
}
