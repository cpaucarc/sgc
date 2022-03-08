<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConvalidacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $convalidacion = [
            [
                'vacantes' => '5',
                'postulantes' => '3',
                'convalidados' => '3',
                'semestre_id' => '1',
                'escuela_id' => '1',
            ],
            [
                'vacantes' => '5',
                'postulantes' => '3',
                'convalidados' => '3',
                'semestre_id' => '1',
                'escuela_id' => '2',
            ],
            [
                'vacantes' => '5',
                'postulantes' => '3',
                'convalidados' => '3',
                'semestre_id' => '2',
                'escuela_id' => '1',
            ],
            [
                'vacantes' => '5',
                'postulantes' => '3',
                'convalidados' => '3',
                'semestre_id' => '2',
                'escuela_id' => '2',
            ],
            [
                'vacantes' => '5',
                'postulantes' => '3',
                'convalidados' => '3',
                'semestre_id' => '3',
                'escuela_id' => '1',
            ],
            [
                'vacantes' => '5',
                'postulantes' => '3',
                'convalidados' => '3',
                'semestre_id' => '3',
                'escuela_id' => '2',
            ],
        ];

        \App\Models\Convalidacion::insert($convalidacion);
    }
}
