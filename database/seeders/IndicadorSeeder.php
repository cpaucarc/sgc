<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndicadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $indicadores = [
            //ToDo: 2 RESPONSABILIDAD SOCIAL
            //IND-048
            [
                'objetivo' => 'Conocer el número de estudiantes que participan en proyectos de responsabilidad social.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'N° estudiantes que realizan RSU',
                'cod_ind_inicial' => 'IND-048',
                'formula' => 'X = N° de estudiantes que realizan RSU por programa',
                'minimo' => 10,
                'satisfactorio' => 20,
                'sobresaliente' => 40,
                'proceso_id' => 9,
                'unidad_medida_id' => 1,
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-049
            [
                'objetivo' => 'Conocer el número de docentes que participan en proyectos de responsabilidad social.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'N° docentes que realizan RSU',
                'cod_ind_inicial' => 'IND-049',
                'formula' => 'X = N° de docentes que realizan RSU por programa',
                'minimo' => 10,
                'satisfactorio' => 20,
                'sobresaliente' => 40,
                'proceso_id' => 9,
                'unidad_medida_id' => 1,
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-050
            [
                'objetivo' => 'Medir el grado de participación de los docentes en responsabilidad social',
                'titulo_interes' => 'N° docentes en RSU',
                'titulo_total' => 'N° total de docentes',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-050',
                'formula' => 'X = (N° de docentes que realizan RSU)/(Total de docentes por programa) x 100',
                'minimo' => 25,
                'satisfactorio' => 50,
                'sobresaliente' => 80,
                'proceso_id' => 9,
                'unidad_medida_id' => 2,
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-051
            [
                'objetivo' => 'Medir el grado de participación de los estudiantes en responsabilidad social',
                'titulo_interes' => 'N° estudiantes en RSU',
                'titulo_total' => 'N° total de estudiantes',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-051',
                'formula' => 'X = (N° de estudiantes que realizan RSU)/(Total de estudiantes por programa) x 100',
                'minimo' => 20,
                'satisfactorio' => 40,
                'sobresaliente' => 80,
                'proceso_id' => 9,
                'unidad_medida_id' => 2,
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-052
            [
                'objetivo' => 'Conocer el número de proyectos que realizan RSU por programa de estudios.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'N° proyectos de RSU',
                'cod_ind_inicial' => 'IND-052',
                'formula' => 'X = N° de proyectos de RSU por programa',
                'minimo' => 5,
                'satisfactorio' => 10,
                'sobresaliente' => 20,
                'proceso_id' => 9,
                'unidad_medida_id' => 1,
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-053
            [
                'objetivo' => 'Medir el porcentaje de satisfacción de los usuarios de responsabilidad social por programa de estudios',
                'titulo_interes' => 'N° usuarios satisfechos',
                'titulo_total' => 'N° de encuestados',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-053',
                'formula' => 'X = (Total satisfechos por RSU)/(Total de encuestados por RSU ) x 100',
                'minimo' => 20,
                'satisfactorio' => 40,
                'sobresaliente' => 80,
                'proceso_id' => 9,
                'unidad_medida_id' => 2,
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],

            //ToDo: 3 INVESTIGACION
            //IND-044
            [
                'objetivo' => 'Medir el grado de participación de los docentes en los proyectos de investigación.',
                'titulo_interes' => 'N° Docentes en PI',
                'titulo_total' => 'N° Docentes',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-044',
                'formula' => 'X = (N° de docentes que participan en PI)/(Total de docentes del programa) x 100',
                'minimo' => 20,
                'satisfactorio' => 30,
                'sobresaliente' => 50,
                'proceso_id' => 8, //DB: procesos: 8:Investigacion
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-045
            [
                'objetivo' => 'Medir el grado de participación de los estudiantes en los proyectos de investigación.',
                'titulo_interes' => 'N° estudiantes en PI',
                'titulo_total' => 'N° estudiantes',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-045',
                'formula' => 'X = (N° de estudiantes que participan en PI)/(Total de estudiantes del programa) x 100',
                'minimo' => 0.5,
                'satisfactorio' => 1,
                'sobresaliente' => 2,
                'proceso_id' => 8, //DB: procesos: 8:Investigacion
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-046
            [
                'objetivo' => 'Saber el número de trabajos de investigación publicados por programa de estudios.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'Número trabajos de investigación publicados',
                'cod_ind_inicial' => 'IND-046',
                'formula' => 'X = N° de trabajos de investigación publicados por programa de estudios',
                'minimo' => 2,
                'satisfactorio' => 4,
                'sobresaliente' => 6,
                'proceso_id' => 8, //DB: procesos: 8:Investigacion
                'unidad_medida_id' => 1, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-047
            [
                'objetivo' => 'Conocer el número de Proyectos de investigacion presentados por programa de estudios.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'N° de proyectos de investigación',
                'cod_ind_inicial' => 'IND-047',
                'formula' => 'X = N° de Proyectos de invetigacion presentados por programa',
                'minimo' => 2,
                'satisfactorio' => 4,
                'sobresaliente' => 6,
                'proceso_id' => 8, //DB: procesos: 8:Investigacion
                'unidad_medida_id' => 1, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],

            //ToDo: 4 BACHILLER
            //IND-058
            [
                'objetivo' => 'Medir el porcentaje de egresados que obtienen el grado de bachiller.',
                'titulo_interes' => 'N° de Bachilleres',
                'titulo_total' => 'N° de egresados',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-058',
                'formula' => 'X = (N° de bachilleres)/(Total de egresados del programa) x 100',
                'minimo' => 60,
                'satisfactorio' => 80,
                'sobresaliente' => 90,
                'proceso_id' => 12, //DB: procesos: 12: Bachiller
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],

            //ToDo: 5 TITULOS PROFESIONALES
            //IND-059
            [
                'objetivo' => 'Medir el porcentaje de titulados por programa de estudios.',
                'titulo_interes' => 'N° de titulados',
                'titulo_total' => 'N° de bachilleres',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-059',
                'formula' => 'X = (N° de egresados que logran titularse)/(Total de graduados en bachiller por  programa) x 100',
                'minimo' => 70,
                'satisfactorio' => 80,
                'sobresaliente' => 98,
                'proceso_id' => 5, //DB: procesos: 5: Titulo Profesional
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-060
            [
                'objetivo' => 'Conocer la cantidad de titulados por programa de estudios.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'N° de titulados',
                'cod_ind_inicial' => 'IND-060',
                'formula' => 'X = N° de titulados por programa de estudios',
                'minimo' => 30,
                'satisfactorio' => 40,
                'sobresaliente' => 95,
                'proceso_id' => 5, //DB: procesos: 5: Titulo Profesional
                'unidad_medida_id' => 1, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-061
            [
                'objetivo' => 'Medir el porcentaje de proyectos de investigación aprobados por programa de estudios.',
                'titulo_interes' => 'N° de proyectos de investigación aprobados',
                'titulo_total' => 'N° de proyectos de investigación presentados',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-061',
                'formula' => 'X = (N° de proyectos de investigación aprobados)/(Total de PI presentados por  programa) x 100',
                'minimo' => 30,
                'satisfactorio' => 50,
                'sobresaliente' => 90,
                'proceso_id' => 5, //DB: procesos: 5: Titulo Profesional
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],

            //ToDo: 6 PLAN DE ESTUDIOS
            //No hay

            //ToDo: 7 CONVALIDACIONES
            //IND-024
            [
                'objetivo' => 'Conocer la cantidad de convalidaciones realizadas por programa de estudios.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'N° de convalidaciones',
                'cod_ind_inicial' => 'IND-024',
                'formula' => 'X = N° de convalidaciones realizadas por programa',
                'minimo' => 1,
                'satisfactorio' => 2,
                'sobresaliente' => 3,
                'proceso_id' => 16, //DB: procesos: 16: Convalidaciones
                'unidad_medida_id' => 1, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-025
            [
                'objetivo' => 'Conocer el número de vacantes para convalidación por programa de estudios.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'N° de vacantes para convalidaciones',
                'cod_ind_inicial' => 'IND-025',
                'formula' => 'X = N° vacantes para convalidacion por programa de estudio',
                'minimo' => 1,
                'satisfactorio' => 2,
                'sobresaliente' => 3,
                'proceso_id' => 16, //DB: procesos: 16: Convalidaciones
                'unidad_medida_id' => 1, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-026
            [
                'objetivo' => 'Medir el grado de demanda de convalidación por programa de estudios.',
                'titulo_interes' => 'N° de postulantes',
                'titulo_total' => 'N° de vacantes',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-026',
                'formula' => 'X = (N° de postulantes para convalidar por programa)/(Total de vacantes para convalidar por programa) x 100',
                'minimo' => 0,
                'satisfactorio' => 0,
                'sobresaliente' => 0,
                'proceso_id' => 16, //DB: procesos: 16: Convalidaciones
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],

            //ToDo: 8 GESTION DE CALIDAD
            //IND-001
            [
                'objetivo' => 'Medir el porcentaje de avance mensual de las actividades programadas en el plan de trabajo.',
                'titulo_interes' => 'N° actividades cumplidas',
                'titulo_total' => 'N° actividades programadas',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-001',
                'formula' => 'X = (N° de actividades cumplidas)/(Total de actividades programadas) x 100',
                'minimo' => 20,
                'satisfactorio' => 25,
                'sobresaliente' => 30,
                'proceso_id' => 11, //DB: procesos: 11: Gestion de Calidad
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-068
            [
                'objetivo' => 'Conocer el porcentaje de indicadores que se encuentra en estado malo.',
                'titulo_interes' => 'N° indicadores con estado malo',
                'titulo_total' => 'N° total de indicadores',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-068',
                'formula' => 'X=(N° de indicadores con estado malo)/(Total de indicadores evaluados) x 100',
                'minimo' => 5,
                'satisfactorio' => 10,
                'sobresaliente' => 15,
                'proceso_id' => 11, //DB: procesos: 11: Gestion de Calidad
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-069
            [
                'objetivo' => 'Conocer la cantidad de auditoria de calidad realizadas.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'N° auditorias realizadas',
                'cod_ind_inicial' => 'IND-069',
                'formula' => 'X = N° de auditorias de calidad realizadas',
                'minimo' => 25,
                'satisfactorio' => 30,
                'sobresaliente' => 39,
                'proceso_id' => 11, //DB: procesos: 11: Gestion de Calidad
                'unidad_medida_id' => 1, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-070
            [
                'objetivo' => 'Medir el avance mensual de ejecución del plan de mejora.',
                'titulo_interes' => 'N° actividades cumplidas',
                'titulo_total' => 'N° actividades programadas',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-070',
                'formula' => 'X = (N° de actividades cumplidas)/(Total de actividades programadas) x 100',
                'minimo' => 5,
                'satisfactorio' => 10,
                'sobresaliente' => 20,
                'proceso_id' => 11, //DB: procesos: 11: Gestion de Calidad
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 1,
                'frecuencia_reporte_id' => 1,
            ],
            //IND-071
            [
                'objetivo' => 'Conocer el porcentaje de quejas por el servicio educativo.',
                'titulo_interes' => 'N° Quejas',
                'titulo_total' => 'N° Encuestados',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-071',
                'formula' => 'X = (N° de quejas)/(Total de encuestados) x 100',
                'minimo' => 5,
                'satisfactorio' => 10,
                'sobresaliente' => 15,
                'proceso_id' => 11, //DB: procesos: 11: Gestion de Calidad
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],

            //ToDo: 9 BOLSA DE TRABAJO
            //IND-021
            [
                'objetivo' => 'Medir el porcentaje de usuarios beneficiados por el proceso de bolsa de trabajo.',
                'titulo_interes' => 'N° Beneficiados',
                'titulo_total' => 'N° Postulantes',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-021',
                'formula' => 'X = (N° de beneficiados por programa)/(Total de postulantes del programa) x 100',
                'minimo' => 0,
                'satisfactorio' => 0,
                'sobresaliente' => 0,
                'proceso_id' => 13, //DB: procesos: 13: Bolsa de Trabajo
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 1,
                'frecuencia_reporte_id' => 1,
            ],
            //IND-022
            [
                'objetivo' => 'Medir el grado de satisfacción de los usuarios del servicio de bolsa de trabajo.',
                'titulo_interes' => 'N° Usuarios Satisfechos',
                'titulo_total' => 'N° Total De Encuestados',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-022',
                'formula' => 'X = (N° usuarios satisfechos por programa)/(Total de encuestados por programa) x 100',
                'minimo' => 0,
                'satisfactorio' => 0,
                'sobresaliente' => 0,
                'proceso_id' => 13, //DB: procesos: 13: Bolsa de Trabajo
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 1,
                'frecuencia_reporte_id' => 1,
            ],
            //IND-023
            [
                'objetivo' => 'Medir el grado de satisfacción de los empleadores con el trabajo realizado por estudiantes contratados mediante el servicio de bolsa de trabajo.',
                'titulo_interes' => 'N° Usuarios Satisfechos',
                'titulo_total' => 'N° Total de Encuestados',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-023',
                'formula' => 'X = (N° usuarios satisfechos con trabajo de estudiantes)/(Total de encuestados por programa) x 100',
                'minimo' => 0,
                'satisfactorio' => 0,
                'sobresaliente' => 0,
                'proceso_id' => 13, //DB: procesos: 13: Bolsa de Trabajo
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 1,
                'frecuencia_reporte_id' => 1,
            ],

            //ToDo: 10 BIENESTRAR UNIVERSITARIO
            //IND-016
            [
                'objetivo' => 'Medir la satisfacción de los usuarios del servicio de bienestar universitario.',
                'titulo_interes' => 'N° Usuarios Satisfechos',
                'titulo_total' => 'N° Total de Encuestados',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-016',
                'formula' => 'X = (N° usuarios satisfechos por programa)/(Total de encuestados por programa) x 100',
                'minimo' => 50,
                'satisfactorio' => 80,
                'sobresaliente' => 100,
                'proceso_id' => 14, //DB: procesos: 14: Bienestar Universitario
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 1,
                'frecuencia_reporte_id' => 1,
            ],
            //IND-017
            [
                'objetivo' => 'Medir el porcentaje de comersales atendidos del total de comesales.',
                'titulo_interes' => 'N° Comensales Atendidos',
                'titulo_total' => 'N° Total de Comensales',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-017',
                'formula' => 'X = (N° de comensales atendidos por programa)/(Total de comensales por programa) x 100',
                'minimo' => 1,
                'satisfactorio' => 2,
                'sobresaliente' => 3,
                'proceso_id' => 14, //DB: procesos: 14: Bienestar Universitario
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 1,
                'frecuencia_reporte_id' => 1,
            ],
            //IND-019
            [
                'objetivo' => 'Conocer el número total de atenciones por servicios por programa de estudios.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'Total de atenciones',
                'cod_ind_inicial' => 'IND-019',
                'formula' => 'X = ∑ atenciones por servicio por programa',
                'minimo' => 20,
                'satisfactorio' => 50,
                'sobresaliente' => 100,
                'proceso_id' => 14, //DB: procesos: 14: Bienestar Universitario
                'unidad_medida_id' => 1, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 1,
                'frecuencia_reporte_id' => 1,
            ],
            //IND-020
            [
                'objetivo' => 'Medir la satisfacción de los usuarios del servicio de bienestar universitario.',
                'titulo_interes' => 'N° Usuarios Satisfechos',
                'titulo_total' => 'N° Total de Encuentados',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-020',
                'formula' => 'X = (N° usuarios satisfechos por programa)/(Total de encuestados por programa) x 100',
                'minimo' => 50,
                'satisfactorio' => 80,
                'sobresaliente' => 100,
                'proceso_id' => 14, //DB: procesos: 14: Bienestar Universitario
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 1,
                'frecuencia_reporte_id' => 1,
            ],

            //ToDo: 11 CONVENIO
            //IND-027
            [
                'objetivo' => 'Conocer la cantidad de convenios realizados.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'Convenios Realizados',
                'cod_ind_inicial' => 'IND-027',
                'formula' => 'X = N° de convenios realizados por programa',
                'minimo' => 70,
                'satisfactorio' => 80,
                'sobresaliente' => 90,
                'proceso_id' => 15, //DB: procesos: 15: Convenio
                'unidad_medida_id' => 1, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-028
            [
                'objetivo' => 'Conocer la cantidad de convenios vigentes.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'N° Convenios Vigentes',
                'cod_ind_inicial' => 'IND-028',
                'formula' => 'X = N° de convenios vigentes por programa',
                'minimo' => 70,
                'satisfactorio' => 80,
                'sobresaliente' => 90,
                'proceso_id' => 15, //DB: procesos: 15: Convenio
                'unidad_medida_id' => 1, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-029
            [
                'objetivo' => 'Medir el grado de cumplimiento de los convenios.',
                'titulo_interes' => 'N° Convenios Cumplidos',
                'titulo_total' => 'N° Convenios Vigentes',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-029',
                'formula' => 'X = (N° de convenios cumplidos por programa)/(Total de convenios vigentes por programa) x 100',
                'minimo' => 70,
                'satisfactorio' => 80,
                'sobresaliente' => 90,
                'proceso_id' => 15, //DB: procesos: 15: Convenio
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-030
            [
                'objetivo' => 'Conocer el número de convenios terminados o cancelados por programa de estudios.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'N° Convenios Culminados',
                'cod_ind_inicial' => 'IND-030',
                'formula' => 'X = N° de convenios culminados por programa de estudios',
                'minimo' => 70,
                'satisfactorio' => 80,
                'sobresaliente' => 90,
                'proceso_id' => 15, //DB: procesos: 15: Convenio
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-031
            [
                'objetivo' => 'Medir el grado de satisfacción de los usuarios del servicio de convenios.',
                'titulo_interes' => 'N° Usuarios Satisfechos',
                'titulo_total' => 'N° Encuestados',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-031',
                'formula' => 'X = (N° usuarios satisfechos por convenio)/(Total de encuestados por convenio ) x 100',
                'minimo' => 60,
                'satisfactorio' => 70,
                'sobresaliente' => 80,
                'proceso_id' => 15, //DB: procesos: 15: Convenio
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],

            //ToDo: 12 BIBLIOTECA
            //IND-009
            [
                'objetivo' => 'Conocer la cantidad de material bibliográfico adquirido.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'N° Material Bibliográfico Adquirido',
                'cod_ind_inicial' => 'IND-009',
                'formula' => 'X = N° de material bibliografico adquirido',
                'minimo' => 30,
                'satisfactorio' => 50,
                'sobresaliente' => 80,
                'proceso_id' => 7, //DB: procesos: 7: Biblioteca
                'unidad_medida_id' => 1, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-010
            [
                'objetivo' => 'Conocer la cantidad de material bibliográfico prestado.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'N° Material Bibliográfico Prestado',
                'cod_ind_inicial' => 'IND-010',
                'formula' => 'X = Total de material bibliográfico prestado',
                'minimo' => 600,
                'satisfactorio' => 650,
                'sobresaliente' => 700,
                'proceso_id' => 7, //DB: procesos: 7: Biblioteca
                'unidad_medida_id' => 1, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 1,
                'frecuencia_reporte_id' => 1,
            ],
            //IND-011
            [
                'objetivo' => 'Conocer la cantidad de material bibliográfico perdido.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'N° Material Bibliográfico Perdido',
                'cod_ind_inicial' => 'IND-011',
                'formula' => 'X = Total de material bibliográfico pérdidos',
                'minimo' => 0,
                'satisfactorio' => 0,
                'sobresaliente' => 0,
                'proceso_id' => 7, //DB: procesos: 7: Biblioteca
                'unidad_medida_id' => 1, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 1,
                'frecuencia_reporte_id' => 1,
            ],
            //IND-012
            [
                'objetivo' => 'Saber la cantidad de visitantes a la biblioteca de la universidad.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'N° Visitantes a la Biblioteca',
                'cod_ind_inicial' => 'IND-012',
                'formula' => 'X = N° de visitantes a la biblioteca por programa de estudios',
                'minimo' => 300,
                'satisfactorio' => 350,
                'sobresaliente' => 400,
                'proceso_id' => 7, //DB: procesos: 7: Biblioteca
                'unidad_medida_id' => 1, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 1,
                'frecuencia_reporte_id' => 1,
            ],
            //IND-013
            [
                'objetivo' => 'Conocer el porcentaje de libros actualizados por programa de estudios.',
                'titulo_interes' => 'N° Libros Adquiridos',
                'titulo_total' => 'Total Libros En Colección',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-013',
                'formula' => 'X = (N° de libros adquiridos)/(Total de libros en colección) x100',
                'minimo' => 100,
                'satisfactorio' => 110,
                'sobresaliente' => 120,
                'proceso_id' => 7, //DB: procesos: 7: Biblioteca
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-014
            [
                'objetivo' => 'Saber la cantidad de material bibliográfico restaurado.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'N° Material Bibliográfico Restaurado',
                'cod_ind_inicial' => 'IND-014',
                'formula' => 'X = Total de material bibliográfico restaurado',
                'minimo' => 150,
                'satisfactorio' => 155,
                'sobresaliente' => 160,
                'proceso_id' => 7, //DB: procesos: 7: Biblioteca
                'unidad_medida_id' => 1, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 1,
                'frecuencia_reporte_id' => 1,
            ],
            //IND-015
            [
                'objetivo' => 'Medir el porcentaje de satisfacción de los usuarios del servicio de biblioteca.',
                'titulo_interes' => 'N° Usuarios Satisfechos',
                'titulo_total' => 'N° Encuestados',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-015',
                'formula' => 'X = (Total satisfechos con servicio de biblioteca)/(Total de encuestados ) x 100',
                'minimo' => 50,
                'satisfactorio' => 55,
                'sobresaliente' => 60,
                'proceso_id' => 7, //DB: procesos: 7: Biblioteca
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 1,
                'frecuencia_reporte_id' => 1,
            ],

            //ToDo: 13 ENSEÑANZA Y APRENDIZAJE
            //IND-032
            [
                'objetivo' => 'Conocer el porcentaje de estudiantes que lograron las competencias.',
                'titulo_interes' => 'N° Estudiantes Lograron',
                'titulo_total' => 'N° Total de Estudiantes',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-032',
                'formula' => 'X = (N° de estudiantes que lograron competencias)/(Total de estudiantes) x 100',
                'minimo' => 70,
                'satisfactorio' => 80,
                'sobresaliente' => 90,
                'proceso_id' => 1, //DB: procesos: 1: Enseñanza y Aprendizaje
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-033
            //Es por Curso
            //IND-034
            //Es por Curso
            //IND-035
            [
                'objetivo' => 'Medir el porcentaje de docentes con evaluación de cumplimiento.',
                'titulo_interes' => 'N° Docentes con Evaluación',
                'titulo_total' => 'N° Docentes Evaluados',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-035',
                'formula' => 'X = (Total docentes con evaluación de cumplimiento)/(Total de docentes evaluados por programa ) x 100',
                'minimo' => 0,
                'satisfactorio' => 0,
                'sobresaliente' => 0,
                'proceso_id' => 1, //DB: procesos: 1: Enseñanza y Aprendizaje
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-036
            [
                'objetivo' => 'Conocer el grado de satisfacción de los usuarios con el proceso e-a por programa de estudios.',
                'titulo_interes' => 'N° Usuarios Satisfechos',
                'titulo_total' => 'N° Usuarios Encuestados',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-036',
                'formula' => 'X = (Total satisfechos con e proceso E-A)/(Total de encuestados ) x 100',
                'minimo' => 70,
                'satisfactorio' => 80,
                'sobresaliente' => 90,
                'proceso_id' => 1, //DB: procesos: 1: Enseñanza y Aprendizaje
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-037
            [
                'objetivo' => 'Conocer el porcentaje de asistencia a clase de los docentes por semana.',
                'titulo_interes' => 'Σ Asistencia a Clases',
                'titulo_total' => 'N° Clases Programadas',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-037',
                'formula' => 'X = (∑ asistencia a clases de docentes por semana)/(Total de claes programadas por semana)',
                'minimo' => 0,
                'satisfactorio' => 0,
                'sobresaliente' => 0,
                'proceso_id' => 1, //DB: procesos: 1: Enseñanza y Aprendizaje
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 1,
                'frecuencia_reporte_id' => 1,
            ],
            //IND-038
            [
                'objetivo' => 'Medir el grado de cumplimiento de publicación de sílabo por programa de estudios.',
                'titulo_interes' => 'N° Sílabos Publicados',
                'titulo_total' => 'N° Total De Sílabos',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-038',
                'formula' => 'X = (Total silabos publicados por programa)/(Total de silabos por programa ) x 100',
                'minimo' => 0,
                'satisfactorio' => 0,
                'sobresaliente' => 0,
                'proceso_id' => 1, //DB: procesos: 1: Enseñanza y Aprendizaje
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],

            //ToDo: 14 TUTORIA
            //IND-054
            [
                'objetivo' => 'Medir el porcentaje de docentes que participan en tutoría.',
                'titulo_interes' => 'N° Docentes que realizan Tutoría',
                'titulo_total' => 'N° Total de Docentes',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-054',
                'formula' => 'X = (N° de docentes que realizan tutoría)/(Total de docentes del programa) x 100',
                'minimo' => 30,
                'satisfactorio' => 70,
                'sobresaliente' => 80,
                'proceso_id' => 2, //DB: procesos: 2: Tutoria
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-055
            [
                'objetivo' => 'Medir el grado de asistencia de estudiantes a tutoría.',
                'titulo_interes' => 'N° Estudiantes que asisten a Tutoría',
                'titulo_total' => 'N° Total de Estudiantes',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-055',
                'formula' => 'X = (N° de estudiantes que asisten a tutoría)/(Total de estudiantes del programa) x 100',
                'minimo' => 60,
                'satisfactorio' => 80,
                'sobresaliente' => 95,
                'proceso_id' => 2, //DB: procesos: 2: Tutoria
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-056
            [
                'objetivo' => 'Medir el porcentaje de estudiantes con problemas de aprendizaje.',
                'titulo_interes' => 'N° Estudiantes con Problemas de Aprendizaje',
                'titulo_total' => 'N° Total de Estudiantes',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-056',
                'formula' => 'X = (N° de estudiantes con problemas de aprendizaje)/(Total de estudiantes del programa) x 100',
                'minimo' => 3,
                'satisfactorio' => 4,
                'sobresaliente' => 5,
                'proceso_id' => 2, //DB: procesos: 2: Tutoria
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-057
            [
                'objetivo' => 'Conocer la cantidad de estudiantes que se encuentran en condición de riesgo académico.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'N° Estudiantes con Riesgo Académico',
                'cod_ind_inicial' => 'IND-057',
                'formula' => 'X = N° de estudiantes con riesgo académico por programa de estudios',
                'minimo' => 5,
                'satisfactorio' => 10,
                'sobresaliente' => 14,
                'proceso_id' => 2, //DB: procesos: 2: Tutoria
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],

            //ToDo: 15 MATRICULA
            //IND-039
            [
                'objetivo' => 'Conocer la cantidad de estudiantes matriculados por programa.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'N° Estudiantes Matriculados',
                'cod_ind_inicial' => 'IND-039',
                'formula' => 'X = N° de estudiantes matriculados por programa de estudios',
                'minimo' => 200,
                'satisfactorio' => 210,
                'sobresaliente' => 215,
                'proceso_id' => 4, //DB: procesos: 4: Matricula
                'unidad_medida_id' => 1, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-040
            [
                'objetivo' => 'Conocer la cantidad de estudiantes no matriculados por programa.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'N° Estudiantes No Matriculados',
                'cod_ind_inicial' => 'IND-040',
                'formula' => 'X = N° de estudiantes no matriculados por programa de estudios',
                'minimo' => 5,
                'satisfactorio' => 3,
                'sobresaliente' => 2,
                'proceso_id' => 4, //DB: procesos: 4: Matricula
                'unidad_medida_id' => 1, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-041
            [
                'objetivo' => 'Conocer la cantidad de estudiantes con reserva de matrícula.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'N° Estudiantes con Reserva de Matrícula',
                'cod_ind_inicial' => 'IND-041',
                'formula' => 'X = N° de estudiantes con reserva de matricula por programa de estudio',
                'minimo' => 8,
                'satisfactorio' => 4,
                'sobresaliente' => 2,
                'proceso_id' => 4, //DB: procesos: 4: Matricula
                'unidad_medida_id' => 1, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-042
            [
                'objetivo' => 'Calcular la cantidad de estudiantes no matriculados del total de estudiantes matriculados.',
                'titulo_interes' => 'N° Estudiantes No Matriculados',
                'titulo_total' => 'N° Estudiantes Matriculados',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-042',
                'formula' => 'X = (N° de estudiantes no matriculados)/(Total de estudiantes matriculados por programa) x 100',
                'minimo' => 6,
                'satisfactorio' => 4,
                'sobresaliente' => 0,
                'proceso_id' => 4, //DB: procesos: 4: Matricula
                'unidad_medida_id' => 1, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-043
            [
                'objetivo' => 'Medir el nivel de satisfacción de los usuarios con el proceso de matrícula.',
                'titulo_interes' => 'N° Usuarios Satisfechos',
                'titulo_total' => 'N° Usuarios Encuestados',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-043',
                'formula' => 'X = (Total usuarios satisfechos por matricula)/(Total de usuarios encuestados por el proceso matricula ) x 100',
                'minimo' => 85,
                'satisfactorio' => 90,
                'sobresaliente' => 95,
                'proceso_id' => 4, //DB: procesos: 4: Matricula
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],

            //ToDo: 16 DOCENTE
            //IND-062
            [
                'objetivo' => 'Medir el porcentaje de docentes que cumplen con el formato de 40 horas.',
                'titulo_interes' => 'N° Docentes Cumplimiento 40 Horas',
                'titulo_total' => 'N° Docentes de 40 Horas',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-062',
                'formula' => 'X = (N° de docentes cumplimiento de 40 hrs)/(Total de docentes de 40 horas) x 100',
                'minimo' => 60,
                'satisfactorio' => 80,
                'sobresaliente' => 100,
                'proceso_id' => 6, //DB: procesos: 6: Docente
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-063
            [
                'objetivo' => 'Medir el porcentaje de docentes que cumplen con sus labores.',
                'titulo_interes' => 'N° Docentes Que Cumplen Labores',
                'titulo_total' => 'N° Total De Docentes',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-063',
                'formula' => 'X = (N° de docentes que cumplen con sus labores)/(Total de docentes del programa) x 100',
                'minimo' => 70,
                'satisfactorio' => 80,
                'sobresaliente' => 100,
                'proceso_id' => 6, //DB: procesos: 6: Docente
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-064
            //No le corresponde
            //IND-065
            [
                'objetivo' => 'Conocer el porcentaje de legajos de docentes actualizado.',
                'titulo_interes' => 'N° Docentes Con Legajo Actualizado',
                'titulo_total' => 'N° Total De Docentes',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-065',
                'formula' => 'X = (N° de docentes con legajo actualizado)/(Total de docentes por programa) x 100',
                'minimo' => 80,
                'satisfactorio' => 90,
                'sobresaliente' => 100,
                'proceso_id' => 6, //DB: procesos: 6: Docente
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-066
            [
                'objetivo' => 'Conocer el número de capacitaciones realizadas para mejorar las capacidades de los docentes.',
                'titulo_interes' => null,
                'titulo_total' => null,
                'titulo_resultado' => 'N° De Capacitaciones',
                'cod_ind_inicial' => 'IND-066',
                'formula' => 'X = N° de capacitaciones para mejorar las capacidades de los directivos por programa',
                'minimo' => 80,
                'satisfactorio' => 90,
                'sobresaliente' => 100,
                'proceso_id' => 6, //DB: procesos: 6: Docente
                'unidad_medida_id' => 1, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-067
            [
                'objetivo' => 'Medir la demanda de personal administrativo.',
                'titulo_interes' => 'N° Estudiantes',
                'titulo_total' => 'N° Administrativos',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-067',
                'formula' => 'X = (N° de estudiantes por programa)/(Total de administrativos por programa)',
                'minimo' => 80,
                'satisfactorio' => 90,
                'sobresaliente' => 100,
                'proceso_id' => 6, //DB: procesos: 6: Docente
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],

            //IND-074
            [
                'objetivo' => 'Conocer el porcentaje de docentes que cumplen con el perfil.',
                'titulo_interes' => 'N° Docentes Que Cumplen Con El Perfil',
                'titulo_total' => 'N° Docentes',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-074',
                'formula' => 'X = (N° de docentes que cumplen con el perfil)/(Total de docentes por programa) x 100',
                'minimo' => 80,
                'satisfactorio' => 90,
                'sobresaliente' => 100,
                'proceso_id' => 6, //DB: procesos: 6: Docente
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-075
            [
                'objetivo' => 'Conocer el porcentaje de docentes capacitados.',
                'titulo_interes' => 'N° Docentes Capacitados',
                'titulo_total' => 'N° Docentes',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-075',
                'formula' => 'X = (N° de docentes capacitados)/(Total de docentes por programa) x 100',
                'minimo' => 80,
                'satisfactorio' => 90,
                'sobresaliente' => 100,
                'proceso_id' => 6, //DB: procesos: 6: Docente
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-076
            [
                'objetivo' => 'Conocer el porcentaje de docentes con evaluación satisfactoria.',
                'titulo_interes' => 'N° Docentes Evaluación Satisfactoria',
                'titulo_total' => 'N° Docentes Evaluados',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-076',
                'formula' => 'X = (N° de docentes con evaluación satisfactoria)/(Total de docentes evaluados por programa) x 100',
                'minimo' => 70,
                'satisfactorio' => 80,
                'sobresaliente' => 90,
                'proceso_id' => 6, //DB: procesos: 6: Docente
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-077
            [
                'objetivo' => 'Conocer el porcentaje de docentes ascendidos.',
                'titulo_interes' => 'N° Docentes Ascendidos',
                'titulo_total' => 'N° Docentes Por Ascender',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-077',
                'formula' => 'X = (N° de docentes ascendidos)/(Total de docentes por ascender por programa) x 100',
                'minimo' => 50,
                'satisfactorio' => 70,
                'sobresaliente' => 80,
                'proceso_id' => 6, //DB: procesos: 6: Docente
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],
            //IND-078
            [
                'objetivo' => 'Conocer el porcentaje de docentes reconocidos.',
                'titulo_interes' => 'N° Docentes Reconocidos',
                'titulo_total' => 'N° Docentes',
                'titulo_resultado' => 'Resultado Indicador',
                'cod_ind_inicial' => 'IND-078',
                'formula' => 'X = (N° de docentes reconocidos)/(Total de docentes por programa) x 100',
                'minimo' => 70,
                'satisfactorio' => 80,
                'sobresaliente' => 90,
                'proceso_id' => 6, //DB: procesos: 6: Docente
                'unidad_medida_id' => 2, //1: Numero | 2:Porcentaje
                'frecuencia_medicion_id' => 2,
                'frecuencia_reporte_id' => 2,
            ],

        ];

        \App\Models\Indicador::insert($indicadores);
    }
}
