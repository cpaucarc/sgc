<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoInstitucionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo_institucion = [
            ['nombre' => 'Instituto',],
            ['nombre' => 'Universidad',],
        ];
        \App\Models\TipoInstitucion::insert($tipo_institucion);
    }
}
