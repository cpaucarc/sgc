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
                'id' => 1,
                'nombre' => 'Agronomía',
                'abrev' => 'AGN',
                'depto_id' => 51,
                'facultad_id' => 2,
                'uuid' => Str::uuid()
            ], // 1
            [
                'id' => 2,
                'nombre' => 'Ingeniería de Industrias Alimentarias',
                'abrev' => 'IIA',
                'depto_id' => null,
                'facultad_id' => 4,
                'uuid' => Str::uuid()
            ], // 2
            [
                'id' => 3,
                'nombre' => 'Ingeniería Agrícola',
                'abrev' => 'IAG',
                'depto_id' => 41,
                'facultad_id' => 2,
                'uuid' => Str::uuid()
            ], // 3
            [
                'id' => 4,
                'nombre' => 'Estadística e Informática',
                'abrev' => 'EEI',
                'depto_id' => 68,
                'facultad_id' => 1,
                'uuid' => Str::uuid()
            ], // 4
            [
                'id' => 5,
                'nombre' => 'Matemática',
                'abrev' => 'MAT',
                'depto_id' => 56,
                'facultad_id' => 1,
                'uuid' => Str::uuid()
            ], // 5
            [
                'id' => 6,
                'nombre' => 'Ingeniería Ambiental',
                'abrev' => 'IAM',
                'depto_id' => 44, // El depto es Ciencias del Ambiente
                'facultad_id' => 5,
                'uuid' => Str::uuid()
            ], // 6
            [
                'id' => 7,
                'nombre' => 'Ingeniería Sanitaria',
                'abrev' => 'ISA',
                'depto_id' => null,
                'facultad_id' => 5,
                'uuid' => Str::uuid()
            ], // 7
            [
                'id' => 8,
                'nombre' => 'Ingeniería de Minas',
                'abrev' => 'IMN',
                'depto_id' => 43,
                'facultad_id' => 6,
                'uuid' => Str::uuid()
            ], // 8
            [
                'id' => 9,
                'nombre' => 'Ingeniería Civil',
                'abrev' => 'ICV',
                'depto_id' => 42,
                'facultad_id' => 7,
                'uuid' => Str::uuid()
            ], // 9
            [
                'id' => 10,
                'nombre' => 'Obstetricia',
                'abrev' => 'OBS',
                'depto_id' => 53,
                'facultad_id' => 8,
                'uuid' => Str::uuid()
            ], // 10
            [
                'id' => 11,
                'nombre' => 'Enfermería',
                'abrev' => 'ENF',
                'depto_id' => 54,
                'facultad_id' => 8,
                'uuid' => Str::uuid()
            ], // 11
            [
                'id' => 12,
                'nombre' => 'Economía',
                'abrev' => 'ECN',
                'depto_id' => 61,
                'facultad_id' => 12,
                'uuid' => Str::uuid()
            ], // 12
            [
                'id' => 13,
                'nombre' => 'Administración',
                'abrev' => 'ADM',
                'depto_id' => 46,
                'facultad_id' => 3,
                'uuid' => Str::uuid()
            ], // 13
            [
                'id' => 14,
                'nombre' => 'Contabilidad',
                'abrev' => 'CTB',
                'depto_id' => 45,
                'facultad_id' => 12,
                'uuid' => Str::uuid()
            ], // 14
            [
                'id' => 15,
                'nombre' => 'Turismo',
                'abrev' => 'TUR',
                'depto_id' => 46,
                'facultad_id' => 3,
                'uuid' => Str::uuid()
            ], // 15
            [
                'id' => 16,
                'nombre' => 'Derecho y Ciencias Políticas',
                'abrev' => 'DCP',
                'depto_id' => 48,
                'facultad_id' => 10,
                'uuid' => Str::uuid()
            ], // 16
            [
                'id' => 19,
                'nombre' => 'Educación: Primaria y Educación Bilingüe Intercultural',
                'abrev' => 'PEBI',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 19
            [
                'id' => 21,
                'nombre' => 'Educación: Matemática e Informática',
                'abrev' => 'MINF',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 21
            [
                'id' => 24,
                'nombre' => 'Ciencias de la Comunicación',
                'abrev' => 'CCM',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 24
            [
                'id' => 25,
                'nombre' => 'Ingeniería de Sistemas e Informática',
                'abrev' => 'ISI',
                'depto_id' => null,
                'facultad_id' => 1,
                'uuid' => Str::uuid()
            ], // 25
            [
                'id' => 28,
                'nombre' => 'Educación: Comunicación, Lingüística y Literatura',
                'abrev' => 'CLL',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 28
            [
                'id' => 29,
                'nombre' => 'Educación: Lengua Extranjera: Inglés',
                'abrev' => 'LEI',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 29
            [
                'id' => 34,
                'nombre' => 'Arqueología',
                'abrev' => 'AQG',
                'depto_id' => null,
                'facultad_id' => 11,
                'uuid' => Str::uuid()
            ], // 34
            [
                'id' => 35,
                'nombre' => 'Ingeniería Industrial',
                'abrev' => 'IND',
                'depto_id' => null,
                'facultad_id' => 4,
                'uuid' => Str::uuid()
            ], // 35
            [
                'id' => 36,
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
