<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clientes = [
            /* Actividad 1 */
            // Salida 1
            [
                'responsable_id' => 1,
                'salida_id' => 1,
                'entidad_id' => 1,
            ], // Director de Enfermeria
            [
                'responsable_id' => 1,
                'salida_id' => 1,
                'entidad_id' => 3,
            ], // Director de Enfermeria
            [
                'responsable_id' => 1,
                'salida_id' => 1,
                'entidad_id' => 8,
            ], // Director de Enfermeria
            [
                'responsable_id' => 2,
                'salida_id' => 1,
                'entidad_id' => 2,
            ], // Director de Obstetricia
            [
                'responsable_id' => 2,
                'salida_id' => 1,
                'entidad_id' => 4,
            ], // Director de Obstetricia
            [
                'responsable_id' => 2,
                'salida_id' => 1,
                'entidad_id' => 8,
            ], // Director de Obstetricia

            /* Actividad 2 */
            // Salida 2
            [
                'responsable_id' => 3,
                'salida_id' => 2,
                'entidad_id' => 1,
            ], // Docente Enfermeria
            [
                'responsable_id' => 3,
                'salida_id' => 2,
                'entidad_id' => 3
            ], // Docente Enfermeria
            [
                'responsable_id' => 3,
                'salida_id' => 2,
                'entidad_id' => 6,
            ], // Docente Enfermeria
            [
                'responsable_id' => 3,
                'salida_id' => 2,
                'entidad_id' => 5,
            ], // Docente Enfermeria
            [
                'responsable_id' => 4,
                'salida_id' => 2,
                'entidad_id' => 2,
            ], // Docente Obstetricia
            [
                'responsable_id' => 4,
                'salida_id' => 2,
                'entidad_id' => 4
            ], // Docente Obstetricia
            [
                'responsable_id' => 4,
                'salida_id' => 2,
                'entidad_id' => 7,
            ], // Docente Obstetricia
            [
                'responsable_id' => 4,
                'salida_id' => 2,
                'entidad_id' => 5,
            ], // Docente Obstetricia

            // Salida 3
            [
                'responsable_id' => 3,
                'salida_id' => 3,
                'entidad_id' => 1,
            ], // Docente Enfermeria
            [
                'responsable_id' => 3,
                'salida_id' => 3,
                'entidad_id' => 3
            ], // Docente Enfermeria
            [
                'responsable_id' => 3,
                'salida_id' => 3,
                'entidad_id' => 6,
            ], // Docente Enfermeria
            [
                'responsable_id' => 3,
                'salida_id' => 3,
                'entidad_id' => 13,
            ], // Docente Enfermeria
            [
                'responsable_id' => 4,
                'salida_id' => 3,
                'entidad_id' => 2,
            ], // Docente Obstetricia
            [
                'responsable_id' => 4,
                'salida_id' => 3,
                'entidad_id' => 4
            ], // Docente Obstetricia
            [
                'responsable_id' => 4,
                'salida_id' => 3,
                'entidad_id' => 7,
            ], // Docente Obstetricia
            [
                'responsable_id' => 4,
                'salida_id' => 3,
                'entidad_id' => 14,
            ], // Docente Obstetricia

            /* Actividad 3 */
            // Salida 4
            [
                'responsable_id' => 5,
                'salida_id' => 4,
                'entidad_id' => 1,
            ], // Director Escuela Enfermeria
            [
                'responsable_id' => 5,
                'salida_id' => 4,
                'entidad_id' => 8,
            ], // Director Escuela Enfermeria
            [
                'responsable_id' => 6,
                'salida_id' => 4,
                'entidad_id' => 2,
            ], // Director Escuela Obstetricia
            [
                'responsable_id' => 6,
                'salida_id' => 4,
                'entidad_id' => 8,
            ], // Director Escuela Obstetricia

            /* Actividad 4 */
            // Salida 5
            [
                'responsable_id' => 7,
                'salida_id' => 5,
                'entidad_id' => 1,
            ], //Docente Enfermeria
            [
                'responsable_id' => 7,
                'salida_id' => 5,
                'entidad_id' => 3,
            ], //Docente Enfermeria
            [
                'responsable_id' => 7,
                'salida_id' => 5,
                'entidad_id' => 6,
            ], //Docente Enfermeria
            [
                'responsable_id' => 7,
                'salida_id' => 5,
                'entidad_id' => 13,
            ], //Docente Enfermeria
            [
                'responsable_id' => 8,
                'salida_id' => 5,
                'entidad_id' => 2,
            ], //Docente Obstetricia
            [
                'responsable_id' => 8,
                'salida_id' => 5,
                'entidad_id' => 4,
            ], //Docente Obstetricia
            [
                'responsable_id' => 8,
                'salida_id' => 5,
                'entidad_id' => 7,
            ], //Docente Obstetricia
            [
                'responsable_id' => 8,
                'salida_id' => 5,
                'entidad_id' => 14,
            ], //Docente Obstetricia

            // Salida 6
            [
                'responsable_id' => 7,
                'salida_id' => 6,
                'entidad_id' => 1,
            ], //Docente Enfermeria
            [
                'responsable_id' => 7,
                'salida_id' => 6,
                'entidad_id' => 3,
            ], //Docente Enfermeria
            [
                'responsable_id' => 7,
                'salida_id' => 6,
                'entidad_id' => 6,
            ], //Docente Enfermeria
            [
                'responsable_id' => 7,
                'salida_id' => 6,
                'entidad_id' => 13,
            ], //Docente Enfermeria
            [
                'responsable_id' => 8,
                'salida_id' => 6,
                'entidad_id' => 2,
            ], //Docente Obstetricia
            [
                'responsable_id' => 8,
                'salida_id' => 6,
                'entidad_id' => 4,
            ], //Docente Obstetricia
            [
                'responsable_id' => 8,
                'salida_id' => 6,
                'entidad_id' => 7,
            ], //Docente Obstetricia
            [
                'responsable_id' => 8,
                'salida_id' => 6,
                'entidad_id' => 14,
            ], //Docente Obstetricia

            // Salida 7
            [
                'responsable_id' => 7,
                'salida_id' => 7,
                'entidad_id' => 1,
            ], //Docente Enfermeria
            [
                'responsable_id' => 7,
                'salida_id' => 7,
                'entidad_id' => 3,
            ], //Docente Enfermeria
            [
                'responsable_id' => 7,
                'salida_id' => 7,
                'entidad_id' => 6,
            ], //Docente Enfermeria
            [
                'responsable_id' => 7,
                'salida_id' => 7,
                'entidad_id' => 13,
            ], //Docente Enfermeria
            [
                'responsable_id' => 8,
                'salida_id' => 7,
                'entidad_id' => 2,
            ], //Docente Obstetricia
            [
                'responsable_id' => 8,
                'salida_id' => 7,
                'entidad_id' => 4,
            ], //Docente Obstetricia
            [
                'responsable_id' => 8,
                'salida_id' => 7,
                'entidad_id' => 7,
            ], //Docente Obstetricia
            [
                'responsable_id' => 8,
                'salida_id' => 7,
                'entidad_id' => 14,
            ], //Docente Obstetricia

            // Salida 8
            [
                'responsable_id' => 7,
                'salida_id' => 8,
                'entidad_id' => 1,
            ], //Docente Enfermeria
            [
                'responsable_id' => 7,
                'salida_id' => 8,
                'entidad_id' => 3,
            ], //Docente Enfermeria
            [
                'responsable_id' => 7,
                'salida_id' => 8,
                'entidad_id' => 6,
            ], //Docente Enfermeria
            [
                'responsable_id' => 7,
                'salida_id' => 8,
                'entidad_id' => 13,
            ], //Docente Enfermeria
            [
                'responsable_id' => 8,
                'salida_id' => 8,
                'entidad_id' => 2,
            ], //Docente Obstetricia
            [
                'responsable_id' => 8,
                'salida_id' => 8,
                'entidad_id' => 4,
            ], //Docente Obstetricia
            [
                'responsable_id' => 8,
                'salida_id' => 8,
                'entidad_id' => 7,
            ], //Docente Obstetricia
            [
                'responsable_id' => 8,
                'salida_id' => 8,
                'entidad_id' => 14,
            ], //Docente Obstetricia

            // Salida 9
            [
                'responsable_id' => 7,
                'salida_id' => 9,
                'entidad_id' => 1,
            ], //Docente Enfermeria
            [
                'responsable_id' => 7,
                'salida_id' => 9,
                'entidad_id' => 3,
            ], //Docente Enfermeria
            [
                'responsable_id' => 7,
                'salida_id' => 9,
                'entidad_id' => 6,
            ], //Docente Enfermeria
            [
                'responsable_id' => 8,
                'salida_id' => 9,
                'entidad_id' => 2,
            ], //Docente Obstetricia
            [
                'responsable_id' => 8,
                'salida_id' => 9,
                'entidad_id' => 4,
            ], //Docente Obstetricia
            [
                'responsable_id' => 8,
                'salida_id' => 9,
                'entidad_id' => 7,
            ], //Docente Obstetricia

            // Salida 10
            [
                'responsable_id' => 7,
                'salida_id' => 10,
                'entidad_id' => 1,
            ], //Docente Enfermeria
            [
                'responsable_id' => 7,
                'salida_id' => 10,
                'entidad_id' => 3,
            ], //Docente Enfermeria
            [
                'responsable_id' => 7,
                'salida_id' => 10,
                'entidad_id' => 6,
            ], //Docente Enfermeria
            [
                'responsable_id' => 8,
                'salida_id' => 10,
                'entidad_id' => 2,
            ], //Docente Obstetricia
            [
                'responsable_id' => 8,
                'salida_id' => 10,
                'entidad_id' => 4,
            ], //Docente Obstetricia
            [
                'responsable_id' => 8,
                'salida_id' => 10,
                'entidad_id' => 7,
            ], //Docente Obstetricia

            /* Actividad 5 */
            // Salida 11
            [
                'responsable_id' => 9,
                'salida_id' => 11,
                'entidad_id' => 1,
            ], //Docente Enfermeria
            [
                'responsable_id' => 9,
                'salida_id' => 11,
                'entidad_id' => 3,
            ], //Docente Enfermeria
            [
                'responsable_id' => 9,
                'salida_id' => 11,
                'entidad_id' => 6,
            ], //Docente Enfermeria
            [
                'responsable_id' => 10,
                'salida_id' => 11,
                'entidad_id' => 2,
            ], //Docente Obstetricia
            [
                'responsable_id' => 10,
                'salida_id' => 11,
                'entidad_id' => 4,
            ], //Docente Obstetricia
            [
                'responsable_id' => 10,
                'salida_id' => 11,
                'entidad_id' => 7,
            ], //Docente Obstetricia

            /* Actividad 6 */
            // Salida 12
            [
                'responsable_id' => 11,
                'salida_id' => 12,
                'entidad_id' => 1,
            ], //Docente Enfermeria
            [
                'responsable_id' => 11,
                'salida_id' => 12,
                'entidad_id' => 3,
            ], //Docente Enfermeria
            [
                'responsable_id' => 11,
                'salida_id' => 12,
                'entidad_id' => 6,
            ], //Docente Enfermeria
            [
                'responsable_id' => 11,
                'salida_id' => 12,
                'entidad_id' => 13,
            ], //Docente Enfermeria
            [
                'responsable_id' => 12,
                'salida_id' => 12,
                'entidad_id' => 2,
            ], //Docente Obstetricia
            [
                'responsable_id' => 12,
                'salida_id' => 12,
                'entidad_id' => 4,
            ], //Docente Obstetricia
            [
                'responsable_id' => 12,
                'salida_id' => 12,
                'entidad_id' => 7,
            ], //Docente Obstetricia
            [
                'responsable_id' => 12,
                'salida_id' => 12,
                'entidad_id' => 14,
            ], //Docente Obstetricia

            /* Actividad 7 */
            // Salida 13
            [
                'responsable_id' => 13,
                'salida_id' => 13,
                'entidad_id' => 1,
            ], // Director Escuela Enfermeria
            [
                'responsable_id' => 13,
                'salida_id' => 13,
                'entidad_id' => 3
            ], // Director Escuela Enfermeria
            [
                'responsable_id' => 13,
                'salida_id' => 13,
                'entidad_id' => 6,
            ], // Director Escuela Enfermeria
            [
                'responsable_id' => 13,
                'salida_id' => 13,
                'entidad_id' => 5,
            ], // Director Escuela Enfermeria
            [
                'responsable_id' => 14,
                'salida_id' => 13,
                'entidad_id' => 2,
            ], // Director Escuela Obstetricia
            [
                'responsable_id' => 14,
                'salida_id' => 13,
                'entidad_id' => 4
            ], // Director Escuela Obstetricia
            [
                'responsable_id' => 14,
                'salida_id' => 13,
                'entidad_id' => 7,
            ], // Director Escuela Obstetricia
            [
                'responsable_id' => 14,
                'salida_id' => 13,
                'entidad_id' => 5,
            ], // Director Escuela Obstetricia

            [
                'responsable_id' => 15,
                'salida_id' => 13,
                'entidad_id' => 1,
            ], // Director Depto. Enfermeria
            [
                'responsable_id' => 15,
                'salida_id' => 13,
                'entidad_id' => 3
            ], // Director Depto. Enfermeria
            [
                'responsable_id' => 15,
                'salida_id' => 13,
                'entidad_id' => 6,
            ], // Director Depto. Enfermeria
            [
                'responsable_id' => 15,
                'salida_id' => 13,
                'entidad_id' => 5,
            ], // Director Depto. Enfermeria
            [
                'responsable_id' => 16,
                'salida_id' => 13,
                'entidad_id' => 2,
            ], // Director Depto. Obstetricia
            [
                'responsable_id' => 16,
                'salida_id' => 13,
                'entidad_id' => 4
            ], // Director Depto. Obstetricia
            [
                'responsable_id' => 16,
                'salida_id' => 13,
                'entidad_id' => 7,
            ], // Director Depto. Obstetricia
            [
                'responsable_id' => 16,
                'salida_id' => 13,
                'entidad_id' => 5,
            ], // Director Depto. Obstetricia

            /* Actividad 8 */
            // Salida 14
            [
                'responsable_id' => 17,
                'salida_id' => 14,
                'entidad_id' => 1,
            ], // Director Escuela Enfermeria
            [
                'responsable_id' => 17,
                'salida_id' => 14,
                'entidad_id' => 3
            ], // Director Escuela Enfermeria
            [
                'responsable_id' => 17,
                'salida_id' => 14,
                'entidad_id' => 6,
            ], // Director Escuela Enfermeria
            [
                'responsable_id' => 17,
                'salida_id' => 14,
                'entidad_id' => 5,
            ], // Director Escuela Enfermeria
            [
                'responsable_id' => 18,
                'salida_id' => 14,
                'entidad_id' => 2,
            ], // Director Escuela Obstetricia
            [
                'responsable_id' => 18,
                'salida_id' => 14,
                'entidad_id' => 4
            ], // Director Escuela Obstetricia
            [
                'responsable_id' => 18,
                'salida_id' => 14,
                'entidad_id' => 7,
            ], // Director Escuela Obstetricia
            [
                'responsable_id' => 18,
                'salida_id' => 14,
                'entidad_id' => 5,
            ], // Director Escuela Obstetricia

            [
                'responsable_id' => 19,
                'salida_id' => 14,
                'entidad_id' => 1,
            ], // Docente Enfermeria
            [
                'responsable_id' => 19,
                'salida_id' => 14,
                'entidad_id' => 3
            ], // Docente Enfermeria
            [
                'responsable_id' => 19,
                'salida_id' => 14,
                'entidad_id' => 6,
            ], // Docente Enfermeria
            [
                'responsable_id' => 19,
                'salida_id' => 14,
                'entidad_id' => 5,
            ], // Docente Enfermeria
            [
                'responsable_id' => 20,
                'salida_id' => 14,
                'entidad_id' => 2,
            ], // Docente Obstetricia
            [
                'responsable_id' => 20,
                'salida_id' => 14,
                'entidad_id' => 4
            ], // Docente Obstetricia
            [
                'responsable_id' => 20,
                'salida_id' => 14,
                'entidad_id' => 7,
            ], // Docente Obstetricia
            [
                'responsable_id' => 20,
                'salida_id' => 14,
                'entidad_id' => 5,
            ], // Docente Obstetricia

            // Salida 15
            [
                'responsable_id' => 17,
                'salida_id' => 15,
                'entidad_id' => 1,
            ], // Director Escuela Enfermeria
            [
                'responsable_id' => 17,
                'salida_id' => 15,
                'entidad_id' => 3
            ], // Director Escuela Enfermeria
            [
                'responsable_id' => 17,
                'salida_id' => 15,
                'entidad_id' => 6,
            ], // Director Escuela Enfermeria
            [
                'responsable_id' => 17,
                'salida_id' => 15,
                'entidad_id' => 5,
            ], // Director Escuela Enfermeria
            [
                'responsable_id' => 18,
                'salida_id' => 15,
                'entidad_id' => 2,
            ], // Director Escuela Obstetricia
            [
                'responsable_id' => 18,
                'salida_id' => 15,
                'entidad_id' => 4
            ], // Director Escuela Obstetricia
            [
                'responsable_id' => 18,
                'salida_id' => 15,
                'entidad_id' => 7,
            ], // Director Escuela Obstetricia
            [
                'responsable_id' => 18,
                'salida_id' => 15,
                'entidad_id' => 5,
            ], // Director Escuela Obstetricia

            [
                'responsable_id' => 19,
                'salida_id' => 15,
                'entidad_id' => 1,
            ], // Docente Enfermeria
            [
                'responsable_id' => 19,
                'salida_id' => 15,
                'entidad_id' => 3
            ], // Docente Enfermeria
            [
                'responsable_id' => 19,
                'salida_id' => 15,
                'entidad_id' => 6,
            ], // Docente Enfermeria
            [
                'responsable_id' => 19,
                'salida_id' => 15,
                'entidad_id' => 5,
            ], // Docente Enfermeria
            [
                'responsable_id' => 20,
                'salida_id' => 15,
                'entidad_id' => 2,
            ], // Docente Obstetricia
            [
                'responsable_id' => 20,
                'salida_id' => 15,
                'entidad_id' => 4
            ], // Docente Obstetricia
            [
                'responsable_id' => 20,
                'salida_id' => 15,
                'entidad_id' => 7,
            ], // Docente Obstetricia
            [
                'responsable_id' => 20,
                'salida_id' => 15,
                'entidad_id' => 5,
            ], // Docente Obstetricia

            // Salida 16
            [
                'responsable_id' => 17,
                'salida_id' => 16,
                'entidad_id' => 1,
            ], // Director Escuela Enfermeria
            [
                'responsable_id' => 17,
                'salida_id' => 16,
                'entidad_id' => 3
            ], // Director Escuela Enfermeria
            [
                'responsable_id' => 17,
                'salida_id' => 16,
                'entidad_id' => 6,
            ], // Director Escuela Enfermeria
            [
                'responsable_id' => 17,
                'salida_id' => 16,
                'entidad_id' => 5,
            ], // Director Escuela Enfermeria
            [
                'responsable_id' => 17,
                'salida_id' => 16,
                'entidad_id' => 13,
            ], // Director Escuela Enfermeria
            [
                'responsable_id' => 18,
                'salida_id' => 16,
                'entidad_id' => 2,
            ], // Director Escuela Obstetricia
            [
                'responsable_id' => 18,
                'salida_id' => 16,
                'entidad_id' => 4
            ], // Director Escuela Obstetricia
            [
                'responsable_id' => 18,
                'salida_id' => 16,
                'entidad_id' => 7,
            ], // Director Escuela Obstetricia
            [
                'responsable_id' => 18,
                'salida_id' => 16,
                'entidad_id' => 14,
            ], // Director Escuela Obstetricia
            [
                'responsable_id' => 18,
                'salida_id' => 16,
                'entidad_id' => 5,
            ], // Director Escuela Obstetricia

            [
                'responsable_id' => 19,
                'salida_id' => 16,
                'entidad_id' => 1,
            ], // Docente Enfermeria
            [
                'responsable_id' => 19,
                'salida_id' => 16,
                'entidad_id' => 3
            ], // Docente Enfermeria
            [
                'responsable_id' => 19,
                'salida_id' => 16,
                'entidad_id' => 6,
            ], // Docente Enfermeria
            [
                'responsable_id' => 19,
                'salida_id' => 16,
                'entidad_id' => 5,
            ], // Docente Enfermeria
            [
                'responsable_id' => 19,
                'salida_id' => 16,
                'entidad_id' => 13,
            ], // Docente Enfermeria
            [
                'responsable_id' => 20,
                'salida_id' => 16,
                'entidad_id' => 2,
            ], // Docente Obstetricia
            [
                'responsable_id' => 20,
                'salida_id' => 16,
                'entidad_id' => 4
            ], // Docente Obstetricia
            [
                'responsable_id' => 20,
                'salida_id' => 16,
                'entidad_id' => 7,
            ], // Docente Obstetricia
            [
                'responsable_id' => 20,
                'salida_id' => 16,
                'entidad_id' => 5,
            ], // Docente Obstetricia
            [
                'responsable_id' => 20,
                'salida_id' => 16,
                'entidad_id' => 14,
            ], // Docente Obstetricia

            /* Actividad 9 */
            // Salida 17
            [
                'responsable_id' => 21,
                'salida_id' => 17,
                'entidad_id' => 1,
            ], // Director de Enfermeria
            [
                'responsable_id' => 21,
                'salida_id' => 17,
                'entidad_id' => 3,
            ], // Director de Enfermeria
            [
                'responsable_id' => 21,
                'salida_id' => 17,
                'entidad_id' => 9,
            ], // Director de Enfermeria
            [
                'responsable_id' => 21,
                'salida_id' => 17,
                'entidad_id' => 8,
            ], // Director de Enfermeria
            [
                'responsable_id' => 22,
                'salida_id' => 17,
                'entidad_id' => 2,
            ], // Director de Obstetricia
            [
                'responsable_id' => 22,
                'salida_id' => 17,
                'entidad_id' => 4,
            ], // Director de Obstetricia
            [
                'responsable_id' => 22,
                'salida_id' => 17,
                'entidad_id' => 9,
            ], // Director de Obstetricia
            [
                'responsable_id' => 22,
                'salida_id' => 17,
                'entidad_id' => 8,
            ], // Director de Obstetricia

            // Salida 18
            [
                'responsable_id' => 21,
                'salida_id' => 18,
                'entidad_id' => 1,
            ], // Director de Enfermeria
            [
                'responsable_id' => 21,
                'salida_id' => 18,
                'entidad_id' => 3,
            ], // Director de Enfermeria
            [
                'responsable_id' => 21,
                'salida_id' => 18,
                'entidad_id' => 9,
            ], // Director de Enfermeria
            [
                'responsable_id' => 21,
                'salida_id' => 18,
                'entidad_id' => 8,
            ], // Director de Enfermeria
            [
                'responsable_id' => 22,
                'salida_id' => 18,
                'entidad_id' => 2,
            ], // Director de Obstetricia
            [
                'responsable_id' => 22,
                'salida_id' => 18,
                'entidad_id' => 4,
            ], // Director de Obstetricia
            [
                'responsable_id' => 22,
                'salida_id' => 18,
                'entidad_id' => 9,
            ], // Director de Obstetricia
            [
                'responsable_id' => 22,
                'salida_id' => 18,
                'entidad_id' => 8,
            ], // Director de Obstetricia

            /* Actividad 10 */
            // Salida 19
            [
                'responsable_id' => 23,
                'salida_id' => 19,
                'entidad_id' => 1,
            ], // Director de Enfermeria
            [
                'responsable_id' => 23,
                'salida_id' => 19,
                'entidad_id' => 3,
            ], // Director de Enfermeria
            [
                'responsable_id' => 23,
                'salida_id' => 19,
                'entidad_id' => 9,
            ], // Director de Enfermeria
            [
                'responsable_id' => 23,
                'salida_id' => 19,
                'entidad_id' => 8,
            ], // Director de Enfermeria
            [
                'responsable_id' => 24,
                'salida_id' => 19,
                'entidad_id' => 2,
            ], // Director de Obstetricia
            [
                'responsable_id' => 24,
                'salida_id' => 19,
                'entidad_id' => 4,
            ], // Director de Obstetricia
            [
                'responsable_id' => 24,
                'salida_id' => 19,
                'entidad_id' => 9,
            ], // Director de Obstetricia
            [
                'responsable_id' => 24,
                'salida_id' => 19,
                'entidad_id' => 8,
            ], // Director de Obstetricia

            /* Actividad 11 */
            // Salida 20
            [
                'responsable_id' => 25,
                'salida_id' => 20,
                'entidad_id' => 1,
            ], // Director de Enfermeria
            [
                'responsable_id' => 25,
                'salida_id' => 20,
                'entidad_id' => 3,
            ], // Director de Enfermeria
            [
                'responsable_id' => 25,
                'salida_id' => 20,
                'entidad_id' => 6,
            ], // Director de Enfermeria
            [
                'responsable_id' => 25,
                'salida_id' => 20,
                'entidad_id' => 13,
            ], // Director de Enfermeria
            [
                'responsable_id' => 25,
                'salida_id' => 20,
                'entidad_id' => 15,
            ], // Director de Enfermeria
            [
                'responsable_id' => 25,
                'salida_id' => 20,
                'entidad_id' => 17,
            ], // Director de Enfermeria
            [
                'responsable_id' => 25,
                'salida_id' => 20,
                'entidad_id' => 18,
            ], // Director de Enfermeria
            [
                'responsable_id' => 25,
                'salida_id' => 20,
                'entidad_id' => 9,
            ], // Director de Enfermeria
            [
                'responsable_id' => 25,
                'salida_id' => 20,
                'entidad_id' => 8,
            ], // Director de Enfermeria
            [
                'responsable_id' => 26,
                'salida_id' => 20,
                'entidad_id' => 2,
            ], // Director de Obstetricia
            [
                'responsable_id' => 26,
                'salida_id' => 20,
                'entidad_id' => 4,
            ], // Director de Obstetricia
            [
                'responsable_id' => 26,
                'salida_id' => 20,
                'entidad_id' => 7,
            ], // Director de Obstetricia
            [
                'responsable_id' => 26,
                'salida_id' => 20,
                'entidad_id' => 14,
            ], // Director de Obstetricia
            [
                'responsable_id' => 26,
                'salida_id' => 20,
                'entidad_id' => 15,
            ], // Director de Obstetricia
            [
                'responsable_id' => 26,
                'salida_id' => 20,
                'entidad_id' => 17,
            ], // Director de Obstetricia
            [
                'responsable_id' => 26,
                'salida_id' => 20,
                'entidad_id' => 18,
            ], // Director de Obstetricia
            [
                'responsable_id' => 26,
                'salida_id' => 20,
                'entidad_id' => 9,
            ], // Director de Obstetricia
            [
                'responsable_id' => 26,
                'salida_id' => 20,
                'entidad_id' => 8,
            ], // Director de Obstetricia

            //Todo Gestion Calidad
            [
                'responsable_id' => 27,
                'salida_id' => 38,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 27,
                'salida_id' => 38,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 27,
                'salida_id' => 38,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 27,
                'salida_id' => 38,
                'entidad_id' => 9,
            ],
            [
                'responsable_id' => 27,
                'salida_id' => 38,
                'entidad_id' => 19,
            ],
            [
                'responsable_id' => 28,
                'salida_id' => 38,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 28,
                'salida_id' => 38,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 28,
                'salida_id' => 38,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 28,
                'salida_id' => 38,
                'entidad_id' => 9,
            ],
            [
                'responsable_id' => 28,
                'salida_id' => 38,
                'entidad_id' => 19,
            ],

            [
                'responsable_id' => 29,
                'salida_id' => 21,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 29,
                'salida_id' => 21,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 29,
                'salida_id' => 21,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 29,
                'salida_id' => 21,
                'entidad_id' => 9,
            ],

            [
                'responsable_id' => 30,
                'salida_id' => 22,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 30,
                'salida_id' => 22,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 30,
                'salida_id' => 22,
                'entidad_id' => 9,
            ],
            [
                'responsable_id' => 31,
                'salida_id' => 22,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 31,
                'salida_id' => 22,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 31,
                'salida_id' => 22,
                'entidad_id' => 9,
            ],

            [
                'responsable_id' => 32,
                'salida_id' => 23,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 32,
                'salida_id' => 23,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 32,
                'salida_id' => 23,
                'entidad_id' => 9,
            ],
            [
                'responsable_id' => 33,
                'salida_id' => 23,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 33,
                'salida_id' => 23,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 33,
                'salida_id' => 23,
                'entidad_id' => 9,
            ],

            [
                'responsable_id' => 34,
                'salida_id' => 24,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 34,
                'salida_id' => 24,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 34,
                'salida_id' => 24,
                'entidad_id' => 9,
            ],
            [
                'responsable_id' => 34,
                'salida_id' => 24,
                'entidad_id' => 19,
            ],
            [
                'responsable_id' => 34,
                'salida_id' => 25,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 34,
                'salida_id' => 25,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 34,
                'salida_id' => 25,
                'entidad_id' => 9,
            ],
            [
                'responsable_id' => 34,
                'salida_id' => 25,
                'entidad_id' => 19,
            ],
            [
                'responsable_id' => 35,
                'salida_id' => 24,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 35,
                'salida_id' => 24,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 35,
                'salida_id' => 24,
                'entidad_id' => 9,
            ],
            [
                'responsable_id' => 35,
                'salida_id' => 24,
                'entidad_id' => 19,
            ],
            [
                'responsable_id' => 35,
                'salida_id' => 25,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 35,
                'salida_id' => 25,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 35,
                'salida_id' => 25,
                'entidad_id' => 9,
            ],
            [
                'responsable_id' => 35,
                'salida_id' => 25,
                'entidad_id' => 19,
            ],

            [
                'responsable_id' => 36,
                'salida_id' => 26,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 36,
                'salida_id' => 26,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 36,
                'salida_id' => 26,
                'entidad_id' => 9,
            ],

            [
                'responsable_id' => 37,
                'salida_id' => 27,
                'entidad_id' => 20,
            ],
            [
                'responsable_id' => 38,
                'salida_id' => 27,
                'entidad_id' => 20,
            ],

            [
                'responsable_id' => 39,
                'salida_id' => 28,
                'entidad_id' => 20,
            ],
            [
                'responsable_id' => 40,
                'salida_id' => 28,
                'entidad_id' => 20,
            ],

            [
                'responsable_id' => 41,
                'salida_id' => 29,
                'entidad_id' => 20,
            ],

            [
                'responsable_id' => 42,
                'salida_id' => 30,
                'entidad_id' => 20,
            ],

            [
                'responsable_id' => 43,
                'salida_id' => 31,
                'entidad_id' => 20,
            ],
            [
                'responsable_id' => 44,
                'salida_id' => 31,
                'entidad_id' => 20,
            ],

            [
                'responsable_id' => 45,
                'salida_id' => 32,
                'entidad_id' => 21,
            ],
            [
                'responsable_id' => 46,
                'salida_id' => 32,
                'entidad_id' => 21,
            ],

            [
                'responsable_id' => 47,
                'salida_id' => 33,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 47,
                'salida_id' => 33,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 47,
                'salida_id' => 33,
                'entidad_id' => 9,
            ],
            [
                'responsable_id' => 47,
                'salida_id' => 33,
                'entidad_id' => 19,
            ],

            [
                'responsable_id' => 48,
                'salida_id' => 34,
                'entidad_id' => 9,
            ],
            [
                'responsable_id' => 48,
                'salida_id' => 35,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 48,
                'salida_id' => 35,
                'entidad_id' => 9,
            ],
            [
                'responsable_id' => 48,
                'salida_id' => 35,
                'entidad_id' => 22,
            ],

            [
                'responsable_id' => 49,
                'salida_id' => 36,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 49,
                'salida_id' => 36,
                'entidad_id' => 9,
            ],
            [
                'responsable_id' => 49,
                'salida_id' => 36,
                'entidad_id' => 22,
            ],

            [
                'responsable_id' => 50,
                'salida_id' => 37,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 50,
                'salida_id' => 37,
                'entidad_id' => 9,
            ],
            [
                'responsable_id' => 50,
                'salida_id' => 37,
                'entidad_id' => 22,
            ],
            //Todo Plan de Estudios
            [
                'responsable_id' => 51,
                'salida_id' => 39,
                'entidad_id' => 19,
            ],
            [
                'responsable_id' => 52,
                'salida_id' => 39,
                'entidad_id' => 19,
            ],
            [
                'responsable_id' => 53,
                'salida_id' => 40,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 53,
                'salida_id' => 40,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 53,
                'salida_id' => 40,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 53,
                'salida_id' => 40,
                'entidad_id' => 3,
            ],
            [
                'responsable_id' => 54,
                'salida_id' => 41,
                'entidad_id' => 19,
            ],
            [
                'responsable_id' => 55,
                'salida_id' => 42,
                'entidad_id' => 30,
            ],
            [
                'responsable_id' => 56,
                'salida_id' => 43,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 56,
                'salida_id' => 43,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 56,
                'salida_id' => 43,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 57,
                'salida_id' => 44,
                'entidad_id' => 19,
            ],
            [
                'responsable_id' => 58,
                'salida_id' => 44,
                'entidad_id' => 19,
            ],
            [
                'responsable_id' => 59,
                'salida_id' => 45,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 59,
                'salida_id' => 45,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 59,
                'salida_id' => 45,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 59,
                'salida_id' => 45,
                'entidad_id' => 3,
            ],
            [
                'responsable_id' => 60,
                'salida_id' => 46,
                'entidad_id' => 19,
            ],
            [
                'responsable_id' => 61,
                'salida_id' => 47,
                'entidad_id' => 31,
            ],//
            [
                'responsable_id' => 62,
                'salida_id' => 48,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 62,
                'salida_id' => 48,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 62,
                'salida_id' => 48,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 62,
                'salida_id' => 49,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 62,
                'salida_id' => 49,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 62,
                'salida_id' => 49,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 63,
                'salida_id' => 50,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 63,
                'salida_id' => 50,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 63,
                'salida_id' => 50,
                'entidad_id' => 8,
            ],//
            [
                'responsable_id' => 64,
                'salida_id' => 51,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 64,
                'salida_id' => 51,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 64,
                'salida_id' => 51,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 64,
                'salida_id' => 51,
                'entidad_id' => 13,
            ],
            [
                'responsable_id' => 64,
                'salida_id' => 51,
                'entidad_id' => 14,
            ],
            [
                'responsable_id' => 64,
                'salida_id' => 52,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 64,
                'salida_id' => 52,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 64,
                'salida_id' => 52,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 64,
                'salida_id' => 52,
                'entidad_id' => 13,
            ],
            [
                'responsable_id' => 64,
                'salida_id' => 52,
                'entidad_id' => 14,
            ],
            [
                'responsable_id' => 65,
                'salida_id' => 51,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 65,
                'salida_id' => 51,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 65,
                'salida_id' => 51,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 65,
                'salida_id' => 51,
                'entidad_id' => 13,
            ],
            [
                'responsable_id' => 65,
                'salida_id' => 51,
                'entidad_id' => 14,
            ],
            [
                'responsable_id' => 65,
                'salida_id' => 52,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 65,
                'salida_id' => 52,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 65,
                'salida_id' => 52,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 65,
                'salida_id' => 52,
                'entidad_id' => 13,
            ],
            [
                'responsable_id' => 65,
                'salida_id' => 52,
                'entidad_id' => 14,
            ],//
            [
                'responsable_id' => 66,
                'salida_id' => 53,
                'entidad_id' => 19,
            ],
            [
                'responsable_id' => 67,
                'salida_id' => 53,
                'entidad_id' => 19,
            ],//
            [
                'responsable_id' => 68,
                'salida_id' => 54,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 68,
                'salida_id' => 54,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 68,
                'salida_id' => 54,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 68,
                'salida_id' => 54,
                'entidad_id' => 3,
            ],
            [
                'responsable_id' => 68,
                'salida_id' => 54,
                'entidad_id' => 15,
            ],
            [
                'responsable_id' => 69,
                'salida_id' => 54,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 69,
                'salida_id' => 54,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 69,
                'salida_id' => 54,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 69,
                'salida_id' => 54,
                'entidad_id' => 3,
            ],
            [
                'responsable_id' => 69,
                'salida_id' => 54,
                'entidad_id' => 15,
            ],//
            [
                'responsable_id' => 70,
                'salida_id' => 55,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 70,
                'salida_id' => 55,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 70,
                'salida_id' => 55,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 70,
                'salida_id' => 55,
                'entidad_id' => 3,
            ],
            [
                'responsable_id' => 71,
                'salida_id' => 55,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 71,
                'salida_id' => 55,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 71,
                'salida_id' => 55,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 71,
                'salida_id' => 55,
                'entidad_id' => 3,
            ],//
            [
                'responsable_id' => 72,
                'salida_id' => 56,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 72,
                'salida_id' => 56,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 72,
                'salida_id' => 56,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 72,
                'salida_id' => 56,
                'entidad_id' => 3,
            ],
            [
                'responsable_id' => 73,
                'salida_id' => 56,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 73,
                'salida_id' => 56,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 73,
                'salida_id' => 56,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 73,
                'salida_id' => 56,
                'entidad_id' => 3,
            ],//
            [
                'responsable_id' => 74,
                'salida_id' => 57,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 74,
                'salida_id' => 57,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 74,
                'salida_id' => 57,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 74,
                'salida_id' => 57,
                'entidad_id' => 3,
            ],
            [
                'responsable_id' => 75,
                'salida_id' => 57,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 75,
                'salida_id' => 57,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 75,
                'salida_id' => 57,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 75,
                'salida_id' => 57,
                'entidad_id' => 3,
            ],//
            [
                'responsable_id' => 76,
                'salida_id' => 58,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 76,
                'salida_id' => 58,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 76,
                'salida_id' => 58,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 76,
                'salida_id' => 58,
                'entidad_id' => 3,
            ],
            [
                'responsable_id' => 76,
                'salida_id' => 59,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 76,
                'salida_id' => 59,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 76,
                'salida_id' => 59,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 76,
                'salida_id' => 59,
                'entidad_id' => 3,
            ],
            [
                'responsable_id' => 77,
                'salida_id' => 58,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 77,
                'salida_id' => 58,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 77,
                'salida_id' => 58,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 77,
                'salida_id' => 58,
                'entidad_id' => 3,
            ],
            [
                'responsable_id' => 77,
                'salida_id' => 59,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 77,
                'salida_id' => 59,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 77,
                'salida_id' => 59,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 77,
                'salida_id' => 59,
                'entidad_id' => 3,
            ],//
            [
                'responsable_id' => 78,
                'salida_id' => 60,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 78,
                'salida_id' => 60,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 78,
                'salida_id' => 60,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 78,
                'salida_id' => 60,
                'entidad_id' => 3,
            ],
            [
                'responsable_id' => 79,
                'salida_id' => 60,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 79,
                'salida_id' => 60,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 79,
                'salida_id' => 60,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 79,
                'salida_id' => 60,
                'entidad_id' => 3,
            ],
            [
                'responsable_id' => 78,
                'salida_id' => 61,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 78,
                'salida_id' => 61,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 78,
                'salida_id' => 61,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 78,
                'salida_id' => 61,
                'entidad_id' => 3,
            ],
            [
                'responsable_id' => 79,
                'salida_id' => 61,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 79,
                'salida_id' => 61,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 79,
                'salida_id' => 61,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 79,
                'salida_id' => 61,
                'entidad_id' => 3,
            ],//
            [
                'responsable_id' => 80,
                'salida_id' => 62,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 80,
                'salida_id' => 62,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 80,
                'salida_id' => 62,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 80,
                'salida_id' => 62,
                'entidad_id' => 3,
            ],
            [
                'responsable_id' => 80,
                'salida_id' => 62,
                'entidad_id' => 15,
            ],
            [
                'responsable_id' => 81,
                'salida_id' => 62,
                'entidad_id' => 1,
            ],
            [
                'responsable_id' => 81,
                'salida_id' => 62,
                'entidad_id' => 2,
            ],
            [
                'responsable_id' => 81,
                'salida_id' => 62,
                'entidad_id' => 8,
            ],
            [
                'responsable_id' => 81,
                'salida_id' => 62,
                'entidad_id' => 3,
            ],
            [
                'responsable_id' => 81,
                'salida_id' => 62,
                'entidad_id' => 15,
            ],

        ];

        \App\Models\Cliente::insert($clientes);
    }
}
