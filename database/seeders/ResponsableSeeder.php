<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResponsableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $responsables = [
            //Enseñanza Aprendizaje
            [
                'actividad_id' => 1,
                'entidad_id' => 1
            ], //id:1
            [
                'actividad_id' => 1,
                'entidad_id' => 2
            ], //id:2
            [
                'actividad_id' => 2,
                'entidad_id' => 6
            ], //id:3
            [
                'actividad_id' => 2,
                'entidad_id' => 7
            ], //id:4
            [
                'actividad_id' => 3,
                'entidad_id' => 1
            ], //id:5
            [
                'actividad_id' => 3,
                'entidad_id' => 2
            ], //id:6
            [
                'actividad_id' => 4,
                'entidad_id' => 6
            ], //id:7
            [
                'actividad_id' => 4,
                'entidad_id' => 7
            ], //id:8
            [
                'actividad_id' => 5,
                'entidad_id' => 6
            ], //id:9
            [
                'actividad_id' => 5,
                'entidad_id' => 7
            ], //id:10
            [
                'actividad_id' => 6,
                'entidad_id' => 6
            ], //id:11
            [
                'actividad_id' => 6,
                'entidad_id' => 7
            ], //id:12
            [
                'actividad_id' => 7,
                'entidad_id' => 1
            ], //id:13
            [
                'actividad_id' => 7,
                'entidad_id' => 2
            ], //id:14
            [
                'actividad_id' => 7,
                'entidad_id' => 3
            ], //id:15
            [
                'actividad_id' => 7,
                'entidad_id' => 4
            ], //id:16
            [
                'actividad_id' => 8,
                'entidad_id' => 1
            ], //id:17
            [
                'actividad_id' => 8,
                'entidad_id' => 2
            ], //id:18
            [
                'actividad_id' => 8,
                'entidad_id' => 6
            ], //id:19
            [
                'actividad_id' => 8,
                'entidad_id' => 7
            ], //id:20
            [
                'actividad_id' => 9,
                'entidad_id' => 1
            ], //id:21
            [
                'actividad_id' => 9,
                'entidad_id' => 2
            ], //id:22
            [
                'actividad_id' => 10,
                'entidad_id' => 1
            ], //id:23
            [
                'actividad_id' => 10,
                'entidad_id' => 2
            ], //id:24
            [
                'actividad_id' => 11,
                'entidad_id' => 1
            ], //id:24
            [
                'actividad_id' => 11,
                'entidad_id' => 2
            ], //id:26
            //Gestion Calidad
            [
                'actividad_id' => 12,
                'entidad_id' => 1
            ], //id:27
            [
                'actividad_id' => 12,
                'entidad_id' => 2
            ], //id:28
            [
                'actividad_id' => 13,
                'entidad_id' => 19
            ], //id:29
            [
                'actividad_id' => 14,
                'entidad_id' => 23
            ], //id:30
            [
                'actividad_id' => 14,
                'entidad_id' => 24
            ], //id:31
            [
                'actividad_id' => 15,
                'entidad_id' => 23
            ], //id:32
            [
                'actividad_id' => 15,
                'entidad_id' => 24
            ], //id:33
            [
                'actividad_id' => 16,
                'entidad_id' => 23
            ], //id:34
            [
                'actividad_id' => 16,
                'entidad_id' => 24
            ], //id:35
            [
                'actividad_id' => 17,
                'entidad_id' => 20
            ], //id:36
            [
                'actividad_id' => 18,
                'entidad_id' => 23
            ], //id:37
            [
                'actividad_id' => 18,
                'entidad_id' => 24
            ], //id:38
            [
                'actividad_id' => 19,
                'entidad_id' => 23
            ], //id:39
            [
                'actividad_id' => 19,
                'entidad_id' => 24
            ], //id:40
            [
                'actividad_id' => 20,
                'entidad_id' => 25
            ], //id:41
            [
                'actividad_id' => 21,
                'entidad_id' => 20
            ], //id:42
            [
                'actividad_id' => 22,
                'entidad_id' => 23
            ], //id:43
            [
                'actividad_id' => 22,
                'entidad_id' => 24
            ], //id:44
            [
                'actividad_id' => 23,
                'entidad_id' => 23
            ], //id:45
            [
                'actividad_id' => 23,
                'entidad_id' => 24
            ], //id:46
            [
                'actividad_id' => 24,
                'entidad_id' => 22
            ], //id:47
            [
                'actividad_id' => 25,
                'entidad_id' => 9
            ], //id:48
            [
                'actividad_id' => 26,
                'entidad_id' => 9
            ], //id:49
            [
                'actividad_id' => 27,
                'entidad_id' => 9
            ], //id:50

            //Plan de estudios
            [
                'actividad_id' => 28,
                'entidad_id' => 1
            ], //id:51
            [
                'actividad_id' => 28,
                'entidad_id' => 2
            ], //id:52
            [
                'actividad_id' => 29,
                'entidad_id' => 19
            ], //id:53
            [
                'actividad_id' => 30,
                'entidad_id' => 30
            ], //id:54
            [
                'actividad_id' => 31,
                'entidad_id' => 19
            ], //id:55
            [
                'actividad_id' => 32,
                'entidad_id' => 30
            ], //id:56
            [
                'actividad_id' => 33,
                'entidad_id' => 1
            ], //id:57
            [
                'actividad_id' => 33,
                'entidad_id' => 2
            ], //id:58
            [
                'actividad_id' => 34,
                'entidad_id' => 30
            ], //id:59
            [
                'actividad_id' => 35,
                'entidad_id' => 31
            ], //id:60
            [
                'actividad_id' => 36,
                'entidad_id' => 19
            ], //id:61
            [
                'actividad_id' => 37,
                'entidad_id' => 31
            ], //id:62
            [
                'actividad_id' => 38,
                'entidad_id' => 15
            ], //id:63
            [
                'actividad_id' => 39,
                'entidad_id' => 19
            ], //id:64
            [
                'actividad_id' => 39,
                'entidad_id' => 29
            ], //id:65
            [
                'actividad_id' => 40,
                'entidad_id' => 1
            ], //id:66
            [
                'actividad_id' => 40,
                'entidad_id' => 2
            ], //id:67
            [
                'actividad_id' => 41,
                'entidad_id' => 1
            ], //id:68
            [
                'actividad_id' => 41,
                'entidad_id' => 2
            ], //id:69
            [
                'actividad_id' => 42,
                'entidad_id' => 1
            ], //id:70
            [
                'actividad_id' => 42,
                'entidad_id' => 2
            ], //id:71
            [
                'actividad_id' => 43,
                'entidad_id' => 1
            ], //id:72
            [
                'actividad_id' => 43,
                'entidad_id' => 2
            ], //id:73
            [
                'actividad_id' => 44,
                'entidad_id' => 1
            ], //id:74
            [
                'actividad_id' => 44,
                'entidad_id' => 2
            ], //id:75
            [
                'actividad_id' => 45,
                'entidad_id' => 1
            ], //id:76
            [
                'actividad_id' => 45,
                'entidad_id' => 2
            ], //id:77
            [
                'actividad_id' => 46,
                'entidad_id' => 1
            ], //id:78
            [
                'actividad_id' => 46,
                'entidad_id' => 2
            ], //id:79
            [
                'actividad_id' => 47,
                'entidad_id' => 1
            ], //id:80
            [
                'actividad_id' => 47,
                'entidad_id' => 2
            ], //id:81
        ];

        \App\Models\Responsable::insert($responsables);
    }
}
