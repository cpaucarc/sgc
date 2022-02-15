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
            /* Actividad 1 */
            // Proveedor 1
            [
                'actividad_id' => 1,
                'oficina_id' => 1,
                'entrada_id' => 1,
            ],
            [
                'actividad_id' => 1,
                'oficina_id' => 1,
                'entrada_id' => 3,
            ],
            [
                'actividad_id' => 1,
                'oficina_id' => 1,
                'entrada_id' => 4,
            ],
            // Proveedor 5
            [
                'actividad_id' => 1,
                'oficina_id' => 5,
                'entrada_id' => 2,
            ],

            /* Actividad 2 */
            // Proveedor 1
            [
                'actividad_id' => 2,
                'oficina_id' => 1,
                'entrada_id' => 5,
            ],
            [
                'actividad_id' => 2,
                'oficina_id' => 1,
                'entrada_id' => 6,
            ],
            // Proveedor 3
            [
                'actividad_id' => 2,
                'oficina_id' => 3,
                'entrada_id' => 4,
            ],
            // Proveedor 7
            [
                'actividad_id' => 2,
                'oficina_id' => 7,
                'entrada_id' => 7,
            ],

            /* Actividad 3 */
            // Proveedor 1
            [
                'actividad_id' => 3,
                'oficina_id' => 1,
                'entrada_id' => 3
            ],
            [
                'actividad_id' => 3,
                'oficina_id' => 1,
                'entrada_id' => 8
            ],
            // Proveedor 5
            [
                'actividad_id' => 3,
                'oficina_id' => 5,
                'entrada_id' => 2
            ],

            /* Actividad 4 */
            // Proveedor 1
            [
                'actividad_id' => 4,
                'oficina_id' => 1,
                'entrada_id' => 9
            ],
            [
                'actividad_id' => 4,
                'oficina_id' => 1,
                'entrada_id' => 11
            ],
            [
                'actividad_id' => 4,
                'oficina_id' => 1,
                'entrada_id' => 12
            ],
            [
                'actividad_id' => 4,
                'oficina_id' => 1,
                'entrada_id' => 13
            ],
            // Proveedor 3
            [
                'actividad_id' => 4,
                'oficina_id' => 3,
                'entrada_id' => 4
            ],

            /* Actividad 5 */
            // Proveedor 8
            [
                'actividad_id' => 5,
                'oficina_id' => 8,
                'entrada_id' => 14
            ],

            /* Actividad 6 */
            // Proveedor 3
            [
                'actividad_id' => 6,
                'oficina_id' => 3,
                'entrada_id' => 16
            ],

            /* Actividad 7 */
            // Proveedor 2
            [
                'actividad_id' => 7,
                'oficina_id' => 2,
                'entrada_id' => 15
            ],

            /* Actividad 8 */
            // Proveedor 3
            [
                'actividad_id' => 8,
                'oficina_id' => 3,
                'entrada_id' => 16
            ],

            /* Actividad 9 */
            // Proveedor 1
            [
                'actividad_id' => 9,
                'oficina_id' => 1,
                'entrada_id' => 19
            ],
            // Proveedor 6
            [
                'actividad_id' => 9,
                'oficina_id' => 6,
                'entrada_id' => 17
            ],
            [
                'actividad_id' => 9,
                'oficina_id' => 6,
                'entrada_id' => 18
            ],

            /* Actividad 10 */
            // Proveedor 1
            [
                'actividad_id' => 10,
                'oficina_id' => 1,
                'entrada_id' => 22
            ],
            // Proveedor 6
            [
                'actividad_id' => 10,
                'oficina_id' => 6,
                'entrada_id' => 20
            ],
            [
                'actividad_id' => 10,
                'oficina_id' => 6,
                'entrada_id' => 21
            ],

            /* Actividad 11 */
            // Proveedor 5
            [
                'actividad_id' => 11,
                'oficina_id' => 5,
                'entrada_id' => 23
            ],

        ];

        \App\Models\Proveedor::insert($proveedores);
    }
}
