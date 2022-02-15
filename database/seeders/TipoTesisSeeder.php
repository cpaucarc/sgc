<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoTesisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            ['nombre' => 'Tesis'],
            ['nombre' => 'Tesis Guiada'],
        ];
        \App\Models\TipoTesis::insert($tipos);
    }
}
