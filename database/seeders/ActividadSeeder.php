<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actividades = [
            //Enseñanza - Aprendizaje
            [
                'nombre' => 'Planificar la gestión de Enseñanza - Aprendizaje',
                'tipo_actividad_id' => 1,
                'proceso_id' => 1,
            ], //id:1
            [
                'nombre' => 'Elaborar y publicar silabo',
                'tipo_actividad_id' => 2,
                'proceso_id' => 1,
            ], //id:2
            [
                'nombre' => 'Requerir recursos',
                'tipo_actividad_id' => 2,
                'proceso_id' => 1,
            ], //id:3
            [
                'nombre' => 'Desarrollar sesiones de clase',
                'tipo_actividad_id' => 2,
                'proceso_id' => 1,
            ], //id:4
            [
                'nombre' => 'Realizar Tutoría',
                'tipo_actividad_id' => 2,
                'proceso_id' => 1,
            ], //id:5
            [
                'nombre' => 'Evaluar desempeño del estudiante',
                'tipo_actividad_id' => 2,
                'proceso_id' => 1,
            ], //id:6
            [
                'nombre' => 'Evaluar desempeño del docente',
                'tipo_actividad_id' => 2,
                'proceso_id' => 1,
            ], //id:7
            [
                'nombre' => 'Cierre de Semestre Académico',
                'tipo_actividad_id' => 2,
                'proceso_id' => 1,
            ], //id:8
            [
                'nombre' => 'Evaluar proceso E-A',
                'tipo_actividad_id' => 3,
                'proceso_id' => 1,
            ], //id:9
            [
                'nombre' => 'Mejorar proceso E-A',
                'tipo_actividad_id' => 4,
                'proceso_id' => 1,
            ], //id:10
            [
                'nombre' => 'Comunicar a interesados',
                'tipo_actividad_id' => 2,
                'proceso_id' => 1,
            ], //id:11

            // Gestion de Calidad
            [
                'nombre' => 'Proponer Comité de Calidad',
                'tipo_actividad_id' => 1, // 1:P 2:H 3:V 4:A
                'proceso_id' => 11,
            ], //id:12
            [
                'nombre' => 'Aprobar del comité de calidad en los programas de estudio',
                'tipo_actividad_id' => 1, // 1:P 2:H 3:V 4:A
                'proceso_id' => 11,
            ], //id:13
            [
                'nombre' => 'Elaborar el Plan de trabajo con fines de acreditación',
                'tipo_actividad_id' => 1, // 1:P 2:H 3:V 4:A
                'proceso_id' => 11,
            ], //id:14
            [
                'nombre' => 'Realizar la autoevaluación.',
                'tipo_actividad_id' => 2, // 1:P 2:H 3:V 4:A
                'proceso_id' => 11,
            ], //id:15
            [
                'nombre' => 'Elaborar del informe de autoevaluación y plan de mejora.',
                'tipo_actividad_id' => 2, // 1:P 2:H 3:V 4:A
                'proceso_id' => 11,
            ], //id:16
            [
                'nombre' => 'Inscribir a los comités de autoevaluación ante el SINEACE.',
                'tipo_actividad_id' => 2, // 1:P 2:H 3:V 4:A
                'proceso_id' => 11,
            ], //id:17
            [
                'nombre' => 'Implementar plan de mejora.',
                'tipo_actividad_id' => 2, // 1:P 2:H 3:V 4:A
                'proceso_id' => 11,
            ], //id:18
            [
                'nombre' => 'Realizar la 2da. autoevaluación.',
                'tipo_actividad_id' => 2, // 1:P 2:H 3:V 4:A
                'proceso_id' => 11,
            ], //id:19
            [
                'nombre' => 'Contratar la agencia evaluadora externa',
                'tipo_actividad_id' => 2, // 1:P 2:H 3:V 4:A
                'proceso_id' => 11,
            ], //id:20
            [
                'nombre' => 'Solicita evaluación de acreditación al SINEACE (revisa el expediente  que contenga el informe final)',
                'tipo_actividad_id' => 2, // 1:P 2:H 3:V 4:A
                'proceso_id' => 11,
            ], //id:21
            [
                'nombre' => 'Atender visita de evaluadores externos',
                'tipo_actividad_id' => 2, // 1:P 2:H 3:V 4:A
                'proceso_id' => 11,
            ], //id:22
            [
                'nombre' => 'Subsanar observaciones',
                'tipo_actividad_id' => 2, // 1:P 2:H 3:V 4:A
                'proceso_id' => 11,
            ], //id:23
            [
                'nombre' => 'Comunicar otorgamiento de acreditación',
                'tipo_actividad_id' => 2, // 1:P 2:H 3:V 4:A
                'proceso_id' => 11,
            ], //id:24
            [
                'nombre' => 'Evaluar proceso de acreditación',
                'tipo_actividad_id' => 3, // 1:P 2:H 3:V 4:A
                'proceso_id' => 11,
            ], //id:25
            [
                'nombre' => 'Mejorar proceso de acreditación',
                'tipo_actividad_id' => 4, // 1:P 2:H 3:V 4:A
                'proceso_id' => 11,
            ], //id:26
            [
                'nombre' => 'Comunicación a los interesados',
                'tipo_actividad_id' => 4, // 1:P 2:H 3:V 4:A
                'proceso_id' => 11,
            ], //id:27
        ];

        \App\Models\Actividad::insert($actividades);
    }
}
