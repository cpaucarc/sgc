<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndicadorableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $indicadores = [
            //Indicador 1
            [
                'indicador_id' => 1,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 1,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 1,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 2
            [
                'indicador_id' => 2,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 2,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 2,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 3
            [
                'indicador_id' => 3,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 3,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 3,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 4
            [
                'indicador_id' => 4,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 4,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 4,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 5
            [
                'indicador_id' => 5,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 5,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 5,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 6
            [
                'indicador_id' => 6,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 6,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 6,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 7
            [
                'indicador_id' => 7,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 7,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 8
            [
                'indicador_id' => 8,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 8,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 9
            [
                'indicador_id' => 9,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 9,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 10
            [
                'indicador_id' => 10,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 10,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 11
            [
                'indicador_id' => 11,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 11,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 12
            [
                'indicador_id' => 12,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 12,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 13
            [
                'indicador_id' => 13,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 13,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 14
            [
                'indicador_id' => 14,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 14,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 15
            [
                'indicador_id' => 15,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 15,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 16
            [
                'indicador_id' => 16,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 16,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 17
            [
                'indicador_id' => 17,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 17,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 18
            [
                'indicador_id' => 18,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            //Indicador 19
            [
                'indicador_id' => 19,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            //Indicador 20
            [
                'indicador_id' => 20,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            //Indicador 21
            [
                'indicador_id' => 21,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            //Indicador 22
            [
                'indicador_id' => 22,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            //Indicador 23
            [
                'indicador_id' => 23,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 23,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 24
            [
                'indicador_id' => 24,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 24,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 25
            [
                'indicador_id' => 25,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 25,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 26
            [
                'indicador_id' => 26,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 26,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 27
            [
                'indicador_id' => 27,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 27,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 28
            [
                'indicador_id' => 28,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 28,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 29
            [
                'indicador_id' => 29,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 29,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 30
            [
                'indicador_id' => 30,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            //Indicador 31
            [
                'indicador_id' => 31,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            //Indicador 32
            [
                'indicador_id' => 32,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            //Indicador 33
            [
                'indicador_id' => 33,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            //Indicador 34
            [
                'indicador_id' => 34,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            //Indicador 35
            [
                'indicador_id' => 35,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            //Indicador 36
            [
                'indicador_id' => 36,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            //Indicador 37
            [
                'indicador_id' => 37,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            //Indicador 38
            [
                'indicador_id' => 38,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 38,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 39
            [
                'indicador_id' => 39,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            //Indicador 40
            [
                'indicador_id' => 40,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            //Indicador 41
            [
                'indicador_id' => 41,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            //Indicador 42
            [
                'indicador_id' => 42,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 42,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 43
            [
                'indicador_id' => 43,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 43,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 44
            [
                'indicador_id' => 44,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 44,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 45
            [
                'indicador_id' => 45,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 45,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 46
            [
                'indicador_id' => 46,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 46,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 47
            [
                'indicador_id' => 47,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 47,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 48
            [
                'indicador_id' => 48,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 48,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 49
            [
                'indicador_id' => 49,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 49,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 50
            [
                'indicador_id' => 50,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 50,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 51
            [
                'indicador_id' => 51,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 51,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 52
            [
                'indicador_id' => 52,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 52,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 53
            [
                'indicador_id' => 53,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 53,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 54
            [
                'indicador_id' => 54,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 54,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 55
            [
                'indicador_id' => 55,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 55,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 56
            [
                'indicador_id' => 56,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 56,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 56,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 57
            [
                'indicador_id' => 57,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 57,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 57,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 58
            [
                'indicador_id' => 58,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 58,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 58,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 59
            [
                'indicador_id' => 59,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 59,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 59,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 60
            [
                'indicador_id' => 60,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 60,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 60,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 61
            [
                'indicador_id' => 61,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 61,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 61,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 62
            [
                'indicador_id' => 62,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 62,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 62,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 63
            [
                'indicador_id' => 63,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 63,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 63,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 64
            [
                'indicador_id' => 64,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 64,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 64,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ],
            //Indicador 65
            [
                'indicador_id' => 65,
                'indicadorable_type' => 'App\\Models\\Facultad',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 65,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 1
            ],
            [
                'indicador_id' => 65,
                'indicadorable_type' => 'App\\Models\\Escuela',
                'indicadorable_id' => 2
            ]
        ];

        \App\Models\Indicadorable::insert($indicadores);
    }
}
