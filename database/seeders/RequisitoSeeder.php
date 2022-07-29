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
                'nombre' => 'FUT DIRIGIDO AL DECANO SOLICITANDO GRADO DE BACHILLER',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'CERTIFICADOS DE ESTUDIOS ORIGINALES, (expedido por la OGE. (del I al X ciclo)',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'CONSTANCIA DE EGRESADO, (expedida por la dirección de escuela respectiva, (autenticada por Secretaria General de la UNASAM)',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'CONSTANCIA ORIGINAL DE INGRESO (expedida por la Comisión Central de Admisión (CCA) de la UNASAM',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'RECIBO DE PAGO POR DERECHO DE GRADO ACADÉMICO DE BACHILLER, determinado en el TUPA',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'COPIA SIMPLE DE DNI (legalizado)',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'COPIA SIMPLE DE LA PARTIDA DE NACIMIENTO (legalizado)',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'COPIA DEL CERTIFICADO DE ESTUDIOS DE CONOCIMIENTO DEL IDIOMA INGLÉS O QUECHUA A NIVEL BÁSICO, otorgado por el centro de idiomas de la UNASAM, (autentificado por secretaria general de la UNASAM)',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'CONSTANCIA DE PRACTICA (S) PRE PROFESIONAL (ES) (expedida por la Dirección de Escuela)',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'CONSTANCIA DE NO ADEUDAR BIENES A LA BIBLIOTECA CENTRAL DE LA UNASAM',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => ' CONSTANCIA DE NO ADEUDO A LA DIRECCIÓN DE BIENESTAR UNIVERSITARIO DE LA UNASAM',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => ' CONSTANCIA DE NO ADEUDAR BIENES Y/O VALORES A LA FACULTAD',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'CONSTANCIA ORIGINAL DE PRIMERA MATRICULA, con la rúbrica del Director de Escuela',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'CONSTANCIA ORIGINAL DE FECHA EXACTA DE EGRESO. Con rúbrica del Director de Escuela',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            [
                'nombre' => 'DOS FOTOGRAFÍAS DE FRENTE, TAMAÑO PASAPORTE A COLORES CON FONDO BLANCO, RECIENTES',
                'proceso_id' => 12 // 12: Grado Bachiller (Tabla: Procesos)
            ],
            //  Proceso de Titulo Profesional (13)
            [
                'nombre' => 'SOLICITUD DIRIGIDA AL DECANO DE LA FACULTAD DE CIENCIAS (FUT)',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'RECIBO DE PAGO POR DERECHO DE TÍTULO PROFESIONAL, determinado por el TUPA',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'COPIA DEL GRADO ACADÉMICO DE BACHILLER, autenticada por Secretaría General de la UNASAM.',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'COPIA DEL ACTA DE SUSTENTACIÓN Y APROBACIÓN DE LA TESIS O PROGRAMA DE TITULACIÓN DE TESIS GUIADA O TRABAJO DE SUFICIENCIA PROFESIONAL (autenticada por Secretaría General de la UNASAM).',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'COPIA DE CONSTANCIA DE EGRESO, autenticada por la Secretaría General de la UNASAM',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'COPIA DE CERTIFICADO DE ESTUDIOS, autenticado por la Secretaría General de la UNASAM',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'COPIA DE DNI (legalizado)',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'COPIA DE CONSTANCIA DE PRIMERA MATRÍCULA',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'COPIA DE CONSTANCIA DE FECHA EXACTA DE EGRESO',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'INCORPORAR LA HOJA DE RENATI, CON RÚBRICA EN DIGITAL E IMPRESO COMO PARTE DEL ANEXO EN LA TESIS. (incorporar impreso para el expediente)',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'CONSTANCIA DE NO ADEUDAR BIENES Y/O VALORES A LA FACULTAD',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'CONSTANCIA DE NO ADEUDO A LA BIBLIOTECA CENTRAL DE LA UNASAM',
                'proceso_id' => 5 // 5: Titulo Profesional (Tabla: Procesos)
            ],
            [
                'nombre' => 'DOS (02) FOTOGRAFÍAS DE FRENTE, TAMAÑO PASAPORTE A COLORES CON FONDO BLANCO, RECIENTES',
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
