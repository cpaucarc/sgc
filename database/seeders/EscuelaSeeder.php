<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EscuelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $escuelas = [
            [
                'nombre' => 'Agronomía',
                'abrev' => 'AGN',
                'facultad_id' => 2,
                'uuid' => Str::uuid()
            ], // 1
            [
                'nombre' => 'Ingenieria de Industrias Alimentarias',
                'abrev' => 'IIA',
                'facultad_id' => 4,
                'uuid' => Str::uuid()
            ], // 2
            [
                'nombre' => 'Ingenieria Agricola',
                'abrev' => 'IAG',
                'facultad_id' => 2,
                'uuid' => Str::uuid()
            ], // 3
            [
                'nombre' => 'Estadistica e Informatica',
                'abrev' => 'EEI',
                'facultad_id' => 1,
                'uuid' => Str::uuid()
            ], // 4
            [
                'nombre' => 'Matematica',
                'abrev' => 'MAT',
                'facultad_id' => 1,
                'uuid' => Str::uuid()
            ], // 5
            [
                'nombre' => 'Ingenieria Ambiental',
                'abrev' => 'IAM',
                'facultad_id' => 5,
                'uuid' => Str::uuid()
            ], // 6
            [
                'nombre' => 'Ingenieria Sanitaria',
                'abrev' => 'ISA',
                'facultad_id' => 5,
                'uuid' => Str::uuid()
            ], // 7
            [
                'nombre' => 'Ingenieria de Minas',
                'abrev' => 'IMN',
                'facultad_id' => 6,
                'uuid' => Str::uuid()
            ], // 8
            [
                'nombre' => 'Ingenieria Civil',
                'abrev' => 'ICV',
                'facultad_id' => 7,
                'uuid' => Str::uuid()
            ], // 9
            [
                'nombre' => 'Obstetricia',
                'abrev' => 'OBS',
                'facultad_id' => 8,
                'uuid' => Str::uuid()
            ], // 10
            [
                'nombre' => 'Enfermeria',
                'abrev' => 'ENF',
                'facultad_id' => 8,
                'uuid' => Str::uuid()
            ], // 11
            [
                'nombre' => 'Economia',
                'abrev' => 'ECN',
                'facultad_id' => 12,
                'uuid' => Str::uuid()
            ], // 12
            [
                'nombre' => 'Administracion',
                'abrev' => 'ADM',
                'facultad_id' => 3,
                'uuid' => Str::uuid()
            ], // 13
            [
                'nombre' => 'Contabilidad',
                'abrev' => 'CTB',
                'facultad_id' => 12,
                'uuid' => Str::uuid()
            ], // 14
            [
                'nombre' => 'Turismo',
                'abrev' => 'TUR',
                'facultad_id' => 3,
                'uuid' => Str::uuid()
            ], // 15
            [
                'nombre' => 'Derecho y Ciencias Politicas',
                'abrev' => 'DCP',
                'facultad_id' => 10,
                'uuid' => Str::uuid()
            ], // 16
            [
                'nombre' => 'Periodismo',
                'abrev' => 'PRD',
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 17
            [
                'nombre' => 'Educación: Primaria y Educación Bilingüe Intercultural',
                'abrev' => 'PEBI',
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 18
            [
                'nombre' => 'Educación: Primaria y Educación Bilingüe Intercultural2',
                'abrev' => 'PEBI2',
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 19
            [
                'nombre' => 'Lengua y Literatura',
                'abrev' => 'LLT',
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 20
            [
                'nombre' => 'Educacion: Matematica e Informatica',
                'abrev' => 'MINF',
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 21
            [
                'nombre' => 'Fisica y Quimica',
                'abrev' => 'FQM',
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 22
            [
                'nombre' => 'Primaria',
                'abrev' => 'PMR',
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 23
            [
                'nombre' => 'Ciencias de la Comunicacion',
                'abrev' => 'CCM',
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 24
            [
                'nombre' => 'Ingenieria de Sistemas e Informática',
                'abrev' => 'ISI',
                'facultad_id' => 1,
                'uuid' => Str::uuid()
            ], // 25
            [
                'nombre' => 'Educacion: Comunicacion, Lingüistica y Literatura',
                'abrev' => 'CLL',
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 26
            [
                'nombre' => 'Educacion: Matematica e Informatica2',
                'abrev' => 'MINF2',
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 27
            [
                'nombre' => 'Educacion: Comunicacion, Lingüistica y Literatura2',
                'abrev' => 'CLL2',
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 28
            [
                'nombre' => 'Educacion: Lengua Extranjera: Ingles',
                'abrev' => 'LEI',
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 29
            [
                'nombre' => '-',
                'abrev' => '-',
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 30 VACIO
            [
                'nombre' => '--',
                'abrev' => '--',
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 31 VACIO
            [
                'nombre' => '---',
                'abrev' => '---',
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 32 VACIO
            [
                'nombre' => 'Educacion',
                'abrev' => 'EDC',
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 33
            [
                'nombre' => 'Arqueología',
                'abrev' => 'AQG',
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 34
            [
                'nombre' => 'Ingenieria Industrial',
                'abrev' => 'IND',
                'facultad_id' => 4,
                'uuid' => Str::uuid()
            ], // 35
            [
                'nombre' => 'Arquitectura y Urbanismo',
                'abrev' => 'AQT',
                'facultad_id' => 7,
                'uuid' => Str::uuid()
            ], // 36
        ];

        \App\Models\Escuela::insert($escuelas);
    }
}
