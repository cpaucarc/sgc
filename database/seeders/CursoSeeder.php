<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cursos = [
            // Cursos de Obstetricia
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "CM-A22",
                "nombre" => "MATEMATICA BASICA",
                "ciclo_id" => 1,
                "horas_teoria" => 3,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "CQ-G01",
                "nombre" => "QUIMICA GENERAL",
                "ciclo_id" => 1,
                "horas_teoria" => 3,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-F01",
                "nombre" => "INTRODUCCION AL ESTUDIO DE LA OBSTETRICIA",
                "ciclo_id" => 1,
                "horas_teoria" => 2,
                "horas_practica" => 4
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "CB-Q01",
                "nombre" => "BIOLOGIA GENERAL",
                "ciclo_id" => 1,
                "horas_teoria" => 3,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "UE-F01",
                "nombre" => "FILOSOFIA",
                "ciclo_id" => 1,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "UE-K10",
                "nombre" => "TALLER COMUNICACION ORAL Y ESCRITA",
                "ciclo_id" => 1,
                "horas_teoria" => 0,
                "horas_practica" => 4
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "UE-I05",
                "nombre" => "TALLER DE METODOS DE ESTUDIOS UNIVERSITARIOS",
                "ciclo_id" => 2,
                "horas_teoria" => 1,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-H01",
                "nombre" => "PSICOLOGIA GENERAL Y DEL DESARROLLO HUMANO",
                "ciclo_id" => 2,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-C01",
                "nombre" => "ANATOMIA HUMANA",
                "ciclo_id" => 2,
                "horas_teoria" => 4,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-C03",
                "nombre" => "GENETICA HUMANA",
                "ciclo_id" => 2,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-F14",
                "nombre" => "ASISTENCIA OBSTETRICA",
                "ciclo_id" => 2,
                "horas_teoria" => 2,
                "horas_practica" => 6
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "UH-S04",
                "nombre" => "REALIDAD NACIONAL",
                "ciclo_id" => 2,
                "horas_teoria" => 1,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "CQ-R02",
                "nombre" => "QUIMICA ORGANICA",
                "ciclo_id" => 2,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EE-P05",
                "nombre" => "MEDICINA TRADICIONAL",
                "ciclo_id" => 3,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-P08",
                "nombre" => "PAQUETES DE ATENCION INTEGRAL DE LA MUJER",
                "ciclo_id" => 3,
                "horas_teoria" => 2,
                "horas_practica" => 4
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-C04",
                "nombre" => "EMBRIOLOGIA HUMANA",
                "ciclo_id" => 3,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-C05",
                "nombre" => "BIOQUIMICA HUMANA",
                "ciclo_id" => 3,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-C06",
                "nombre" => "HISTOLOGIA HUMANA",
                "ciclo_id" => 3,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-C02",
                "nombre" => "ANATOMIA HUMANA ESPECIALIZADA",
                "ciclo_id" => 3,
                "horas_teoria" => 2,
                "horas_practica" => 4
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-P04",
                "nombre" => "SALUD MENTAL",
                "ciclo_id" => 3,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "UE-K17",
                "nombre" => "ORATORIA",
                "ciclo_id" => 4,
                "horas_teoria" => 1,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-F02",
                "nombre" => "SEMIOLOGIA GENERAL E INTERPRETACION DE EXAMENES AUXILIARES",
                "ciclo_id" => 4,
                "horas_teoria" => 3,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "UI-Q06",
                "nombre" => "TALLER DE COMUNICACION (QUECHUA)",
                "ciclo_id" => 4,
                "horas_teoria" => 1,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-C07",
                "nombre" => "FISIOLOGIA HUMANA GENERAL Y ESPECIALIZADA",
                "ciclo_id" => 4,
                "horas_teoria" => 3,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-C08",
                "nombre" => "MICROBIOLOGIA Y PARASITOLOGIA MEDICA",
                "ciclo_id" => 4,
                "horas_teoria" => 3,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-C09",
                "nombre" => "NUTRICION Y DIETETICA HUMANA",
                "ciclo_id" => 4,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "CE-E28",
                "nombre" => "BIOESTADISTICA",
                "ciclo_id" => 4,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-F15",
                "nombre" => "SALUD MUJER Y DESARROLLO",
                "ciclo_id" => 4,
                "horas_teoria" => 2,
                "horas_practica" => 4
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-F18",
                "nombre" => "SEXUALIDAD HUMANA",
                "ciclo_id" => 5,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-C10",
                "nombre" => "FARMACOLOGIA GENERAL",
                "ciclo_id" => 5,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-C12",
                "nombre" => "FISIOPATOLOGIA HUMANA",
                "ciclo_id" => 5,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-H02",
                "nombre" => "TEORIA Y METODOLOGIA DE LA INVESTIGACION",
                "ciclo_id" => 5,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-P02",
                "nombre" => "OBSTETRICIA COMUNITARIA",
                "ciclo_id" => 5,
                "horas_teoria" => 2,
                "horas_practica" => 6
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-P03",
                "nombre" => "EPIDEMIOLOGIA",
                "ciclo_id" => 5,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-F13",
                "nombre" => "SEMIOLOGIA OBSTETRICA",
                "ciclo_id" => 5,
                "horas_teoria" => 2,
                "horas_practica" => 4
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "UE-A15",
                "nombre" => "ACTIVIDADES",
                "ciclo_id" => 6,
                "horas_teoria" => 1,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-F05",
                "nombre" => "NEONATOLOGIA Y PEDIATRIA",
                "ciclo_id" => 6,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-P07",
                "nombre" => "SALUD PUBLICA",
                "ciclo_id" => 6,
                "horas_teoria" => 2,
                "horas_practica" => 4
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-C11",
                "nombre" => "FARMACOLOGIA ESPECIALIZADA",
                "ciclo_id" => 6,
                "horas_teoria" => 3,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-F03",
                "nombre" => "OBSTETRICIA I",
                "ciclo_id" => 6,
                "horas_teoria" => 4,
                "horas_practica" => 8
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-H03",
                "nombre" => "SEMINARIO DE TESIS",
                "ciclo_id" => 6,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EE-P06",
                "nombre" => "EDUCACION EN SALUD",
                "ciclo_id" => 6,
                "horas_teoria" => 1,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-P05",
                "nombre" => "SALUD REPRODUCTIVA Y PLANIFICACION FAMILIAR",
                "ciclo_id" => 7,
                "horas_teoria" => 3,
                "horas_practica" => 4
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-F06",
                "nombre" => "ANESTESIOLOGIA Y CIRUGIA OBSTETRICA",
                "ciclo_id" => 7,
                "horas_teoria" => 2,
                "horas_practica" => 4
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-F07",
                "nombre" => "GERENCIA DE LOS SERVICIOS DE SALUD I",
                "ciclo_id" => 7,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-F04",
                "nombre" => "OBSTETRICIA II",
                "ciclo_id" => 7,
                "horas_teoria" => 4,
                "horas_practica" => 8
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-P06",
                "nombre" => "SALUD MATERNO INFANTIL Y DEL ADOLECENTE",
                "ciclo_id" => 7,
                "horas_teoria" => 3,
                "horas_practica" => 4
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-F09",
                "nombre" => "OBSTETRICIA III",
                "ciclo_id" => 8,
                "horas_teoria" => 3,
                "horas_practica" => 4
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-F10",
                "nombre" => "GINECOLOGIA",
                "ciclo_id" => 8,
                "horas_teoria" => 3,
                "horas_practica" => 4
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-F12",
                "nombre" => "MEDICINA LEGAL",
                "ciclo_id" => 8,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-F08",
                "nombre" => "ECOGRAFIA OBSTETRICA",
                "ciclo_id" => 8,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-F17",
                "nombre" => "GERENCIA DE LOS SERVICIOS DE SALUD II",
                "ciclo_id" => 8,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-F16",
                "nombre" => "ETICA Y DEONTOLOGIA EN OBSTETRICIA",
                "ciclo_id" => 8,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-F11",
                "nombre" => "PSICOPROFILAXIS OBSTETRICA",
                "ciclo_id" => 8,
                "horas_teoria" => 2,
                "horas_practica" => 4
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-F20",
                "nombre" => "EXTERNADO",
                "ciclo_id" => 9,
                "horas_teoria" => 0,
                "horas_practica" => 34
            ],
            [
                "escuela_id" => 10,
                "curricula" => "07",
                "codigo" => "EO-F19",
                "nombre" => "INTERNADO",
                "ciclo_id" => 10,
                "horas_teoria" => 0,
                "horas_practica" => 34
            ],

            // Cursos de Enfermeria
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "CB-Q01",
                "nombre" => "BIOLOGIA GENERAL",
                "ciclo_id" => 1,
                "horas_teoria" => 3,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "CQ-G01",
                "nombre" => "QUIMICA GENERAL I",
                "ciclo_id" => 1,
                "horas_teoria" => 3,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "UE-F01",
                "nombre" => "FILOSOFIA",
                "ciclo_id" => 1,
                "horas_teoria" => 1,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "UE-K10",
                "nombre" => "TALLER COMUNICACION ORAL Y ESCRITA",
                "ciclo_id" => 1,
                "horas_teoria" => 0,
                "horas_practica" => 4
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "CM-A22",
                "nombre" => "MATEMATICA BASICA",
                "ciclo_id" => 1,
                "horas_teoria" => 3,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-F01",
                "nombre" => "INTRODUCCION A ENFERMERIA",
                "ciclo_id" => 1,
                "horas_teoria" => 3,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EO-H01",
                "nombre" => "PSICOLOGIA GENERAL Y DEL DESARROLLO HUMANO",
                "ciclo_id" => 2,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-F02",
                "nombre" => "ENFERMERIA BASICA I",
                "ciclo_id" => 2,
                "horas_teoria" => 4,
                "horas_practica" => 12
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "UE-A02",
                "nombre" => "ACTIVIDADES =>  ARTE Y DEPORTES",
                "ciclo_id" => 2,
                "horas_teoria" => 0,
                "horas_practica" => 4
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "UE-I05",
                "nombre" => "TALLER DE METODOS DEL ESTUDIO UNIVERSTARIO",
                "ciclo_id" => 2,
                "horas_teoria" => 0,
                "horas_practica" => 4
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "CQ-R02",
                "nombre" => "QUIMICA ORGANICA",
                "ciclo_id" => 2,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-C07",
                "nombre" => "ANATOMIA HUMANA I",
                "ciclo_id" => 2,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-H03",
                "nombre" => "RELACIONES HUMANAS",
                "ciclo_id" => 2,
                "horas_teoria" => 1,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-C08",
                "nombre" => "ANATOMIA HUMANA II",
                "ciclo_id" => 3,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-C09",
                "nombre" => "BIOQUIMICA HUMANA",
                "ciclo_id" => 3,
                "horas_teoria" => 3,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-C11",
                "nombre" => "FISIOLOGIA HUMANA",
                "ciclo_id" => 3,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-F03",
                "nombre" => "ENFERMERIA BASICA II",
                "ciclo_id" => 3,
                "horas_teoria" => 4,
                "horas_practica" => 12
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-F14",
                "nombre" => "LIDERAZGO EN ENFERMERIA",
                "ciclo_id" => 3,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-F04",
                "nombre" => "ENFERMERIA EN SALUD DEL ADULTO I",
                "ciclo_id" => 4,
                "horas_teoria" => 4,
                "horas_practica" => 12
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-P07",
                "nombre" => "PRIMEROS AUXILIOS",
                "ciclo_id" => 4,
                "horas_teoria" => 1,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EO-C09",
                "nombre" => "NUTRICION Y DIETETICA",
                "ciclo_id" => 4,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EO-C12",
                "nombre" => "FISIOPATOLOGIA HUMANA",
                "ciclo_id" => 4,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-P06",
                "nombre" => "EDUCACION EN SALUD",
                "ciclo_id" => 4,
                "horas_teoria" => 1,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-C12",
                "nombre" => "SEMIOLOGIA GRAL. E INTERP. EX. AUXILIARES",
                "ciclo_id" => 4,
                "horas_teoria" => 3,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-C13",
                "nombre" => "FARMACOLOGIA GENERAL Y TERAPEUTICA",
                "ciclo_id" => 4,
                "horas_teoria" => 3,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EO-C08",
                "nombre" => "MICROBIOLOGIA Y PARASITOLOGIA MEDICA",
                "ciclo_id" => 5,
                "horas_teoria" => 3,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-F05",
                "nombre" => "ENFERMERIA EN SALUD DEL ADULTO II",
                "ciclo_id" => 5,
                "horas_teoria" => 4,
                "horas_practica" => 12
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-F06",
                "nombre" => "ENFERMERIA EN SALUD MENTAL Y PSIQUIATRIA",
                "ciclo_id" => 5,
                "horas_teoria" => 4,
                "horas_practica" => 8
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "CE-E01",
                "nombre" => "ESTADISTICA GENERAL",
                "ciclo_id" => 5,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "CE-E27",
                "nombre" => "BIOESTADISTICA",
                "ciclo_id" => 6,
                "horas_teoria" => 3,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-F13",
                "nombre" => "ETICA Y DEONTOLOGIA EN ENFERMERIA",
                "ciclo_id" => 6,
                "horas_teoria" => 1,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-P04",
                "nombre" => "EPIDEMIOLOGIA",
                "ciclo_id" => 6,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "UI-Q06",
                "nombre" => "TALLER COMUNICACION =>  QUECHUA",
                "ciclo_id" => 6,
                "horas_teoria" => 1,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-P05",
                "nombre" => "MEDICINA TRADICIONAL",
                "ciclo_id" => 6,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-F07",
                "nombre" => "ENFERMERIA SALUD MATERNO PERINATAL",
                "ciclo_id" => 6,
                "horas_teoria" => 4,
                "horas_practica" => 12
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-A27",
                "nombre" => "DIDACTICA UNIVERSITARIA",
                "ciclo_id" => 6,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-F08",
                "nombre" => "ENFERMERIA EN SALUD DEL NIÑO I",
                "ciclo_id" => 7,
                "horas_teoria" => 3,
                "horas_practica" => 12
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-F10",
                "nombre" => "ENFERMERIA EMERGENCIAS Y DESASTRES",
                "ciclo_id" => 7,
                "horas_teoria" => 2,
                "horas_practica" => 4
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-P02",
                "nombre" => "ENFERMERIA SALUD COMUNITARIA",
                "ciclo_id" => 7,
                "horas_teoria" => 4,
                "horas_practica" => 10
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-H01",
                "nombre" => "TEORIA Y METODOLOGIA DE INVESTIGACION",
                "ciclo_id" => 7,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-F11",
                "nombre" => "GESTION EN ENFERMERIA I",
                "ciclo_id" => 7,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-F12",
                "nombre" => "GESTION EN ENFERMERIA II",
                "ciclo_id" => 8,
                "horas_teoria" => 2,
                "horas_practica" => 6
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-F09",
                "nombre" => "ENFERMERIA EN SALUD DEL NIÑO II",
                "ciclo_id" => 8,
                "horas_teoria" => 4,
                "horas_practica" => 12
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-H02",
                "nombre" => "TALLER DE INVESTIGACION APLICADA",
                "ciclo_id" => 8,
                "horas_teoria" => 2,
                "horas_practica" => 2
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-P03",
                "nombre" => "ENFERMERIA Y SALUD PUBLICA",
                "ciclo_id" => 8,
                "horas_teoria" => 4,
                "horas_practica" => 10
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-F15",
                "nombre" => "PRACTICAS PRE PROFESIONALES CLINICAS",
                "ciclo_id" => 9,
                "horas_teoria" => 0,
                "horas_practica" => 20
            ],
            [
                "escuela_id" => 11,
                "curricula" => "07",
                "codigo" => "EE-F16",
                "nombre" => "PRACTICAS PRE PROFESIONALES COMUNITARIAS",
                "ciclo_id" => 10,
                "horas_teoria" => 0,
                "horas_practica" => 20
            ]
        ];

        \App\Models\Curso::insert($cursos);
    }
}
