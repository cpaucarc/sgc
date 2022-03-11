<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntradaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $entradas = [
            // Enseñanza Aprendizaje
            [
                'codigo' => 'E1',
                'nombre' => 'Informe de evaluación E-A del semestre anterior',
                'proceso_id' => 1
            ], //id: 1
            [
                'codigo' => 'E2',
                'nombre' => 'POI asignado',
                'proceso_id' => 1
            ], //id: 2
            [
                'codigo' => 'E3',
                'nombre' => 'Plan Estratégico Escuela',
                'proceso_id' => 1
            ], //id: 3
            [
                'codigo' => 'E4',
                'nombre' => 'Reglamento de la Programación, Ejecución y Control de las Actividades Académicas',
                'proceso_id' => 1
            ], //id: 4
            [
                'codigo' => 'E5',
                'nombre' => 'Modelo educativo',
                'proceso_id' => 1
            ], //id: 5
            [
                'codigo' => 'E6',
                'nombre' => 'Guía de elaboración de silabo',
                'proceso_id' => 1
            ], //id: 6
            [
                'codigo' => 'E7',
                'nombre' => 'Lista de Libros de consulta (Bibliografía)',
                'proceso_id' => 1
            ], //id: 7
            [
                'codigo' => 'E8',
                'nombre' => 'Plan de trabajo de E-A aprobado',
                'proceso_id' => 1
            ], //id: 8
            [
                'codigo' => 'E9',
                'nombre' => 'Guía de investigación formativa',
                'proceso_id' => 1
            ], //id: 9
            [
                'codigo' => 'E10',
                'nombre' => 'Esquema de sesión de aprendizaje',
                'proceso_id' => 1
            ], //id: 10
            [
                'codigo' => 'E11',
                'nombre' => 'Formato de entrega de silabo',
                'proceso_id' => 1
            ], //id: 11
            [
                'codigo' => 'E12',
                'nombre' => 'Formato de avance de silabo',
                'proceso_id' => 1
            ], //id: 12
            [
                'codigo' => 'E13',
                'nombre' => 'Formato de asistencia de estudiantes',
                'proceso_id' => 1
            ], //id: 13
            [
                'codigo' => 'E14',
                'nombre' => 'Procedimiento Tutoría',
                'proceso_id' => 1
            ], //id: 14
            [
                'codigo' => 'E15',
                'nombre' => 'Procedimiento de Supervisión al desempeño docente',
                'proceso_id' => 1
            ], //id: 15
            [
                'codigo' => 'E16',
                'nombre' => 'Formato de registro de notas',
                'proceso_id' => 1
            ], //id: 16
            [
                'codigo' => 'E17',
                'nombre' => 'Procedimiento medir',
                'proceso_id' => 1
            ], //id: 17
            [
                'codigo' => 'E18',
                'nombre' => 'Procedimiento analizar',
                'proceso_id' => 1
            ], //id: 18
            [
                'codigo' => 'E19',
                'nombre' => 'Lista de indicadores de E-A',
                'proceso_id' => 1
            ], //id: 19
            [
                'codigo' => 'E20',
                'descripcion' => 'Procedimiento mejorar',
                'proceso_id' => 1
            ], //id: 20
            [
                'codigo' => 'E21',
                'nombre' => 'Formato de Plan de mejora',
                'proceso_id' => 1
            ], //id: 21
            [
                'codigo' => 'E22',
                'nombre' => 'Informe de evaluación de E-A',
                'proceso_id' => 1
            ], //id: 22
            [
                'codigo' => 'E23',
                'nombre' => 'Procedimiento Comunicar a interesados',
                'proceso_id' => 1
            ], //id: 23

            // Gestion de la calidad
            [
                'codigo' => 'E1',
                'nombre' => 'Plan de gestión de calidad institucional',
                'proceso_id' => 11
            ], //id: 24
            [
                'codigo' => 'E2',
                'nombre' => 'Resolución de designación de comité de calidad en los programas de estudio',
                'proceso_id' => 11
            ], //id: 25
            [
                'codigo' => 'E3',
                'nombre' => 'Plan de trabajo con fines de acreditación',
                'proceso_id' => 11
            ], //id: 26
            [
                'codigo' => 'E4',
                'nombre' => 'Fuentes de verificación recogidas',
                'proceso_id' => 11
            ], //id: 27
            [
                'codigo' => 'E5',
                'nombre' => 'Informe de autoevaluación preliminar',
                'proceso_id' => 11
            ], //id: 28
            [
                'codigo' => 'E6',
                'nombre' => 'Plan de mejora',
                'proceso_id' => 11
            ], //id: 29
            [
                'codigo' => 'E7',
                'nombre' => 'Reportes del avance de implementación de acciones de mejora',
                'proceso_id' => 11
            ], //id: 30
            [
                'codigo' => 'E8',
                'nombre' => 'Propuestas de Entidades Evaluadoras Externas',
                'proceso_id' => 11
            ], //id: 31
            [
                'codigo' => 'E9',
                'nombre' => 'Informe de autoevaluación final',
                'proceso_id' => 11
            ], //id: 32
            [
                'codigo' => 'E10',
                'nombre' => 'Propuesta de Entidad Evaluadora Externa seleccionada',
                'proceso_id' => 11
            ], //id: 33
            [
                'codigo' => 'E11',
                'nombre' => 'Oficio de programación de visita',
                'proceso_id' => 11
            ], //id: 34
            [
                'codigo' => 'E12',
                'nombre' => 'Cronograma de atención a evaluadores externos',
                'proceso_id' => 11
            ], //id: 35
            [
                'codigo' => 'E13',
                'nombre' => 'Oficio de observaciones',
                'proceso_id' => 11
            ], //id: 36
            [
                'codigo' => 'E14',
                'nombre' => 'Resolución de Otorgamiento de acreditación',
                'proceso_id' => 11
            ], //id: 37
            [
                'codigo' => 'E15',
                'nombre' => 'Procedimiento medir',
                'proceso_id' => 11
            ], //id: 38
            [
                'codigo' => 'E16',
                'nombre' => 'Procedimiento analizar',
                'proceso_id' => 11
            ], //id: 39
            [
                'codigo' => 'E17',
                'nombre' => 'Informe de evaluación del proceso de acreditación del semestre anterior',
                'proceso_id' => 11
            ], //id: 40
            [
                'codigo' => 'E18',
                'nombre' => 'Procedimiento mejorar',
                'proceso_id' => 11
            ], //id: 41
            [
                'codigo' => 'E19',
                'nombre' => 'Formato plan de mejora',
                'proceso_id' => 11
            ], //id: 42
            [
                'codigo' => 'E20',
                'nombre' => 'Informe de evaluación del proceso de acreditación',
                'proceso_id' => 11
            ], //id: 43
            [
                'codigo' => 'E21',
                'nombre' => 'Acciones y/o plan de mejora',
                'proceso_id' => 11
            ], //id: 44
            [
                'codigo' => 'E22',
                'nombre' => 'Procedimiento comunicar a interesados',
                'proceso_id' => 11
            ], //id: 45
            [
                'codigo' => 'E23',
                'nombre' => 'Integrantes del Comité de Calidad',
                'proceso_id' => 11
            ], //id: 46

            // Plan de estudios
            [
                'codigo' => 'E24',
                'nombre' => 'Directiva de diseño del Plan de estudios',
                'proceso_id' => 10
            ], //id: 47
            [
                'codigo' => 'E25',
                'nombre' => 'Propuesta de Comisión de Diseño del Plan de Estudios',
                'proceso_id' => 10
            ], //id: 48
            [
                'codigo' => 'E26',
                'nombre' => 'Informe de Gestión del Plan de Estudios del periodo anterior',
                'proceso_id' => 10
            ], //id: 49
            [
                'codigo' => 'E27',
                'nombre' => 'Modelo de acreditación de SINEACE',
                'proceso_id' => 10
            ], //id: 50
            [
                'codigo' => 'E28',
                'nombre' => 'Propuesta de Plan de Diseño del Plan de Estudios',
                'proceso_id' => 10
            ], //id: 51
            [
                'codigo' => 'E29',
                'nombre' => 'Plan de Diseño del Plan de Estudios aprobado',
                'proceso_id' => 10
            ], //id: 52
            [
                'codigo' => 'E30',
                'nombre' => 'Directiva de actualización del Plan de estudios',
                'proceso_id' => 10
            ], //id: 53
            [
                'codigo' => 'E31',
                'nombre' => 'Propuesta de Comisión de Evaluación y Actualización del Plan de Estudios',
                'proceso_id' => 10
            ], //id: 54
            [
                'codigo' => 'E32',
                'nombre' => ' Informe de diseño del plan de estudios',
                'proceso_id' => 10
            ], //id: 55
            [
                'codigo' => 'E33',
                'nombre' => 'Modelo de acreditación de SINEACE',
                'proceso_id' => 10
            ], //id: 56
            [
                'codigo' => 'E34',
                'nombre' => 'Propuesta de Plan de Evaluación y Actualización del Plan de Estudios',
                'proceso_id' => 10
            ], //id: 57
            [
                'codigo' => 'E35',
                'nombre' => 'Plan de Evaluación y Actualización del Plan de Estudios',
                'proceso_id' => 10
            ], //id: 58
            [
                'codigo' => 'E36',
                'nombre' => 'Propuesta de Plan de Estudios actualizado',
                'proceso_id' => 10
            ], //id: 59
            [
                'codigo' => 'E37',
                'nombre' => 'Informe de revisión de Propuesta de Plan de Estudios actualizado',
                'proceso_id' => 10
            ], //id: 60
            [
                'codigo' => 'E38',
                'nombre' => 'Plan de Estudios actualizado',
                'proceso_id' => 10
            ], //id: 61
            [
                'codigo' => 'E39',
                'nombre' => 'Plan de implementación del PE actualizado aprobado',
                'proceso_id' => 10
            ], //id: 62
            [
                'codigo' => 'E40',
                'nombre' => 'Informe de implementación del Plan de Estudios actualizado',
                'proceso_id' => 10
            ], //id: 63
            [
                'codigo' => 'E41',
                'nombre' => 'Informe de seguimiento de la implementación del Plan de estudios actualizado',
                'proceso_id' => 10
            ], //id: 64
            [
                'codigo' => 'E42',
                'nombre' => 'Acciones de mejora',
                'proceso_id' => 10
            ], //id: 65
            [
                'codigo' => 'E43',
                'nombre' => 'Procedimiento medir',
                'proceso_id' => 10
            ], //id: 66
            [
                'codigo' => 'E44',
                'nombre' => 'Procedimiento analizar',
                'proceso_id' => 10
            ], //id: 67
            [
                'codigo' => 'E45',
                'nombre' => 'Informe de evaluación del proceso de Gestión del Plan de Estudios',
                'proceso_id' => 10
            ], //id: 68
            [
                'codigo' => 'E46',
                'nombre' => 'Procedimiento mejorar',
                'proceso_id' => 10
            ], //id: 69
            [
                'codigo' => 'E47',
                'nombre' => 'Formato plan de mejora',
                'proceso_id' => 10
            ], //id: 70
            [
                'codigo' => 'E48',
                'nombre' => 'Acciones y/o Plan de mejora',
                'proceso_id' => 10
            ], //id: 71
            [
                'codigo' => 'E49',
                'nombre' => 'Procedimiento comunicar a interesados',
                'proceso_id' => 10
            ], //id: 72

        ];

        \App\Models\Entrada::insert($entradas);
    }
}
