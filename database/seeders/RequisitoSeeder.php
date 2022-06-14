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
            // Proceso de Grado Bachiller (15)
            [
                'nombre' => 'FUT dirigida al decano solicitando grado de bachiller',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'Certificado de estudios originales, (OGE)',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'Constancia de egresado (dirección de escuela respectiva)',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'Constancia original de ingreso (Comisión Central de Admisión de la UNASAM)',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'Recibo de pago por derecho de grado académico de bachiller, determinado en el Tupa',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'Copia de DNI simple (Legalizado)',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'Copia simple de partida de nacimiento (Legalizado)',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'Copia de certificado de estudios de conocimientod de idiomas nivel básico (UNASAM)',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'Constancia de práctica (s) pre profesional (es), (dirección de escuela)',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'Constancia de no adeudar bienes a la biblioteca central de la UNASAM',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'Constancia de no adeudar bienes a la dirección de bienestar universitario de la UNASAM',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'Constancia de no adeudar bienes y/o valores a la facultad',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'Constancia original de primera matrícula',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'Constancia original de fecha exacta de egreso',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'Dos fotografias de frente, tamaño pasaporte.',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            //  Proceso de Titulo Profesional (8)
            [
                'nombre' => 'Copia de diploma de bachiller',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'Solicitud de inscripción por plan de tesis',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'Plan de tesis',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'Constancia de aprobación plan de tesis',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'Solicitud de designación de jurados',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'Proyecto de investigación',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'Constancia de no adeudar',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'Certificado de prácticas pre-profesionales',
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
