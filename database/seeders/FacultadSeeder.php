<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FacultadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facultades = [
            [
                'nombre' => 'Facultad de Ciencias Medicas',
                'abrev' => 'FCM',
                'direccion' => 'Av. Agustín Gamarra N° 1227',
                'uuid' => Str::uuid()
            ],
        ];

        \App\Models\Facultad::insert($facultades);
    }
}
