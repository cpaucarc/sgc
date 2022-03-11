<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $salidas = [
            //Enseñanza - Aprendizaje
            [
                'codigo' => 'S1',
                'nombre' => 'Plan de trabajo de E-A aprobado',
                'proceso_id' => 1
            ], // id: 1
            [
                'codigo' => 'S2',
                'nombre' => 'Silabo de la asignatura aprobado',
                'proceso_id' => 1
            ], // id: 2
            [
                'codigo' => 'S3',
                'nombre' => 'Silabo publicado',
                'proceso_id' => 1
            ], // id: 3
            [
                'codigo' => 'S4',
                'nombre' => 'Requerimiento de recursos',
                'proceso_id' => 1
            ], // id: 4
            [
                'codigo' => 'S5',
                'nombre' => 'Plan de prácticas de la asignatura',
                'proceso_id' => 1
            ], // id: 5
            [
                'codigo' => 'S6',
                'nombre' => 'Registro de entrega del sílabo a los estudiantes',
                'proceso_id' => 1
            ], // id: 6
            [
                'codigo' => 'S7',
                'nombre' => 'Registro de entrega de material de clases',
                'proceso_id' => 1
            ], // id: 7
            [
                'codigo' => 'S8',
                'nombre' => 'Registro de formato de avance silábico',
                'proceso_id' => 1
            ], // id: 8
            [
                'codigo' => 'S9',
                'nombre' => 'Plan de responsabilidad social',
                'proceso_id' => 1
            ], // id: 9
            [
                'codigo' => 'S10',
                'nombre' => 'Lista de grupos de práctica',
                'proceso_id' => 1
            ], // id: 10
            [
                'codigo' => 'E11',
                'nombre' => 'Informe de Tutoría',
                'proceso_id' => 1
            ], // id: 11
            [
                'codigo' => 'E12',
                'nombre' => 'Registro de notas',
                'proceso_id' => 1
            ], // id: 12
            [
                'codigo' => 'S13',
                'nombre' => 'Informe de evaluación docente',
                'proceso_id' => 1
            ], // id: 13
            [
                'codigo' => 'S14',
                'nombre' => 'Pre actas firmadas',
                'proceso_id' => 1
            ], // id: 14
            [
                'codigo' => 'S15',
                'nombre' => 'Actas firmadas',
                'proceso_id' => 1
            ], // id: 15
            [
                'codigo' => 'S16',
                'nombre' => 'Informe de situación académica del estudiante',
                'proceso_id' => 1
            ], // id: 16
            [
                'codigo' => 'S17',
                'nombre' => 'Informe de evaluación de E-A',
                'proceso_id' => 1
            ], // id: 17
            [
                'codigo' => 'S18',
                'nombre' => 'Resultado de los indicadores',
                'proceso_id' => 1
            ], // id: 18
            [
                'codigo' => 'S19',
                'nombre' => 'Acciones y/o Plan de mejora',
                'proceso_id' => 1
            ], // id: 19
            [
                'codigo' => 'S20',
                'nombre' => 'Registro y envío de comunicaciones',
                'proceso_id' => 1
            ], // id: 20

            // Todo Gestion de la Calidad
            [
                'codigo' => 'S1',
                'nombre' => 'Resolución de designación de comités de calidad en los programas de estudio',
                'proceso_id' => 11
            ], // id: 21
            [
                'codigo' => 'S2',
                'nombre' => 'Plan de trabajo con fines de acreditación',
                'proceso_id' => 11
            ], // id: 22
            [
                'codigo' => 'S3',
                'nombre' => 'Fuentes de verificación recogidas',
                'proceso_id' => 11
            ], // id: 23
            [
                'codigo' => 'S4',
                'nombre' => 'Informe de autoevaluación preliminar',
                'proceso_id' => 11
            ], // id: 24
            [
                'codigo' => 'S5',
                'nombre' => 'Plan de mejora',
                'proceso_id' => 11
            ], // id: 25
            [
                'codigo' => 'S6',
                'nombre' => 'Código único de identificación',
                'proceso_id' => 11
            ], // id: 26
            [
                'codigo' => 'S7',
                'nombre' => 'Reportes del avance de implementación de acciones de mejora',
                'proceso_id' => 11
            ], // id: 27
            [
                'codigo' => 'S8',
                'nombre' => 'Informe de autoevaluación final',
                'proceso_id' => 11
            ], // id: 28
            [
                'codigo' => 'S9',
                'nombre' => 'Contrato con agencia evaluadora',
                'proceso_id' => 11
            ], // id: 29
            [
                'codigo' => 'S10',
                'nombre' => 'Oficio de programación de visita',
                'proceso_id' => 11
            ], // id: 30
            [
                'codigo' => 'S11',
                'nombre' => 'Lista de observaciones',
                'proceso_id' => 11
            ], // id: 31
            [
                'codigo' => 'S12',
                'nombre' => 'Informe de levantamiento de observaciones',
                'proceso_id' => 11
            ], // id: 32
            [
                'codigo' => 'S13',
                'nombre' => 'Comunicar a los interesados el Otorgamiento de acreditación',
                'proceso_id' => 11
            ], // id: 33
            [
                'codigo' => 'S14',
                'nombre' => 'Resultado de los indicadores',
                'proceso_id' => 11
            ], // id: 34
            [
                'codigo' => 'S15',
                'nombre' => 'Informe del proceso de acreditación',
                'proceso_id' => 11
            ], // id: 35
            [
                'codigo' => 'S16',
                'nombre' => 'Acciones y/o Plan de mejora',
                'proceso_id' => 11
            ], // id: 36
            [
                'codigo' => 'S17',
                'nombre' => 'Registro y envío de comunicaciones',
                'proceso_id' => 11
            ], // id: 37
            [
                'codigo' => 'S18',
                'nombre' => 'Propuesta de integrantes del Comité de Calidad',
                'proceso_id' => 11
            ], // id: 38

            // Plan de estudios
            [
                'codigo' => 'S19',
                'nombre' => 'Propuesta de Comisión de Diseño del Plan de Estudios',
                'proceso_id' => 10
            ], // id: 39
            [
                'codigo' => 'S20',
                'nombre' => 'Resolución de la Conformación de la Comisión de Diseño del Plan de Estudios',
                'proceso_id' => 10
            ], // id: 40
            [
                'codigo' => 'S21',
                'nombre' => 'Propuesta de Plan de Diseño del Plan de Estudios',
                'proceso_id' => 10
            ], // id: 41
            [
                'codigo' => 'S22',
                'nombre' => 'Plan de Diseño del Plan de Estudios aprobado',
                'proceso_id' => 10
            ], // id: 42
            [
                'codigo' => 'S23',
                'nombre' => 'Informe de diseño del plan de estudios',
                'proceso_id' => 10
            ], // id: 43
            [
                'codigo' => 'S24',
                'nombre' => 'Propuesta de Comisión de Evaluación y Actualización del Plan de Estudios',
                'proceso_id' => 10
            ], // id: 44
            [
                'codigo' => 'S25',
                'nombre' => 'Resolución de la Conformación de la Comisión de Evaluación y Actualización del Plan de Estudios',
                'proceso_id' => 10
            ], // id: 45
            [
                'codigo' => 'S26',
                'nombre' => 'Propuesta de Plan de Evaluación y Actualización del Plan de Estudios',
                'proceso_id' => 10
            ], // id: 46
            [
                'codigo' => 'S27',
                'nombre' => 'Plan de Evaluación y Actualización del Plan de Estudios aprobado',
                'proceso_id' => 10
            ], // id: 47
            [
                'codigo' => 'S28',
                'nombre' => 'Informe de evaluación de Plan de Estudios',
                'proceso_id' => 10
            ], // id: 48
            [
                'codigo' => 'S29',
                'nombre' => 'Propuesta de Plan de Estudios actualizado',
                'proceso_id' => 10
            ], // id: 49
            [
                'codigo' => 'S30',
                'nombre' => 'Informe de revisión de Propuesta de Plan de Estudios actualizado',
                'proceso_id' => 10
            ], // id: 50
            [
                'codigo' => 'S31',
                'nombre' => 'Resolución de aprobación de Plan de Estudios',
                'proceso_id' => 10
            ], // id: 51
            [
                'codigo' => 'S32',
                'nombre' => 'Plan de estudios actualizado aprobado',
                'proceso_id' => 10
            ], // id: 52
            [
                'codigo' => 'S33',
                'nombre' => 'Plan de implementación del Plan de Estudios actualizado',
                'proceso_id' => 10
            ], // id: 53
            [
                'codigo' => 'S34',
                'nombre' => 'Informe de implementación del Plan de Estudios actualizado',
                'proceso_id' => 10
            ], // id: 54
            [
                'codigo' => 'S35',
                'nombre' => 'Informe de seguimiento de la implementación del Plan de estudios actualizado',
                'proceso_id' => 10
            ], // id: 55
            [
                'codigo' => 'S36',
                'nombre' => 'Acciones de mejora',
                'proceso_id' => 10
            ], // id: 56
            [
                'codigo' => 'S37',
                'nombre' => 'Registro y envío de comunicaciones de los resultados de implementación de estudios',
                'proceso_id' => 10
            ], // id: 57
            [
                'codigo' => 'S38',
                'nombre' => 'Resultado de los indicadores',
                'proceso_id' => 10
            ], // id: 58
            [
                'codigo' => 'S39',
                'nombre' => 'Informe de evaluación del proceso de Gestión del Plan de Estudios',
                'proceso_id' => 10
            ], // id: 59
            [
                'codigo' => 'S40',
                'nombre' => 'Informe de Gestión del Plan de Estudios',
                'proceso_id' => 10
            ], // id: 60
            [
                'codigo' => 'S41',
                'nombre' => 'Acciones y/o Plan de mejora',
                'proceso_id' => 10
            ], // id: 61
            [
                'codigo' => 'S42',
                'nombre' => 'Registro y envío de comunicaciones',
                'proceso_id' => 10
            ], // id: 62
        ];

        \App\Models\Salida::insert($salidas);
    }
}
