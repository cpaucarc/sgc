<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            ['nombre' => 'Planificar',],
            ['nombre' => 'Hacer',],
            ['nombre' => 'Verificar',],
            ['nombre' => 'Actuar',],
        ];

        \App\Models\TipoActividad::insert($tipos);
    }
}
