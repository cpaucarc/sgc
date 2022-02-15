<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequisitoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requisitos = [
            // Proceso de Grado Bachiller
            [
                'nombre' => 'Certificado de estudios',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'Certificado de idioma',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'Constancia de primera y última matrícula',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'Constancia de no adeudar',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'Copia de DNI legalizada',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'Fotografías (02)',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'Partida de nacimiento',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'Constancia de egresado',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],

            //  Proceso de Titulo Profesional (6)
            [
                'nombre' => 'Copia del grado de bachiller',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'Proyecto de investigación',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'Solicitud de inscripción de proyecto de investigación',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'Acta de revisión del asesor de proyecto de investigación',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'Acta de revisión del asesor de proyecto de investigación',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'Solicitud de designación de jurados',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            //  Proceso de Convalidaciones (4)
            [
                'nombre' => 'Ficha de matrícula',
                'proceso_id' => 16 // 16: Convalidaciones (Tabla: Procesos)
            ],
            [
                'nombre' => 'Acreditación de aprobación de cursos',
                'proceso_id' => 16 // 16: Convalidaciones (Tabla: Procesos)
            ],
            [
                'nombre' => 'Comprobante de pago (S/. 200)',
                'proceso_id' => 16 // 16: Convalidaciones (Tabla: Procesos)
            ],
            [
                'nombre' => 'Constancia de Ingreso (Ptj. Min 170)',
                'proceso_id' => 16 // 16: Convalidaciones (Tabla: Procesos)
            ],
        ];

        \App\Models\Requisito::insert($requisitos);
    }
}
