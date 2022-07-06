<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocenteCondicionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $condicion = [
            [
                'nombre' => 'CONTRATADO',
            ],
            [
                'nombre' => 'NOMBRADO',
            ],
        ];

        \App\Models\DocenteCondicion::insert($condicion);
    }
}
