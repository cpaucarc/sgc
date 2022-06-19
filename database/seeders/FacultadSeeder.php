<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FacultadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facultades = [
            [
                'nombre' => 'Ciencias',
                'abrev' => 'FC',
                'direccion' => 'Av. Universitaria N° 115',
                'uuid' => Str::uuid()
            ], // 1
            [
                'nombre' => 'Ciencias Agrarias',
                'abrev' => 'FCA',
                'direccion' => 'Av. Universitaria N° 115',
                'uuid' => Str::uuid()
            ], // 2
            [
                'nombre' => 'Administración y Turismo',
                'abrev' => 'FAT',
                'direccion' => 'Av. Universitaria N° 115',
                'uuid' => Str::uuid()
            ], // 3
            [
                'nombre' => 'Ingeniería Industrial Alimentarias',
                'abrev' => 'FIIA',
                'direccion' => 'Av. Universitaria N° 115',
                'uuid' => Str::uuid()
            ], // 4
            [
                'nombre' => 'Ciencias del Ambiente',
                'abrev' => 'FCAM',
                'direccion' => 'Av. Universitaria N° 115',
                'uuid' => Str::uuid()
            ], // 5
            [
                'nombre' => 'Ingeniería de Minas, Geología y Metalurgia',
                'abrev' => 'FIMGM',
                'direccion' => 'Av. Universitaria N° 115',
                'uuid' => Str::uuid()
            ], // 6
            [
                'nombre' => 'Ingeniería Civil',
                'abrev' => 'FIC',
                'direccion' => 'Av. Universitaria N° 115',
                'uuid' => Str::uuid()
            ], // 7
            [
                'nombre' => 'Ciencias Médicas',
                'abrev' => 'FCM',
                'direccion' => 'Av. Agustín Gamarra N° 1227',
                'uuid' => Str::uuid()
            ], // 8
            [
                'nombre' => '--',
                'abrev' => '--',
                'direccion' => '--',
                'uuid' => Str::uuid()
            ], // 9 VACIO
            [
                'nombre' => 'Derecho y Ciencias Políticas',
                'abrev' => 'FDCCPP',
                'direccion' => 'Av. Inés Huaylas, Huaraz N° 02001',
                'uuid' => Str::uuid()
            ], // 10
            [
                'nombre' => 'Ciencias Sociales, Educación y de la Comunicación',
                'abrev' => 'FCSEC',
                'direccion' => 'Av. Universitaria N° 115',
                'uuid' => Str::uuid()
            ], // 11
            [
                'nombre' => 'Economía y Contabilidad',
                'abrev' => 'FEC',
                'direccion' => 'Av. Universitaria N° 115',
                'uuid' => Str::uuid()
            ], // 12
        ];

        \App\Models\Facultad::insert($facultades);
    }
}
