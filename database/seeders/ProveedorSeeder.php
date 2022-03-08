<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $proveedores = [
            /* Todo Enseñanza Aprendizaje */
            /* Actividad 1 */
            // Proveedor 1
            [
                'responsable_id' => 1,
                'entidad_id' => 1,
                'entrada_id' => 1,
            ], // Director Escuela Enfermeria a Director Escuela Enfermeria
            [
                'responsable_id' => 1,
                'entidad_id' => 1,
                'entrada_id' => 3,
            ], // Director Escuela Enfermeria a Director Escuela Enfermeria
            [
                'responsable_id' => 1,
                'entidad_id' => 1,
                'entrada_id' => 4,
            ], // Director Escuela Enfermeria a Director Escuela Enfermeria

            [
                'responsable_id' => 2,
                'entidad_id' => 2,
                'entrada_id' => 1,
            ], // Director Escuela Obstetricia a Director Escuela Obstetricia
            [
                'responsable_id' => 2,
                'entidad_id' => 2,
                'entrada_id' => 3,
            ], // Director Escuela Obstetricia a Director Escuela Obstetricia
            [
                'responsable_id' => 2,
                'entidad_id' => 2,
                'entrada_id' => 4,
            ], // Director Escuela Obstetricia a Director Escuela Obstetricia

            // Proveedor 5
            [
                'responsable_id' => 1,
                'entidad_id' => 8,
                'entrada_id' => 2,
            ], // Decano a DEEnf
            [
                'responsable_id' => 2,
                'entidad_id' => 8,
                'entrada_id' => 2,
            ], // Decano a DEObs

            /* Actividad 2 */
            // Proveedor 1
            [
                'responsable_id' => 3,
                'entidad_id' => 1,
                'entrada_id' => 5,
            ], // DEEnf a DEnf
            [
                'responsable_id' => 3,
                'entidad_id' => 1,
                'entrada_id' => 6,
            ], // DEEnf a DEnf
            [
                'responsable_id' => 4,
                'entidad_id' => 2,
                'entrada_id' => 5,
            ], // DEObs a DObs
            [
                'responsable_id' => 4,
                'entidad_id' => 2,
                'entrada_id' => 6,
            ], // DEObs a DObs

            // Proveedor 3
            [
                'responsable_id' => 3,
                'entidad_id' => 5,
                'entrada_id' => 4,
            ], // OGE a DEnf
            [
                'responsable_id' => 4,
                'entidad_id' => 5,
                'entrada_id' => 4,
            ], // OGE a DObs

            // Proveedor 7
            [
                'responsable_id' => 3,
                'entidad_id' => 10,
                'entrada_id' => 7,
            ], // Biblio a DEnf
            [
                'responsable_id' => 4,
                'entidad_id' => 10,
                'entrada_id' => 7,
            ], // Biblio a DObs

            /* Actividad 3 */
            // Proveedor 1
            [
                'responsable_id' => 5,
                'entidad_id' => 1,
                'entrada_id' => 3
            ], // DEEnf a DEEnf
            [
                'responsable_id' => 3,
                'entidad_id' => 1,
                'entrada_id' => 8
            ], // DEEnf a DEEnf
            [
                'responsable_id' => 6,
                'entidad_id' => 2,
                'entrada_id' => 3
            ], // DEEnf a DEObs
            [
                'responsable_id' => 6,
                'entidad_id' => 2,
                'entrada_id' => 8
            ], // DEEnf a DEObs

            // Proveedor 5
            [
                'responsable_id' => 5,
                'entidad_id' => 8,
                'entrada_id' => 2
            ], //Decano a DEEnf
            [
                'responsable_id' => 6,
                'entidad_id' => 8,
                'entrada_id' => 2
            ], //Decano a DEObs

            /* Actividad 4 */
            // Proveedor 1
            [
                'responsable_id' => 7,
                'entidad_id' => 1,
                'entrada_id' => 9
            ], //DEEnf a DEnf
            [
                'responsable_id' => 7,
                'entidad_id' => 1,
                'entrada_id' => 11
            ], //DEEnf a DEnf
            [
                'responsable_id' => 7,
                'entidad_id' => 1,
                'entrada_id' => 12
            ], //DEEnf a DEnf
            [
                'responsable_id' => 7,
                'entidad_id' => 1,
                'entrada_id' => 13
            ], //DEEnf a DEnf
            [
                'responsable_id' => 8,
                'entidad_id' => 2,
                'entrada_id' => 9
            ], //DEObs a DObs
            [
                'responsable_id' => 8,
                'entidad_id' => 2,
                'entrada_id' => 11
            ], //DEObs a DObs
            [
                'responsable_id' => 8,
                'entidad_id' => 2,
                'entrada_id' => 12
            ], //DEObs a DObs
            [
                'responsable_id' => 8,
                'entidad_id' => 2,
                'entrada_id' => 13
            ], //DEObs a DObs

            // Proveedor 3
            [
                'responsable_id' => 7,
                'entidad_id' => 5,
                'entrada_id' => 4
            ], // OGE a DEnf
            [
                'responsable_id' => 8,
                'entidad_id' => 5,
                'entrada_id' => 4
            ], // OGE a DObs

            /* Actividad 5 */
            // Proveedor 8
            [
                'responsable_id' => 9,
                'entidad_id' => 11,
                'entrada_id' => 14
            ], // ComTutEnf a DEnf
            [
                'responsable_id' => 10,
                'entidad_id' => 12,
                'entrada_id' => 14
            ], // ComTutObs a DObs

            /* Actividad 6 */
            // Proveedor 3
            [
                'responsable_id' => 11,
                'entidad_id' => 5,
                'entrada_id' => 16
            ], // OGE a DEnf
            [
                'responsable_id' => 12,
                'entidad_id' => 5,
                'entrada_id' => 16
            ], // OGE a DEnf

            /* Actividad 7 */
            // Proveedor 2
            [
                'responsable_id' => 13,
                'entidad_id' => 3,
                'entrada_id' => 15
            ], //DDEnf a DEEnf
            [
                'responsable_id' => 14,
                'entidad_id' => 4,
                'entrada_id' => 15
            ], //DDObs a DEObs
            [
                'responsable_id' => 15,
                'entidad_id' => 3,
                'entrada_id' => 15
            ], //DDEnf a DDEnf
            [
                'responsable_id' => 16,
                'entidad_id' => 4,
                'entrada_id' => 15
            ], //DDObs a DDObs

            /* Actividad 8 */
            // Proveedor 3
            [
                'responsable_id' => 17,
                'entidad_id' => 5,
                'entrada_id' => 16
            ], //OGE a DEEnf
            [
                'responsable_id' => 18,
                'entidad_id' => 5,
                'entrada_id' => 16
            ], //OGE a DEObs
            [
                'responsable_id' => 19,
                'entidad_id' => 5,
                'entrada_id' => 16
            ], //OGE a DEnf
            [
                'responsable_id' => 20,
                'entidad_id' => 5,
                'entrada_id' => 16
            ], //OGE a DEnf

            /* Actividad 9 */
            // Proveedor 1
            [
                'responsable_id' => 21,
                'entidad_id' => 1,
                'entrada_id' => 19
            ], //DEEnf a DEEnf
            [
                'responsable_id' => 22,
                'entidad_id' => 2,
                'entrada_id' => 19
            ], //DEObs a DEObs

            // Proveedor 6
            [
                'responsable_id' => 21,
                'entidad_id' => 9,
                'entrada_id' => 17
            ], //DUCal a DEEnf
            [
                'responsable_id' => 21,
                'entidad_id' => 9,
                'entrada_id' => 18
            ], //DUCal a DEEnf
            [
                'responsable_id' => 22,
                'entidad_id' => 9,
                'entrada_id' => 17
            ], //DUCal a DEObs
            [
                'responsable_id' => 22,
                'entidad_id' => 9,
                'entrada_id' => 18
            ], //DUCal a DEObs

            /* Actividad 10 */
            // Proveedor 1
            [
                'responsable_id' => 23,
                'entidad_id' => 1,
                'entrada_id' => 22
            ], //DEEnf a DEEnf
            [
                'responsable_id' => 24,
                'entidad_id' => 2,
                'entrada_id' => 22
            ], //DEObs a DEObs

            // Proveedor 6
            [
                'responsable_id' => 23,
                'entidad_id' => 9,
                'entrada_id' => 20
            ], // DUCal a DEEnf
            [
                'responsable_id' => 23,
                'entidad_id' => 9,
                'entrada_id' => 21
            ], // DUCal a DEEnf
            [
                'responsable_id' => 24,
                'entidad_id' => 9,
                'entrada_id' => 20
            ], // DUCal a DEObs
            [
                'responsable_id' => 24,
                'entidad_id' => 9,
                'entrada_id' => 21
            ], // DUCal a DEObs

            /* Actividad 11 */
            // Proveedor 5
            [
                'responsable_id' => 25,
                'entidad_id' => 8,
                'entrada_id' => 23
            ], //Dec a DEEnf
            [
                'responsable_id' => 26,
                'entidad_id' => 8,
                'entrada_id' => 23
            ], //Dec a DEObs

            /* Todo Gestion de Calidad */
            [
                'responsable_id' => 27,
                'entidad_id' => 1,
                'entrada_id' => 46
            ],
            [
                'responsable_id' => 28,
                'entidad_id' => 2,
                'entrada_id' => 46
            ],
            [
                'responsable_id' => 29,
                'entidad_id' => 20,
                'entrada_id' => 24
            ],
            [
                'responsable_id' => 30,
                'entidad_id' => 19,
                'entrada_id' => 25
            ],
            [
                'responsable_id' => 31,
                'entidad_id' => 19,
                'entrada_id' => 25
            ],
            [
                'responsable_id' => 32,
                'entidad_id' => 23,
                'entrada_id' => 26
            ],
            [
                'responsable_id' => 33,
                'entidad_id' => 24,
                'entrada_id' => 26
            ],
            [
                'responsable_id' => 34,
                'entidad_id' => 23,
                'entrada_id' => 27
            ],
            [
                'responsable_id' => 35,
                'entidad_id' => 24,
                'entrada_id' => 27
            ],
            [
                'responsable_id' => 36,
                'entidad_id' => 19,
                'entrada_id' => 25
            ],
            [
                'responsable_id' => 36,
                'entidad_id' => 23,
                'entrada_id' => 28
            ],
            [
                'responsable_id' => 36,
                'entidad_id' => 24,
                'entrada_id' => 28
            ],
            [
                'responsable_id' => 37,
                'entidad_id' => 23,
                'entrada_id' => 28
            ],
            [
                'responsable_id' => 37,
                'entidad_id' => 23,
                'entrada_id' => 29
            ],
            [
                'responsable_id' => 38,
                'entidad_id' => 24,
                'entrada_id' => 28
            ],
            [
                'responsable_id' => 38,
                'entidad_id' => 24,
                'entrada_id' => 29
            ],
            [
                'responsable_id' => 39,
                'entidad_id' => 23,
                'entrada_id' => 26
            ],
            [
                'responsable_id' => 39,
                'entidad_id' => 23,
                'entrada_id' => 30
            ],
            [
                'responsable_id' => 40,
                'entidad_id' => 24,
                'entrada_id' => 26
            ],
            [
                'responsable_id' => 40,
                'entidad_id' => 24,
                'entrada_id' => 30
            ],
            [
                'responsable_id' => 41,
                'entidad_id' => 20,
                'entrada_id' => 31
            ],
            [
                'responsable_id' => 42,
                'entidad_id' => 20,
                'entrada_id' => 32
            ],
            [
                'responsable_id' => 42,
                'entidad_id' => 20,
                'entrada_id' => 33
            ],
            [
                'responsable_id' => 43,
                'entidad_id' => 27,
                'entrada_id' => 34
            ],
            [
                'responsable_id' => 43,
                'entidad_id' => 27,
                'entrada_id' => 35
            ],
            [
                'responsable_id' => 44,
                'entidad_id' => 27,
                'entrada_id' => 34
            ],
            [
                'responsable_id' => 44,
                'entidad_id' => 27,
                'entrada_id' => 35
            ],
            [
                'responsable_id' => 45,
                'entidad_id' => 21,
                'entrada_id' => 36
            ],
            [
                'responsable_id' => 46,
                'entidad_id' => 21,
                'entrada_id' => 36
            ],
            [
                'responsable_id' => 47,
                'entidad_id' => 28,
                'entrada_id' => 37
            ],
            [
                'responsable_id' => 48,
                'entidad_id' => 9,
                'entrada_id' => 26
            ],
            [
                'responsable_id' => 48,
                'entidad_id' => 9,
                'entrada_id' => 38
            ],
            [
                'responsable_id' => 48,
                'entidad_id' => 9,
                'entrada_id' => 39
            ],
            [
                'responsable_id' => 49,
                'entidad_id' => 9,
                'entrada_id' => 40
            ],
            [
                'responsable_id' => 49,
                'entidad_id' => 9,
                'entrada_id' => 41
            ],
            [
                'responsable_id' => 49,
                'entidad_id' => 9,
                'entrada_id' => 42
            ],
            [
                'responsable_id' => 50,
                'entidad_id' => 9,
                'entrada_id' => 43
            ],
            [
                'responsable_id' => 50,
                'entidad_id' => 9,
                'entrada_id' => 44
            ],
            [
                'responsable_id' => 50,
                'entidad_id' => 9,
                'entrada_id' => 45
            ],
        ];

        \App\Models\Proveedor::insert($proveedores);
    }
}
