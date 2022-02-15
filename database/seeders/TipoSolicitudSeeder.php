<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoSolicitudSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo_solicitud = [
            ['nombre' => 'Bachiller',],
            ['nombre' => 'Convalidación',],
            ['nombre' => 'Título',],
        ];
        \App\Models\TipoSolicitud::insert($tipo_solicitud);
    }
}
