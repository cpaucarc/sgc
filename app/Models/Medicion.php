<?php

namespace App\Models;

use App\Lib\MedicionHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Medicion
{

    /* IND 01 - Gestion de la Calidad
     * Objetivo: Medir el porcentaje de avance mensual de las actividades programadas en el plan de trabajo.
     * Formula: X = (N° de actividades cumplidas)/(Total de actividades programadas) x 100
     * */
    public static function ind01($facultad_id, $fecha_inicio, $fecha_fin)
    {
        $callback = function ($query) use ($facultad_id) {
            $query->select('id')->from('responsables')
                ->whereIn('actividad_id', function ($query) {
                    $query->select('id')->from('actividades')->whereIn('tipo_actividad_id', [1, 2]); // 1:Planficar, 2:Hacer
                })
                ->whereIn('entidad_id', function ($query2) use ($facultad_id) {
                    $query2->select('entidad_id')->from('entidadables')
                        ->where(function ($query2) use ($facultad_id) {
                            $query2->where('entidadable_type', "App\\Models\\Facultad")->where('entidadable_id', $facultad_id);
                        })
                        ->orWhere(function ($query3) use ($facultad_id) {
                            $query3->where('entidadable_type', "App\\Models\\Escuela")
                                ->whereIn('entidadable_id', function ($q3) use ($facultad_id) {
                                    $q3->select('id')->from('escuelas')->where('facultad_id', $facultad_id);
                                });
                        });
                });
        };

        $total = Responsable::query()->whereIn('id', $callback)->count();

        $interes = ActividadCompletado::query()
            ->whereBetween('created_at', [$fecha_inicio, $fecha_fin])
            ->whereIn('responsable_id', $callback)
            ->count();

        return MedicionHelper::getArrayResultados($interes, $total);
    }

    /* IND 09 - Biblioteca
     * Objetivo: Conocer la cantidad de material bibliográfico adquirido.
     * Formula: X = N° de material bibliografico adquirido
     * */
    public static function ind09($facultad_id, $fecha_inicio, $fecha_fin)
    {
        $resultado = MedicionHelper::medicionMatBibliografico($facultad_id, $fecha_inicio, $fecha_fin)
            ->sum('adquirido');

        return MedicionHelper::getArrayResultados(null, null, $resultado);
    }

    /* IND 10 - Biblioteca
     * Objetivo: Conocer la cantidad de material bibliográfico prestado.
     * Formula: X = Total de material bibliográfico prestado
     * */
    public static function ind10($facultad_id, $fecha_inicio, $fecha_fin)
    {
        $resultado = MedicionHelper::medicionMatBibliografico($facultad_id, $fecha_inicio, $fecha_fin)
            ->sum('prestado');

        return MedicionHelper::getArrayResultados(null, null, $resultado);
    }

    /* IND 11 - Biblioteca
     * Objetivo: Conocer la cantidad de material bibliográfico perdido.
     * Formula: X = Total de material bibliográfico prestado
     * */
    public static function ind11($facultad_id, $fecha_inicio, $fecha_fin)
    {
        $resultado = MedicionHelper::medicionMatBibliografico($facultad_id, $fecha_inicio, $fecha_fin)
            ->sum('perdido');

        return MedicionHelper::getArrayResultados(null, null, $resultado);
    }

    /* IND 12 - Biblioteca
     * Objetivo: Saber la cantidad de visitantes a la biblioteca de la universidad.
     * Formula: X = N° de visitantes a la biblioteca por programa de estudios
     * */
    public static function ind12($escuela_id, $fecha_inicio, $fecha_fin)
    {
        $resultado = BibliotecaVisitante::query()
            ->where('escuela_id', $escuela_id)
            ->where(function ($query) use ($fecha_inicio, $fecha_fin) {
                $query->where(function ($q1) use ($fecha_inicio, $fecha_fin) {
                    $q1->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin])
                        ->whereBetween('fecha_fin', [$fecha_inicio, $fecha_fin]);
                })
                    ->orWhere(function ($q2) use ($fecha_inicio, $fecha_fin) {
                        $q2->where('fecha_inicio', '>', $fecha_inicio)
                            ->whereBetween('fecha_fin', [$fecha_inicio, $fecha_fin]);
                    })
                    ->orWhere(function ($q2) use ($fecha_inicio, $fecha_fin) {
                        $q2->where('fecha_fin', '<', $fecha_fin)
                            ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
                    });
            })
            ->sum('visitantes');

        return MedicionHelper::getArrayResultados(null, null, $resultado);
    }

    /* IND 13 - Biblioteca
     * Objetivo: Conocer el porcentaje de libros actualizados por programa de estudios.
     * Formula: X = (N° de libros adquiridos)/(Total de libros en colección) x100
     * */
    public static function ind13($facultad_id, $fecha_inicio, $fecha_fin)
    {
        $medicion = MedicionHelper::medicionMatBibliografico($facultad_id, $fecha_inicio, $fecha_fin)
            ->first(array(DB::raw('SUM(adquirido) as sum_adquirido'), DB::raw('MAX(total_libros) as max_total_libros')));

        $interes = $medicion->sum_adquirido;
        $total = $medicion->max_total_libros;

        return MedicionHelper::getArrayResultados($interes, $total);
    }

    /* IND 14 - Biblioteca
     * Objetivo: Saber la cantidad de material bibliográfico restaurado.
     * Formula: X = Total de material bibliográfico restaurado
     * */
    public static function ind14($facultad_id, $fecha_inicio, $fecha_fin)
    {
        $resultado = MedicionHelper::medicionMatBibliografico($facultad_id, $fecha_inicio, $fecha_fin)
            ->sum('restaurados');

        return MedicionHelper::getArrayResultados(null, null, $resultado);
    }

    /* IND 17 - Bienestar Universitario
     * Objetivo: Medir el porcentaje de comersales atendidos del total de comesales.
     * Formula: X = (N° de comensales atendidos por programa)/(Total de comensales por programa) x 100
     * */
    public static function ind17($escuela_id, $fecha_inicio, $fecha_fin)
    {
        $comedor = MedicionHelper::medicionComedor($escuela_id, $fecha_inicio, $fecha_fin)
            ->first(array(DB::raw('SUM(atenciones) as sum_atenciones'), DB::raw('SUM(total) as sum_total')));
        $interes = $comedor->sum_atenciones;
        $total = $comedor->sum_total;

        return MedicionHelper::getArrayResultados($interes, $total);
    }

    /* IND 19 - Bienestar Universitario
     * Objetivo: Conocer el número total de atenciones por servicios por programa de estudios.
     * Formula: X = ∑ atenciones por servicio por programa
     * */
    public static function ind19($escuela_id, $fecha_inicio, $fecha_fin)
    {
        $resultado = MedicionHelper::medicionComedor($escuela_id, $fecha_inicio, $fecha_fin)
            ->sum('atenciones');

        return MedicionHelper::getArrayResultados(null, null, $resultado);
    }

    /* IND 21 - Bolsa de Trabajo
     * Objetivo: Medir el porcentaje de usuarios beneficiados por el proceso de bolsa de trabajo.
     * Formula: X = (N° de beneficiados por programa)/(Total de postulantes del programa) x 100
     * */
    public static function ind21($escuela_id, $fecha_inicio, $fecha_fin)
    {
        $bolsa = BolsaPostulante::query()
            ->where('escuela_id', $escuela_id)
            ->where(function ($query) use ($fecha_inicio, $fecha_fin) {
                $query->where(function ($query2) use ($fecha_inicio, $fecha_fin) {
                    $query2->where('fecha_inicio', '>=', $fecha_inicio)
                        ->where('fecha_fin', '<=', $fecha_fin);
                })->orWhere(function ($query3) use ($fecha_inicio, $fecha_fin) {
                    $query3->where('fecha_inicio', '<=', $fecha_inicio)
                        ->where('fecha_fin', '>=', $fecha_fin);
                });
            })
            ->first();

        if (!$bolsa) {
            return null;
        }

        $interes = $bolsa->beneficiados;
        $total = $bolsa->postulantes;

        return MedicionHelper::getArrayResultados($interes, $total);
    }

    /* IND 24 - Convalidaciones
     * Objetivo: Conocer la cantidad de convalidaciones realizadas por programa de estudios.
     * Formula: X = N° de convalidaciones realizadas por programa
     * */
    public static function ind24($escuela_id, $fecha_inicio, $fecha_fin)
    {
        $resultado = Convalidacion::query()->where('escuela_id', $escuela_id)
            ->whereBetween('created_at', [$fecha_inicio, $fecha_fin])
            ->sum('convalidados');

        return MedicionHelper::getArrayResultados(null, null, $resultado);
    }

    /* IND 25 - Convalidaciones
     * Objetivo: Conocer el número de vacantes para convalidación por programa de estudios.
     * Formula: X = N° vacantes para convalidacion por programa de estudio
     * */
    public static function ind25($escuela_id, $fecha_inicio, $fecha_fin)
    {
        $resultado = Convalidacion::query()->where('escuela_id', $escuela_id)
            ->whereBetween('created_at', [$fecha_inicio, $fecha_fin])
            ->sum('vacantes');

        return MedicionHelper::getArrayResultados(null, null, $resultado);
    }

    /* IND 26 - Convalidaciones
     * Objetivo: Medir el grado de demanda de convalidación por programa de estudios.
     * Formula: X = (N° de postulantes para convalidar por programa)/(Total de vacantes para convalidar por programa) x 100
     * */
    public static function ind26($escuela_id, $fecha_inicio, $fecha_fin)
    {
        $convalidacion = Convalidacion::query()
            ->select('postulantes', 'vacantes')
            ->where('escuela_id', $escuela_id)
            ->whereBetween('created_at', [$fecha_inicio, $fecha_fin])
            ->first();

        $interes = $convalidacion->postulantes;
        $total = $convalidacion->vacantes;

        return MedicionHelper::getArrayResultados($interes, $total);
    }

    /* IND 27 - Convenios
     * Objetivo: Conocer la cantidad de convenios realizados.
     * Formula: X = N° de convenios realizados por programa
     * */
    public static function ind27($facultad_id, $semestre_id)
    {
        $convenio = MedicionHelper::medicionConvenio($facultad_id, $semestre_id, ['realizados']);

        if (!$convenio) {
            return null;
        }

        return MedicionHelper::getArrayResultados(null, null, $convenio->realizados);
    }

    /* IND 28 - Convenios
     * Objetivo: Conocer la cantidad de convenios vigentes.
     * Formula: X = N° de convenios vigentes por programa
     * */
    public static function ind28($facultad_id, $semestre_id)
    {
        $convenio = MedicionHelper::medicionConvenio($facultad_id, $semestre_id, ['vigentes']);

        if (!$convenio) {
            return null;
        }

        return MedicionHelper::getArrayResultados(null, null, $convenio->vigentes);
    }

    /* IND 29 - Convenios
     * Objetivo: Medir el grado de cumplimiento de los convenios.
     * Formula: X = (N° de convenios cumplidos por programa)/(Total de convenios vigentes por programa) x 100
     * */
    public static function ind29($facultad_id, $semestre_id)
    {
        $convenio = MedicionHelper::medicionConvenio($facultad_id, $semestre_id, ['culminados', 'vigentes']);

        if (!$convenio) {
            return null;
        }

        $interes = $convenio->culminados;
        $total = $convenio->vigentes;

        return MedicionHelper::getArrayResultados($interes, $total);
    }

    /* IND 30 - Convenios
     * Objetivo: Conocer el número de convenios terminados o cancelados por programa de estudios.
     * Formula: X = N° de convenios culminados por programa de estudios
     * */
    public static function ind30($facultad_id, $semestre_id)
    {
        $convenio = MedicionHelper::medicionConvenio($facultad_id, $semestre_id, ['culminados']);

        if (!$convenio) {
            return null;
        }

        return MedicionHelper::getArrayResultados(null, null, $convenio->culminados);
    }

    /* IND 32 - Enseñanza-Aprendizaje
     * Objetivo: Conocer el porcentaje de estudiantes que lograron las competencias.
     * Formula: X = (N° de estudiantes que lograron competencias)/(Total de estudiantes) x 100
     * */
    public static function ind32($escuela_id, $semestre)
    {
        try {
//            $aprobados = Http::withToken(env('OGE_TOKEN'))
//                ->get(env('OGE_API') . 'ensenianza_aprendizaje/escuela/04?escuela=' . $escuela_id . '&semestre=' . $semestre);
//
//            $matriculados = Http::withToken(env('OGE_TOKEN'))
//                ->get(env('OGE_API') . 'ensenianza_aprendizaje/escuela/03?escuela=' . $escuela_id . '&semestre=' . $semestre);
//
//            $interes = intval($rsp->body());
//
//            $total = intval($cant_estudiantes->body());
//
//            $resultados['resultado'] = $resultados['total'] === 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);;

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /* IND 35 - Enseñanza-Aprendizaje
     * Objetivo: Medir el porcentaje de docentes con evaluación de cumplimiento.
     * Formula: X = (Total docentes con evaluación de cumplimiento)/(Total de docentes evaluados por programa ) x 100
     * */
    public static function ind35($escuela_id, $semestre)
    {
        try {
            $doc_con_evaluacion = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'ensenianza_aprendizaje/escuela/07?escuela=' . $escuela_id . '&semestre=' . $semestre);

            $doc_evaluados = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'ensenianza_aprendizaje/escuela/08?escuela=' . $escuela_id . '&semestre=' . $semestre);

            $interes = intval($doc_con_evaluacion->body());
            $total = intval($doc_evaluados->body());

            return MedicionHelper::getArrayResultados($interes, $total);
        } catch (\Exception $e) {
            return null;
        }
    }

    /* IND 36 - Enseñanza-Aprendizaje
     * Objetivo: Conocer el grado de satisfacción de los usuarios con el proceso E-A por programa de estudios.
     * Formula: X = (Total satisfechos con el proceso E-A)/(Total de encuestados ) x 100
     * */
    public static function ind36($escuela_id, $semestre)
    {
        try {
            $satisfechos = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'ensenianza_aprendizaje/escuela/10?escuela=' . $escuela_id . '&semestre=' . $semestre);

            $encuestados = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'ensenianza_aprendizaje/escuela/09?escuela=' . $escuela_id . '&semestre=' . $semestre);

            $interes = intval($satisfechos->body());
            $total = intval($encuestados->body());

            return MedicionHelper::getArrayResultados($interes, $total);
        } catch (\Exception $e) {
            return null;
        }
    }

    /* IND 37 - Enseñanza-Aprendizaje
     * Objetivo: Conocer el porcentaje de asistencia a clase de los docentes por semana.
     * Formula: X = (∑ asistencia a clases de docentes por semana)/(Total de claes programadas por semana)
     * */
    public static function ind37($escuela_id, $semestre, $fecha_inicio, $fecha_fin)
    {
        try {
            $asistencia = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'ensenianza_aprendizaje/escuela/11?escuela=' . $escuela_id . '&semestre=' . $semestre . '&fecha_inicio=' . $fecha_inicio . '&fecha_fin=' . $fecha_fin);

            $programada = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'ensenianza_aprendizaje/escuela/12?escuela=' . $escuela_id . '&semestre=' . $semestre . '&fecha_inicio=' . $fecha_inicio . '&fecha_fin=' . $fecha_fin);

            $interes = intval($asistencia->body());
            $total = intval($programada->body());

            return MedicionHelper::getArrayResultados($interes, $total);
        } catch (\Exception $e) {
            return null;
        }
    }

    /* IND 38 - Enseñanza-Aprendizaje
     * Objetivo: Medir el grado de cumplimiento de publicación de sílabo por programa de estudios.
     * Formula: X = (Total silabos publicados por programa)/(Total de silabos por programa ) x 100
     * */
    public static function ind38($escuela_id, $semestre)
    {
        try {
            $silabos_publicados = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'ensenianza_aprendizaje/escuela/13?escuela=' . $escuela_id . '&semestre=' . $semestre);

            $cursos_abiertos = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'ensenianza_aprendizaje/escuela/14?escuela=' . $escuela_id . '&semestre=' . $semestre);

            $interes = intval($silabos_publicados->body());
            $total = intval($cursos_abiertos->body());

            return MedicionHelper::getArrayResultados($interes, $total);
        } catch (\Exception $e) {
            return null;
        }
    }

    /* IND 39 - Matricula
     * Objetivo: Conocer la cantidad de estudiantes matriculados por programa.
     * Formula: X = N° de estudiantes matriculados por programa de estudios
     * */
    public static function ind39($escuela_id, $semestre)
    {
        try {
            $matriculados = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_matricula/escuela/01?escuela=' . $escuela_id . '&semestre=' . $semestre);

            $resultado = intval($matriculados->body());

            return MedicionHelper::getArrayResultados(null, null, $resultado);
        } catch (\Exception $e) {
            return null;
        }
    }

    /* IND 40 - Matricula
     * Objetivo: Conocer la cantidad de estudiantes no matriculados por programa.
     * Formula: X = N° de estudiantes no matriculados por programa de estudios
     * */
    public static function ind40($escuela_id, $semestre)
    {
        try {
            $no_matriculados = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_matricula/escuela/02?escuela=' . $escuela_id . '&semestre=' . $semestre);

            $resultado = intval($no_matriculados->body());

            return MedicionHelper::getArrayResultados(null, null, $resultado);
        } catch (\Exception $e) {
            return null;
        }
    }

    /* IND 41 - Matricula
     * Objetivo: Conocer la cantidad de estudiantes con reserva de matrícula.
     * Formula: X = N° de estudiantes con reserva de matricula por programa de estudio
     * */
    public static function ind41($escuela_id, $semestre)
    {
        try {
            $con_reserva = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_matricula/escuela/03?escuela=' . $escuela_id . '&semestre=' . $semestre);

            $resultado = intval($con_reserva->body());

            return MedicionHelper::getArrayResultados(null, null, $resultado);
        } catch (\Exception $e) {
            return null;
        }
    }

    /* IND 42 - Matricula
     * Objetivo: Calcular la cantidad de estudiantes no matriculados del total de estudiantes matriculados.
     * Formula: X = (N° de estudiantes no matriculados)/(Total de estudiantes matriculados por programa) x 100
     * */
    public static function ind42($escuela_id, $semestre)
    {
        try {
            $no_matriculados = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_matricula/escuela/02?escuela=' . $escuela_id . '&semestre=' . $semestre);

            $total_matriculados = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_matricula/escuela/01?escuela=' . $escuela_id . '&semestre=' . $semestre);

            $interes = intval($no_matriculados->body());
            $total = intval($total_matriculados->body());

            return MedicionHelper::getArrayResultados($interes, $total);
        } catch (\Exception $e) {
            return null;
        }
    }

    /* IND 43 - Matricula
     * Objetivo: Medir el nivel de satisfacción de los usuarios con el proceso de matrícula.
     * Formula: X = (Total usuarios satisfechos por matricula)/(Total de usuarios encuestados por el proceso matricula ) x 100
     * */
    public static function ind43($escuela_id, $semestre)
    {
        try {
            $satisfechos = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_matricula/escuela/05?escuela=' . $escuela_id . '&semestre=' . $semestre);
            $encuestados = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_matricula/escuela/04?escuela=' . $escuela_id . '&semestre=' . $semestre);

            $interes = intval($satisfechos->body());
            $total = intval($encuestados->body());

            return MedicionHelper::getArrayResultados($interes, $total);
        } catch (\Exception $e) {
            return null;
        }
    }

    /* IND 44 - Investigacion
     * Objetivo: Medir el grado de participación de los docentes en los proyectos de investigación.
     * Formula: X = (N° de docentes que participan en PI)/(Total de docentes del programa) x 100
     * */
    public static function ind44($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin, $semestre, $depto_id = null)
    {
        try {
            $total = $es_escuela ? MedicionHelper::cantidadDocentesPorDepto($depto_id, $semestre)
                : MedicionHelper::cantidadDocentesPorFacultad($entidad_id, $semestre);

            $interes = MedicionHelper::cantidadInvestigadores($es_escuela, true, $entidad_id, $fecha_inicio, $fecha_fin);

            return MedicionHelper::getArrayResultados($interes, $total);
        } catch (\Exception $e) {
            return null;
        }
    }

    /* IND 45 - Investigacion
     * Objetivo: Medir el grado de participación de los estudiantes en los proyectos de investigación.
     * Formula: X = (N° de estudiantes que participan en PI)/(Total de estudiantes del programa) x 100
     * */
    public static function ind45($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin, $semestre)
    {
        try {
            $total = $es_escuela ? MedicionHelper::cantidadEstudiantesPorEscuela($entidad_id, $semestre)
                : MedicionHelper::cantidadEstudiantesPorFacultad($entidad_id, $semestre);

            $interes = MedicionHelper::cantidadInvestigadores($es_escuela, false, $entidad_id, $fecha_inicio, $fecha_fin);;

            return MedicionHelper::getArrayResultados($interes, $total);
        } catch (\Exception $e) {
            return null;
        }
    }

    /* IND 46 - Investigacion
     * Objetivo: Saber el número de trabajos de investigación publicados por programa de estudios.
     * Formula: X = N° de trabajos de investigación publicados por programa de estudios
     * */
    public static function ind46($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $escuelas = $es_escuela ? array($entidad_id)
            : Escuela::query()->where('facultad_id', $entidad_id)->pluck('id');

        $resultado = Investigacion::query()
            ->where('estado_id', 3) //Tabla Estados -> 3:Publicado
            ->whereBetween('fecha_publicacion', [$fecha_inicio, $fecha_fin])
            ->whereIn('escuela_id', $escuelas)
            ->count();

        return MedicionHelper::getArrayResultados(null, null, $resultado);
    }

    /* IND 47 - Investigacion
     * Objetivo: Conocer el número de Proyectos de investigacion presentados por programa de estudios.
     * Formula: X = N° de Proyectos de invetigacion presentados por programa
     * */
    public static function ind47($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $escuelas = $es_escuela ? array($entidad_id)
            : Escuela::query()->where('facultad_id', $entidad_id)->pluck('id');

        $resultado = Investigacion::query()
            ->whereBetween('fecha_publicacion', [$fecha_inicio, $fecha_fin])
            ->whereIn('escuela_id', $escuelas)
            ->count();

        return MedicionHelper::getArrayResultados(null, null, $resultado);
    }

    /* IND 48 - Resp Social
     * Objetivo: Conocer el número de estudiantes que participan en proyectos de responsabilidad social.
     * Formula: X = N° de estudiantes que realizan RSU por programa
     * */
    public static function ind48($es_escuela, $entidad_id, $semestre_id)
    {
        $resultado = MedicionHelper::cantidadParticipantesRSU($es_escuela, true, $entidad_id, $semestre_id);
        return MedicionHelper::getArrayResultados(null, null, $resultado);
    }

    /* IND 49 - Resp Social
     * Objetivo: Conocer el número de docentes que participan en proyectos de responsabilidad social.
     * Formula: X = N° de docentes que realizan RSU por programa
     * */
    public static function ind49($es_escuela, $entidad_id, $semestre_id)
    {
        $resultado = MedicionHelper::cantidadParticipantesRSU($es_escuela, false, $entidad_id, $semestre_id);
        return MedicionHelper::getArrayResultados(null, null, $resultado);
    }

    /* IND 50 - Resp Social
     * Objetivo: Medir el grado de participación de los docentes en responsabilidad social
     * Formula: X = (N° de docentes que realizan RSU)/(Total de docentes por programa) x 100
     * */
    public static function ind50($es_escuela, $entidad_id, $semestre, $semestre_id, $depto_id = null)
    {
        $interes = MedicionHelper::cantidadParticipantesRSU($es_escuela, false, $entidad_id, $semestre_id);

        $total = $es_escuela ? MedicionHelper::cantidadDocentesPorDepto($depto_id, $semestre)
            : MedicionHelper::cantidadDocentesPorFacultad($entidad_id, $semestre);

        return MedicionHelper::getArrayResultados($interes, $total);
    }

    /* IND 51 - Resp Social
     * Objetivo: Medir el grado de participación de los estudiantes en responsabilidad social
     * Formula: X = (N° de estudiantes que realizan RSU)/(Total de estudiantes por programa) x 100
     * */
    public static function ind51($es_escuela, $entidad_id, $semestre, $semestre_id)
    {
        $interes = MedicionHelper::cantidadParticipantesRSU($es_escuela, true, $entidad_id, $semestre_id);

        $total = $es_escuela ? MedicionHelper::cantidadEstudiantesPorEscuela($entidad_id, $semestre)
            : MedicionHelper::cantidadEstudiantesPorFacultad($entidad_id, $semestre);

        return MedicionHelper::getArrayResultados($interes, $total);
    }

    /* IND 52 - Resp Social
     * Objetivo: Conocer el número de proyectos que realizan RSU por programa de estudios.
     * Formula: X = N° de proyectos de RSU por programa
     * */
    public static function ind52($es_escuela, $entidad_id, $semestre_id)
    {
        $escuelas = $es_escuela ? array($entidad_id)
            : Escuela::query()->where('facultad_id', $entidad_id)->pluck('id');

        $resultado = ResponsabilidadSocial::query()
            ->where('semestre_id', $semestre_id)
            ->whereIn('escuela_id', $escuelas)
            ->count();

        return MedicionHelper::getArrayResultados(null, null, $resultado);
    }

    /* IND 54 - Tutoria y Consejeria
     * Objetivo: Medir el porcentaje de docentes que participan en tutoría.
     * Formula: X = (N° de docentes que realizan tutoría)/(Total de docentes del programa) x 100
     * */
    public static function ind54($depto_id, $semestre)
    {
        if (is_null($depto_id)) {
            return null;
        }

        try {
            // Docentes que realizan tutoria por cada departamento
            $tutores = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'tutoria_consejeria/departamento/02?departamento=' . $depto_id . '&semestre=' . $semestre);
            $interes = intval($tutores->body());

            $total_docentes = MedicionHelper::cantidadDocentesPorDepto($depto_id, $semestre);

            return MedicionHelper::getArrayResultados($interes, $total_docentes);
        } catch (\Exception $e) {
            return null;
        }
    }

    /* IND 55 - Tutoria y Consejeria
     * Objetivo: Medir el grado de asistencia de estudiantes a tutoría.
     * Formula: X = (N° de estudiantes que asisten a tutoría)/(Total de estudiantes del programa) x 100
     * */
    public static function ind55($escuela_id, $semestre)
    {
        try {
            $asistentes = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'tutoria_consejeria/escuela/04?escuela=' . $escuela_id . '&semestre=' . $semestre);
            $interes = intval($asistentes->body());

            $total = MedicionHelper::cantidadEstudiantesPorEscuela($escuela_id, $semestre);

            return MedicionHelper::getArrayResultados($interes, $total);
        } catch (\Exception $e) {
            return null;
        }
    }

    /* IND 56 - Tutoria y Consejeria
     * Objetivo: Medir el porcentaje de estudiantes con problemas de aprendizaje.
     * Formula: X = (N° de estudiantes con problemas de aprendizaje)/(Total de estudiantes del programa) x 100
     * */
    public static function ind56($escuela_id, $semestre)
    {
        try {
            $estudiantes_con_problemas = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'tutoria_consejeria/escuela/05?escuela=' . $escuela_id . '&semestre=' . $semestre);
            $interes = intval($estudiantes_con_problemas->body());

            $total = MedicionHelper::cantidadEstudiantesPorEscuela($escuela_id, $semestre);

            return MedicionHelper::getArrayResultados($interes, $total);
        } catch (\Exception $e) {
            return null;
        }
    }

    public static function ind57($escuela_id, $semestre)
    {
        //X = N° de estudiantes con riesgo académico por programa de estudios
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {
            // FIXME está devolviendo un 404
            $rsp = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'tutoria_consejeria/escuela/06?escuela=' . $escuela_id . '&semestre=' . $semestre);

            $resultados['resultado'] = intval($rsp->body());
        } catch (\Exception $e) {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }
        return $resultados;
    }

    public static function ind58($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = GradoEstudiante::query()->where('grado_academico_id', 2)
            ->whereBetween('created_at', [$fecha_inicio, $fecha_fin]);

        if ($es_escuela) {
            $escuelas = Escuela::select('id')->where('id', $entidad_id)->get();
        } else {
            $escuelas = Escuela::select('id')->where('facultad_id', $entidad_id)->get();
        }

        $q = $q->whereIn('escuela_id', $escuelas);

        $resultados['interes'] = GradoEstudiante::query()->where('grado_academico_id', 3)
            ->whereIn('escuela_id', $escuelas)
            ->where(function ($query) use ($fecha_inicio, $fecha_fin, $q) {
                $query->whereBetween('created_at', [$fecha_inicio, $fecha_fin])
                    ->orWhereIn('dni_estudiante', $q->select('dni_estudiante')->get());
            })->count();

        $resultados['total'] = $q->count();

        $resultados['resultado'] = $resultados['interes'] == 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);
        return $resultados;
    }

    public static function ind59($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = GradoEstudiante::query()->where('grado_academico_id', 3)
            ->whereBetween('created_at', [$fecha_inicio, $fecha_fin]);

        if ($es_escuela) {
            $escuelas = Escuela::select('id')->where('id', $entidad_id)->get();
        } else {
            $escuelas = Escuela::select('id')->where('facultad_id', $entidad_id)->get();
        }

        $q = $q->whereIn('escuela_id', $escuelas);

        $resultados['interes'] = GradoEstudiante::query()->where('grado_academico_id', 4)
            ->whereIn('escuela_id', $escuelas)
            ->where(function ($query) use ($fecha_inicio, $fecha_fin, $q) {
                $query->whereBetween('created_at', [$fecha_inicio, $fecha_fin])
                    ->orWhereIn('dni_estudiante', $q->select('dni_estudiante')->get());
            })->count();

        $resultados['total'] = $q->count();

        $resultados['resultado'] = $resultados['interes'] == 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);
        return $resultados;
    }

    public static function ind60($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = GradoEstudiante::query()->where('grado_academico_id', 4)
            ->whereBetween('created_at', [$fecha_inicio, $fecha_fin]);

        if ($es_escuela) {
            $q = $q->where('escuela_id', $entidad_id);
        } else {
            $q = $q->whereIn('escuela_id', function ($query2) use ($entidad_id) {
                $query2->select('id')->from('escuelas')->where('facultad_id', $entidad_id);
            });
        }

        $resultados['resultado'] = $q->count();

        return $resultados;
    }

    public static function ind61($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        if ($es_escuela) {
            $escuelas = Escuela::select('id')->where('id', $entidad_id)->get();
        } else {
            $escuelas = Escuela::select('id')->where('facultad_id', $entidad_id)->get();
        }

        $resultados['total'] = Tesis::query()->whereIn('escuela_id', $escuelas)
            ->whereIn('id', function ($query) use ($fecha_inicio, $fecha_fin) {
                return $query->select('tesis_id')->from('sustentaciones')
                    ->whereBetween('fecha_sustentacion', [$fecha_inicio, $fecha_fin]);
            })->count();

        $resultados['interes'] = Tesis::query()->whereIn('escuela_id', $escuelas)
            ->whereIn('id', function ($query) use ($fecha_inicio, $fecha_fin) {
                return $query->select('tesis_id')->from('sustentaciones')
                    ->where('estado_id', 10)
                    ->whereBetween('fecha_sustentacion', [$fecha_inicio, $fecha_fin]);
            })->count();

        $resultados['resultado'] = $resultados['total'] == 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);
        return $resultados;
    }

    public static function ind62($es_escuela, $entidad_id, $semestre)
    {
        //X = (N° de docentes cumplimiento de 40 hrs)/(Total de docentes de 40 horas) x 100
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {

            if ($es_escuela) {
                // FIXME está trabajando con departamento, no con escuela
                $rsp1 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/departamento/04?departamento=' . $entidad_id . '&semestre=' . $semestre);
                // FIXME está devolviendo un 404
                $rsp2 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/departamento/03?departamento=' . $entidad_id . '&semestre=' . $semestre);
            } else {
                // FIXME está trabajando con departamento, no con escuela
                $rsp1 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/facultad/04?facultad=' . $entidad_id . '&semestre=' . $semestre);
                // FIXME está devolviendo un 404
                $rsp2 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/facultad/03?facultad=' . $entidad_id . '&semestre=' . $semestre);

            }

            $resultados['interes'] = intval($rsp1->body());
            $resultados['total'] = intval($rsp2->body());
            $resultados['resultado'] = $resultados['total'] === 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);;
        } catch (\Exception $e) {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }
        return $resultados;
    }

    public static function ind63($es_escuela, $entidad_id, $semestre)
    {
        //X = (N° de docentes que cumplen con sus labores)/(Total de docentes del programa) x 100
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {

            if ($es_escuela) {
                // FIXME está trabajando con departamento, no con escuela
                $rsp1 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/departamento/06?departamento=' . $entidad_id . '&semestre=' . $semestre);
                // FIXME está devolviendo un 404
                $rsp2 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/departamento/05?departamento=' . $entidad_id . '&semestre=' . $semestre);
            } else {
                // FIXME está trabajando con departamento, no con escuela
                $rsp1 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/facultad/06?facultad=' . $entidad_id . '&semestre=' . $semestre);
                // FIXME está devolviendo un 404
                $rsp2 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/facultad/05?facultad=' . $entidad_id . '&semestre=' . $semestre);

            }

            $resultados['interes'] = intval($rsp1->body());
            $resultados['total'] = intval($rsp2->body());
            $resultados['resultado'] = $resultados['total'] === 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);;
        } catch (\Exception $e) {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }
        return $resultados;
    }

    public static function ind65($es_escuela, $entidad_id, $semestre)
    {
        //X = (N° de docentes con legajo actualizado)/(Total de docentes por programa) x 100
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {

            if ($es_escuela) {
                // FIXME está trabajando con departamento, no con escuela
                $rsp1 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/departamento/07?departamento=' . $entidad_id . '&semestre=' . $semestre);
                // FIXME está devolviendo un 404
                $rsp2 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/departamento/05?departamento=' . $entidad_id . '&semestre=' . $semestre);
            } else {
                // FIXME está trabajando con departamento, no con escuela
                $rsp1 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/facultad/07?facultad=' . $entidad_id . '&semestre=' . $semestre);
                // FIXME está devolviendo un 404
                $rsp2 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/facultad/05?facultad=' . $entidad_id . '&semestre=' . $semestre);

            }

            $resultados['interes'] = intval($rsp1->body());
            $resultados['total'] = intval($rsp2->body());
            $resultados['resultado'] = $resultados['total'] === 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);;
        } catch (\Exception $e) {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }
        return $resultados;
    }

    public static function ind66($es_escuela, $entidad_id, $semestre)
    {
        //X = N° de capacitaciones para mejorar las capacidades de los directivos por programa
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {

            if ($es_escuela) {
                // FIXME está trabajando con departamento, no con escuela
                $rsp = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/departamento/08?departamento=' . $entidad_id . '&semestre=' . $semestre);

            } else {
                // FIXME está trabajando con departamento, no con escuela
                $rsp = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/facultad/08?facultad=' . $entidad_id . '&semestre=' . $semestre);
            }
            $resultados['resultado'] = intval($rsp->body());
        } catch (\Exception $e) {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }
        return $resultados;
    }

    public static function ind67($es_escuela, $entidad_id, $semestre)
    {
        //X = (N° de estudiantes por programa)/(Total de administrativos por programa)
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {

            if ($es_escuela) {
                // FIXME está devolviendo 404
                $rsp1 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_matricula/escuela/01?escuela=' . $entidad_id . '&semestre=' . $semestre);
                // FIXME está devolviendo un 404
                $rsp2 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/departamento/10?departamento=' . $entidad_id . '&semestre=' . $semestre);
            } else {
                // FIXME está devolviendo 404
                $rsp1 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_matricula/facultad/01?facultad=' . $entidad_id . '&semestre=' . $semestre);
                // FIXME está devolviendo un 404
                $rsp2 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/facultad/10?facultad=' . $entidad_id . '&semestre=' . $semestre);

            }

            $resultados['interes'] = intval($rsp1->body());
            $resultados['total'] = intval($rsp2->body());
            $resultados['resultado'] = $resultados['total'] === 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);;
        } catch (\Exception $e) {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }
        return $resultados;
    }

    public static function ind68($facultad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = AnalisisIndicador::query()
            ->where('cod_ind_final', 'not like', '%68%')
            ->whereDate('fecha_medicion_inicio', '>=', $fecha_inicio)
            ->whereDate('fecha_medicion_fin', '<=', $fecha_fin)
            ->whereIn('indicadorable_id', function ($query) use ($facultad_id) {
                $query->select('id')->from('indicadorables')
                    ->where(function ($query2) use ($facultad_id) {
                        $query2->where('indicadorable_type', "App\\Models\\Facultad")->where('indicadorable_id', $facultad_id);
                    })
                    ->orWhere(function ($query3) use ($facultad_id) {
                        $query3->where('indicadorable_type', "App\\Models\\Escuela")
                            ->whereIn('indicadorable_id', function ($q3) use ($facultad_id) {
                                $q3->select('id')->from('escuelas')->where('facultad_id', $facultad_id);
                            });
                    });
            });

        $resultados['total'] = $q->count();

        $resultados['interes'] = $q->whereColumn('resultado', '<=', 'minimo')->count();

        $resultados['resultado'] = $resultados['total'] == 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);
        return $resultados;
    }

    public static function ind70($facultad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $callback = function ($query) use ($facultad_id) {
            $query->select('id')->from('responsables')
                ->whereIn('actividad_id', function ($query) {
                    $query->select('id')->from('actividades')->whereIn('tipo_actividad_id', [4]);
                })
                ->whereIn('entidad_id', function ($query2) use ($facultad_id) {
                    $query2->select('entidad_id')->from('entidadables')
                        ->where(function ($query2) use ($facultad_id) {
                            $query2->where('entidadable_type', "App\\Models\\Facultad")->where('entidadable_id', $facultad_id);
                        })
                        ->orWhere(function ($query3) use ($facultad_id) {
                            $query3->where('entidadable_type', "App\\Models\\Escuela")
                                ->whereIn('entidadable_id', function ($q3) use ($facultad_id) {
                                    $q3->select('id')->from('escuelas')->where('facultad_id', $facultad_id);
                                });
                        });
                });
        };

        $q = ActividadCompletado::query()->whereBetween('created_at', [$fecha_inicio, $fecha_fin]);

        $resultados['total'] = Responsable::query()->whereIn('id', $callback)->count();

        $resultados['interes'] = $q->whereIn('responsable_id', $callback)->count();

        $resultados['resultado'] = $resultados['total'] == 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);
        return $resultados;
    }

    public static function ind74($es_escuela, $entidad_id, $semestre)
    {
        //X = (N° de docentes que cumplen con el perfil)/(Total de docentes por programa) x 100
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {

            if ($es_escuela) {
                // FIXME está devolviendo 404
                $rsp1 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/departamento/11?departamento=' . $entidad_id . '&semestre=' . $semestre);
                // FIXME está devolviendo un 404
                $rsp2 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/departamento/05?departamento=' . $entidad_id . '&semestre=' . $semestre);
            } else {
                // FIXME está devolviendo 404
                $rsp1 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/facultad/11?facultad=' . $entidad_id . '&semestre=' . $semestre);
                // FIXME está devolviendo un 404
                $rsp2 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/facultad/05?facultad=' . $entidad_id . '&semestre=' . $semestre);
            }

            $resultados['interes'] = intval($rsp1->body());
            $resultados['total'] = intval($rsp2->body());
            $resultados['resultado'] = $resultados['total'] === 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);;
        } catch (\Exception $e) {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }
        return $resultados;
    }

    public static function ind75($es_escuela, $entidad_id, $semestre)
    {
        //X = (N° de docentes capacitados)/(Total de docentes por programa) x 100
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {

            if ($es_escuela) {
                // FIXME está devolviendo 404
                $rsp1 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/departamento/09?departamento=' . $entidad_id . '&semestre=' . $semestre);
                // FIXME está devolviendo un 404
                $rsp2 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/departamento/05?departamento=' . $entidad_id . '&semestre=' . $semestre);
            } else {
                // FIXME está devolviendo 404
                $rsp1 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/facultad/09?facultad=' . $entidad_id . '&semestre=' . $semestre);
                // FIXME está devolviendo un 404
                $rsp2 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/facultad/05?facultad=' . $entidad_id . '&semestre=' . $semestre);
            }

            $resultados['interes'] = intval($rsp1->body());
            $resultados['total'] = intval($rsp2->body());
            $resultados['resultado'] = $resultados['total'] === 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);;
        } catch (\Exception $e) {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }
        return $resultados;
    }

    public static function ind76($es_escuela, $entidad_id, $semestre)
    {
        //X = (N° de docentes con evaluación satisfactoria)/(Total de docentes evaluados por programa) x 100
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {

            if ($es_escuela) {
                // FIXME está devolviendo 404
                $rsp1 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/departamento/12?departamento=' . $entidad_id . '&semestre=' . $semestre);
                // FIXME está devolviendo un 404
                $rsp2 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/departamento/13?departamento=' . $entidad_id . '&semestre=' . $semestre);
            } else {
                // FIXME está devolviendo 404
                $rsp1 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/facultad/12?facultad=' . $entidad_id . '&semestre=' . $semestre);
                // FIXME está devolviendo un 404
                $rsp2 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/facultad/13?facultad=' . $entidad_id . '&semestre=' . $semestre);
            }

            $resultados['interes'] = intval($rsp1->body());
            $resultados['total'] = intval($rsp2->body());
            $resultados['resultado'] = $resultados['total'] === 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);;
        } catch (\Exception $e) {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }
        return $resultados;
    }

    public static function ind77($es_escuela, $entidad_id, $semestre)
    {
        //X = (N° de docentes ascendidos)/(Total de docentes por ascender por programa) x 100
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {

            if ($es_escuela) {
                // FIXME está devolviendo 404
                $rsp1 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/departamento/15?departamento=' . $entidad_id . '&semestre=' . $semestre);
                // FIXME está devolviendo un 404
                $rsp2 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/departamento/14?departamento=' . $entidad_id . '&semestre=' . $semestre);
            } else {
                // FIXME está devolviendo 404
                $rsp1 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/facultad/15?facultad=' . $entidad_id . '&semestre=' . $semestre);
                // FIXME está devolviendo un 404
                $rsp2 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/facultad/14?facultad=' . $entidad_id . '&semestre=' . $semestre);
            }

            $resultados['interes'] = intval($rsp1->body());
            $resultados['total'] = intval($rsp2->body());
            $resultados['resultado'] = $resultados['total'] === 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);;
        } catch (\Exception $e) {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }
        return $resultados;
    }

    public static function ind78($es_escuela, $entidad_id, $semestre)
    {
        //X = (N° de docentes reconocidos)/(Total de docentes por programa) x 100
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {

            if ($es_escuela) {
                // FIXME está devolviendo 404
                $rsp1 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/departamento/16?departamento=' . $entidad_id . '&semestre=' . $semestre);
                // FIXME está devolviendo un 404
                $rsp2 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/departamento/05?departamento=' . $entidad_id . '&semestre=' . $semestre);
            } else {
                // FIXME está devolviendo 404
                $rsp1 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/facultad/16?facultad=' . $entidad_id . '&semestre=' . $semestre);
                // FIXME está devolviendo un 404
                $rsp2 = Http::withToken(env('OGE_TOKEN'))
                    ->get(env('OGE_API') . 'proceso_docente/facultad/05?facultad=' . $entidad_id . '&semestre=' . $semestre);
            }

            $resultados['interes'] = intval($rsp1->body());
            $resultados['total'] = intval($rsp2->body());
            $resultados['resultado'] = $resultados['total'] === 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);;
        } catch (\Exception $e) {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }
        return $resultados;
    }
}
