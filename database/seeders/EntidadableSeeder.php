<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntidadableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entidadles = [
            [
                'entidadable_id' => 1,
                'entidadable_type' => "App\\Models\\Escuela",
                'entidad_id' => 1
            ],
            [
                'entidadable_id' => 2,
                'entidadable_type' => "App\\Models\\Escuela",
                'entidad_id' => 2
            ],
            [
                'entidadable_id' => 1,
                'entidadable_type' => "App\\Models\\Escuela",
                'entidad_id' => 3
            ],
            [
                'entidadable_id' => 2,
                'entidadable_type' => "App\\Models\\Escuela",
                'entidad_id' => 4
            ],
            [
                'entidadable_id' => 1,
                'entidadable_type' => "App\\Models\\Escuela",
                'entidad_id' => 6
            ],
            [
                'entidadable_id' => 2,
                'entidadable_type' => "App\\Models\\Escuela",
                'entidad_id' => 7
            ],
            [
                'entidadable_id' => 1,
                'entidadable_type' => "App\\Models\\Escuela",
                'entidad_id' => 11
            ],
            [
                'entidadable_id' => 2,
                'entidadable_type' => "App\\Models\\Escuela",
                'entidad_id' => 12
            ],
            [
                'entidadable_id' => 1,
                'entidadable_type' => "App\\Models\\Escuela",
                'entidad_id' => 13
            ],
            [
                'entidadable_id' => 2,
                'entidadable_type' => "App\\Models\\Escuela",
                'entidad_id' => 14
            ],
            [
                'entidadable_id' => 1,
                'entidadable_type' => "App\\Models\\Facultad",
                'entidad_id' => 8
            ],
            [
                'entidadable_id' => 1,
                'entidadable_type' => "App\\Models\Facultad",
                'entidad_id' => 10
            ],
        ];
        \App\Models\Entidadable::insert($entidadles);
    }
}
