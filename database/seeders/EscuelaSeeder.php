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
                'depto_id' => 51,
                'facultad_id' => 2,
                'uuid' => Str::uuid()
            ], // 1
            [
                'nombre' => 'Ingenieria de Industrias Alimentarias',
                'abrev' => 'IIA',
                'depto_id' => null,
                'facultad_id' => 4,
                'uuid' => Str::uuid()
            ], // 2
            [
                'nombre' => 'Ingenieria Agricola',
                'abrev' => 'IAG',
                'depto_id' => 41,
                'facultad_id' => 2,
                'uuid' => Str::uuid()
            ], // 3
            [
                'nombre' => 'Estadistica e Informatica',
                'abrev' => 'EEI',
                'depto_id' => 68,
                'facultad_id' => 1,
                'uuid' => Str::uuid()
            ], // 4
            [
                'nombre' => 'Matematica',
                'abrev' => 'MAT',
                'depto_id' => 56,
                'facultad_id' => 1,
                'uuid' => Str::uuid()
            ], // 5
            [
                'nombre' => 'Ingenieria Ambiental',
                'abrev' => 'IAM',
                'depto_id' => 44, // El depto es Ciencias del Ambiente
                'facultad_id' => 5,
                'uuid' => Str::uuid()
            ], // 6
            [
                'nombre' => 'Ingenieria Sanitaria',
                'abrev' => 'ISA',
                'depto_id' => null,
                'facultad_id' => 5,
                'uuid' => Str::uuid()
            ], // 7
            [
                'nombre' => 'Ingenieria de Minas',
                'abrev' => 'IMN',
                'depto_id' => 43,
                'facultad_id' => 6,
                'uuid' => Str::uuid()
            ], // 8
            [
                'nombre' => 'Ingenieria Civil',
                'abrev' => 'ICV',
                'depto_id' => 42,
                'facultad_id' => 7,
                'uuid' => Str::uuid()
            ], // 9
            [
                'nombre' => 'Obstetricia',
                'abrev' => 'OBS',
                'depto_id' => 53,
                'facultad_id' => 8,
                'uuid' => Str::uuid()
            ], // 10
            [
                'nombre' => 'Enfermeria',
                'abrev' => 'ENF',
                'depto_id' => 54,
                'facultad_id' => 8,
                'uuid' => Str::uuid()
            ], // 11
            [
                'nombre' => 'Economia',
                'abrev' => 'ECN',
                'depto_id' => 61,
                'facultad_id' => 12,
                'uuid' => Str::uuid()
            ], // 12
            [
                'nombre' => 'Administracion',
                'abrev' => 'ADM',
                'depto_id' => 46,
                'facultad_id' => 3,
                'uuid' => Str::uuid()
            ], // 13
            [
                'nombre' => 'Contabilidad',
                'abrev' => 'CTB',
                'depto_id' => 45,
                'facultad_id' => 12,
                'uuid' => Str::uuid()
            ], // 14
            [
                'nombre' => 'Turismo',
                'abrev' => 'TUR',
                'depto_id' => 46,
                'facultad_id' => 3,
                'uuid' => Str::uuid()
            ], // 15
            [
                'nombre' => 'Derecho y Ciencias Politicas',
                'abrev' => 'DCP',
                'depto_id' => 48,
                'facultad_id' => 10,
                'uuid' => Str::uuid()
            ], // 16
            [
                'nombre' => 'Periodismo',
                'abrev' => 'PRD',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 17
            [
                'nombre' => 'Educación: Primaria y Educación Bilingüe Intercultural',
                'abrev' => 'PEBI',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 18
            [
                'nombre' => 'Educación: Primaria y Educación Bilingüe Intercultural2',
                'abrev' => 'PEBI2',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 19
            [
                'nombre' => 'Lengua y Literatura',
                'abrev' => 'LLT',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 20
            [
                'nombre' => 'Educacion: Matematica e Informatica',
                'abrev' => 'MINF',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 21
            [
                'nombre' => 'Fisica y Quimica',
                'abrev' => 'FQM',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 22
            [
                'nombre' => 'Primaria',
                'abrev' => 'PMR',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 23
            [
                'nombre' => 'Ciencias de la Comunicacion',
                'abrev' => 'CCM',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 24
            [
                'nombre' => 'Ingenieria de Sistemas e Informática',
                'abrev' => 'ISI',
                'depto_id' => null,
                'facultad_id' => 1,
                'uuid' => Str::uuid()
            ], // 25
            [
                'nombre' => 'Educacion: Comunicacion, Lingüistica y Literatura',
                'abrev' => 'CLL',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 26
            [
                'nombre' => 'Educacion: Matematica e Informatica2',
                'abrev' => 'MINF2',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 27
            [
                'nombre' => 'Educacion: Comunicacion, Lingüistica y Literatura2',
                'abrev' => 'CLL2',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 28
            [
                'nombre' => 'Educacion: Lengua Extranjera: Ingles',
                'abrev' => 'LEI',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 29
            [
                'nombre' => '-',
                'abrev' => '-',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 30 VACIO
            [
                'nombre' => '--',
                'abrev' => '--',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 31 VACIO
            [
                'nombre' => '---',
                'abrev' => '---',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 32 VACIO
            [
                'nombre' => 'Educacion',
                'abrev' => 'EDC',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 33
            [
                'nombre' => 'Arqueología',
                'abrev' => 'AQG',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 34
            [
                'nombre' => 'Ingenieria Industrial',
                'abrev' => 'IND',
                'depto_id' => null,
                'facultad_id' => 4,
                'uuid' => Str::uuid()
            ], // 35
            [
                'nombre' => 'Arquitectura y Urbanismo',
                'abrev' => 'AQT',
                'depto_id' => null,
                'facultad_id' => 7,
                'uuid' => Str::uuid()
            ], // 36
        ];

        \App\Models\Escuela::insert($escuelas);
    }
}
