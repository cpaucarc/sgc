<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EncuestaPreguntaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $preguntas = [
            [
                'nombre' => '¿Cómo calificaría el programa en el cual ha participado?',
                'proceso_id' => 9
            ],
            [
                'nombre' => '¿Lorem Ipsum is simply dummy text of the printing and typesetting industry?',
                'proceso_id' => 9
            ],
            [
                'nombre' => '¿It is a long established fact that a reader will be distracted?',
                'proceso_id' => 9
            ],
            [
                'nombre' => '¿There are many variations of passages of Lorem Ipsum available?',
                'proceso_id' => 9
            ],
            [
                'nombre' => '¿Lorem Ipsum is therefore always free from repetition, injected humour?',
                'proceso_id' => 9
            ],
            [
                'nombre' => '¿The standard chunk of Lorem Ipsum used since the 1500s is reproduced?',
                'proceso_id' => 9
            ],
        ];

        \App\Models\EncuestaPregunta::insert($preguntas);
    }
}
