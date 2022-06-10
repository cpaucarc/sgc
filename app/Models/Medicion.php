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
     * Interes: N° actividades cumplidas
     * Total: N° actividades programadas
     * Resultado: Interes / Total * 100
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
     * Interes: -
     * Total: -
     * Resultado: N° Material Bibliográfico Adquirido
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
     * Interes: -
     * Total: -
     * Resultado: N° Material Bibliográfico Prestado
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
     * Interes: -
     * Total: -
     * Resultado: N° Material Bibliográfico Perdido
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
     * Interes: -
     * Total: -
     * Resultado: N° Visitantes a la Biblioteca
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
     * Interes: N° Libros Adquiridos
     * Total: Total Libros En Colección
     * Resultado: Interes / Total * 100
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
     * Interes: -
     * Total: -
     * Resultado: N° Material Bibliográfico Restaurado
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
     * Interes: N° Comensales Atendidos
     * Total: N° Total de Comensales
     * Resultado: Interes / Total * 100
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
     * Interes: -
     * Total: -
     * Resultado: Total de Atenciones
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
     * Interes: N° Beneficiados
     * Total: N° Postulantes
     * Resultado: Interes / Total * 100
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

    public static function ind24($escuela_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $cantidad = Convalidacion::query()->where('escuela_id', $escuela_id)
            ->whereBetween('created_at', [$fecha_inicio, $fecha_fin])
            ->sum('convalidados');

        $resultados['resultado'] = $cantidad ?? 0;
        return $resultados;
    }

    public static function ind25($escuela_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $cantidad = Convalidacion::query()->where('escuela_id', $escuela_id)
            ->whereBetween('created_at', [$fecha_inicio, $fecha_fin])
            ->sum('vacantes');

        $resultados['resultado'] = $cantidad ?? 0;
        return $resultados;
    }

    public static function ind26($escuela_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $cantidad = Convalidacion::query()->where('escuela_id', $escuela_id)
            ->whereBetween('created_at', [$fecha_inicio, $fecha_fin])
            ->sum('postulantes');

        $resultados['resultado'] = $cantidad ?? 0;
        return $resultados;
    }

    public static function ind27($facultad_id, $semestre_id)
    {
        // X = N° de convenios realizados por programa
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $convenio = Convenio::query()
            ->select('realizados')
            ->where('facultad_id', $facultad_id)
            ->where('semestre_id', $semestre_id)
            ->first();

        if ($convenio) {
            $resultados['resultado'] = $convenio->realizados;
        } else {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }

        return $resultados;
    }

    public static function ind28($facultad_id, $semestre_id)
    {
        // X = N° de convenios vigentes por programa
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $convenio = Convenio::query()
            ->select('vigentes')
            ->where('facultad_id', $facultad_id)
            ->where('semestre_id', $semestre_id)
            ->first();

        if ($convenio) {
            $resultados['resultado'] = $convenio->vigentes;
        } else {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }

        return $resultados;
    }

    public static function ind29($facultad_id, $semestre_id)
    {
        // X = (N° de convenios cumplidos por programa)/(Total de convenios vigentes por programa) x 100
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $convenio = Convenio::query()
            ->select('culminados', 'realizados')
            ->where('facultad_id', $facultad_id)
            ->where('semestre_id', $semestre_id)
            ->first();

        if ($convenio) {
            $resultados['interes'] = $convenio->culminados;
            $resultados['total'] = $convenio->realizados;
            $resultados['resultado'] = is_null($resultados['interes']) ? 0 :
                ($resultados['interes'] == 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100));
        } else {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }

        return $resultados;
    }

    public static function ind30($facultad_id, $semestre_id)
    {
        // X = N° de convenios culminados por programa de estudios
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $convenio = Convenio::query()
            ->select('culminados')
            ->where('facultad_id', $facultad_id)
            ->where('semestre_id', $semestre_id)
            ->first();

        if ($convenio) {
            $resultados['resultado'] = $convenio->culminados;
        } else {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }

        return $resultados;
    }

    public static function ind32($escuela_id, $semestre)
    {
        // X = (N° de estudiantes que lograron competencias)/(Total de estudiantes) x 100
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {
            // FIXME 04: Cantidad de estudiantes aprobados en cada curso por escuela. -> esta devolviendo un numero Aleatorio
            $rsp = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'ensenianza_aprendizaje/escuela/04?escuela=' . $escuela_id . '&semestre=' . $semestre);
            // Cantidad de estudiantes matriculados por escuela
            $rsp1 = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_matricula/escuela/01?escuela=' . $escuela_id . '&semestre=' . $semestre);

            $resultados['interes'] = intval($rsp->body());

            $resultados['total'] = intval($rsp1->body());
            $resultados['resultado'] = $resultados['total'] === 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);;
        } catch (\Exception $e) {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }
        return $resultados;
    }

    public static function ind35($escuela_id, $semestre)
    {
        //X = (Total docentes con evaluación de cumplimiento)/(Total de docentes evaluados por programa ) x 100
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {
            // FIXME 07: Cantidad de docentes con evaluación de cumplimiento por escuela.. -> esta devolviendo un numero Aleatorio
            $rsp1 = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'ensenianza_aprendizaje/escuela/07?escuela=' . $escuela_id . '&semestre=' . $semestre);
            // FIXME 08: Cantidad de docentes con evaluación de cumplimiento por escuela.. -> esta devolviendo un numero Aleatorio
            $rsp2 = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'ensenianza_aprendizaje/escuela/08?escuela=' . $escuela_id . '&semestre=' . $semestre);

            $resultados['interes'] = intval($rsp1->body());
            $resultados['total'] = intval($rsp2->body());
            $resultados['resultado'] = $resultados['total'] === 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);
        } catch (\Exception $e) {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }
        return $resultados;
    }

    public static function ind36($escuela_id, $semestre)
    {
        // X = (Total satisfechos con e proceso E-A)/(Total de encuestados ) x 100
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {
            // FIXME 10: Cantidad de docentes con evaluación de cumplimiento por escuela.. -> esta devolviendo un numero Aleatorio
            $rsp1 = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'ensenianza_aprendizaje/escuela/10?escuela=' . $escuela_id . '&semestre=' . $semestre);
            // FIXME 09: Cantidad de docentes con evaluación de cumplimiento por escuela.. -> esta devolviendo un numero Aleatorio
            $rsp2 = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'ensenianza_aprendizaje/escuela/09?escuela=' . $escuela_id . '&semestre=' . $semestre);

            $resultados['interes'] = intval($rsp1->body());
            $resultados['total'] = intval($rsp2->body());
            $resultados['resultado'] = $resultados['total'] === 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);
        } catch (\Exception $e) {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }
        return $resultados;
    }

    public static function ind37($escuela_id, $semestre, $fecha_inicio, $fecha_fin)
    {
        // X = (∑ asistencia a clases de docentes por semana)/(Total de claes programadas por semana)
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {
            // FIXME 11: Cantidad de docentes que asistieron a clases por escuela. -> esta devolviendo un numero Aleatorio
            $rsp1 = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'ensenianza_aprendizaje/escuela/11?escuela=' . $escuela_id . '&semestre=' . $semestre . '&fecha_inicio=' . $fecha_inicio . '&fecha_fin=' . $fecha_fin);
            // FIXME 12: Cantidad de clases programadas por escuela. -> esta devolviendo un numero Aleatorio
            $rsp2 = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'ensenianza_aprendizaje/escuela/12?escuela=' . $escuela_id . '&semestre=' . $semestre . '&fecha_inicio=' . $fecha_inicio . '&fecha_fin=' . $fecha_fin);

            $resultados['interes'] = intval($rsp1->body());
            $resultados['total'] = intval($rsp2->body());
            $resultados['resultado'] = $resultados['total'] === 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);
        } catch (\Exception $e) {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }
        return $resultados;
    }

    public static function ind38($escuela_id, $semestre)
    {
        // X = (Total silabos publicados por programa)/(Total de silabos por programa ) x 100
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {
            // FIXME 13: Cantidad de sílabos publicados por escuela. -> esta devolviendo un numero Aleatorio
            $rsp1 = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'ensenianza_aprendizaje/escuela/13?escuela=' . $escuela_id . '&semestre=' . $semestre);
            // FIXME 14: Cantidad de cursos abiertos por escuela. -> esta devolviendo un numero Aleatorio
            $rsp2 = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'ensenianza_aprendizaje/escuela/14?escuela=' . $escuela_id . '&semestre=' . $semestre);

            $resultados['interes'] = intval($rsp1->body());
            $resultados['total'] = intval($rsp2->body());
            $resultados['resultado'] = $resultados['total'] === 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);
        } catch (\Exception $e) {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }
        return $resultados;
    }

    public static function ind39($escuela_id, $semestre)
    {
        //X = N° de estudiantes matriculados por programa de estudios
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {
            // FIXME está devolviendo un 404
            $rsp = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_matricula/escuela/01?escuela=' . $escuela_id . '&semestre=' . $semestre);

            $resultados['resultado'] = intval($rsp->body());
        } catch (\Exception $e) {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }
        return $resultados;
    }

    public static function ind40($escuela_id, $semestre)
    {
        //X = N° de estudiantes no matriculados por programa de estudios
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {
            // FIXME está devolviendo un 404
            $rsp = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_matricula/escuela/02?escuela=' . $escuela_id . '&semestre=' . $semestre);

            $resultados['resultado'] = intval($rsp->body());
        } catch (\Exception $e) {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }
        return $resultados;
    }

    public static function ind41($escuela_id, $semestre)
    {
        //X = N° de estudiantes con reserva de matricula por programa de estudio
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {
            // FIXME está devolviendo un 404
            $rsp = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_matricula/escuela/03?escuela=' . $escuela_id . '&semestre=' . $semestre);

            $resultados['resultado'] = intval($rsp->body());
        } catch (\Exception $e) {
            $resultados['interes'] = null;
            $resultados['total'] = null;
            $resultados['resultado'] = null;
        }
        return $resultados;
    }

    public static function ind42($escuela_id, $semestre)
    {
        //X = (N° de estudiantes no matriculados)/(Total de estudiantes matriculados por programa) x 100
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {
            // FIXME está devolviendo un 404
            $rsp1 = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_matricula/escuela/02?escuela=' . $escuela_id . '&semestre=' . $semestre);
            // FIXME está devolviendo un 404
            $rsp2 = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_matricula/escuela/01?escuela=' . $escuela_id . '&semestre=' . $semestre);

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

    public static function ind43($escuela_id, $semestre)
    {
        //X = (Total usuarios satisfechos por matricula)/(Total de usuarios encuestados por el proceso matricula ) x 100
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {
            $rsp1 = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_matricula/escuela/05?escuela=' . $escuela_id . '&semestre=' . $semestre);
            $rsp2 = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_matricula/escuela/04?escuela=' . $escuela_id . '&semestre=' . $semestre);

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

    public static function ind44($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = Investigador::query()->where('es_docente', true);

        if ($es_escuela) {
            $resultados['interes'] = $q->whereIn('id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('investigador_id')
                    ->from('investigacion_investigadores')
                    ->whereIn('investigacion_id', function ($query2) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                        $query2->select('id')->from('investigaciones')
                            ->where('escuela_id', $entidad_id)
                            ->whereBetween('fecha_publicacion', [$fecha_inicio, $fecha_fin]);
                    });
            })->count();

            // FIXME OGE: Calcular el numero total de docentes por escuela desde OGE
            $resultados['total'] = 23; //Enf:23, Obs:21, Total: 44
        } else {
            $resultados['interes'] = $q->whereIn('id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('investigador_id')
                    ->from('investigacion_investigadores')
                    ->whereIn('investigacion_id', function ($query2) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                        $query2->select('id')->from('investigaciones')
                            ->whereIn('escuela_id', function ($query3) use ($entidad_id) {
                                $query3->select('id')
                                    ->from('escuelas')
                                    ->where('facultad_id', $entidad_id);
                            })
                            ->whereBetween('fecha_publicacion', [$fecha_inicio, $fecha_fin]);
                    });
            })->count();

            // FIXME OGE: Calcular el numero total de docentes por facultad desde OGE
            $resultados['total'] = 44;
        }
        $resultados['resultado'] = $resultados['total'] === 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);
        return $resultados;
    }

    public static function ind45($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = Investigador::query()->where('es_docente', false);

        if ($es_escuela) {
            $resultados['interes'] = $q->whereIn('id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('investigador_id')
                    ->from('investigacion_investigadores')
                    ->whereIn('investigacion_id', function ($query2) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                        $query2->select('id')->from('investigaciones')
                            ->where('escuela_id', $entidad_id)
                            ->whereBetween('fecha_publicacion', [$fecha_inicio, $fecha_fin]);
                    });
            })->count();

            // FIXME OGE: Calcular el numero total de docentes por escuela desde OGE
            $resultados['total'] = 193; //Enf:193, Obs:216, Total: 409
        } else {
            $resultados['interes'] = $q->whereIn('id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('investigador_id')
                    ->from('investigacion_investigadores')
                    ->whereIn('investigacion_id', function ($query2) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                        $query2->select('id')->from('investigaciones')
                            ->whereIn('escuela_id', function ($query3) use ($entidad_id) {
                                $query3->select('id')
                                    ->from('escuelas')
                                    ->where('facultad_id', $entidad_id);
                            })
                            ->whereBetween('fecha_publicacion', [$fecha_inicio, $fecha_fin]);
                    });
            })->count();

            // FIXME OGE: Calcular el numero total de docentes por facultad desde OGE
            $resultados['total'] = 409;
        }
        $resultados['resultado'] = $resultados['total'] === 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);;
        return $resultados;
    }

    public static function ind46($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {

        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = Investigacion::query()->where('estado_id', 3) //Tabla Estados: 3:Publicado
        ->whereBetween('fecha_publicacion', [$fecha_inicio, $fecha_fin]);

        if ($es_escuela) {
            $resultados['resultado'] = $q->where('escuela_id', $entidad_id)->count();
        } else {
            $resultados['resultado'] = $q->whereIn('escuela_id', function ($query3) use ($entidad_id) {
                $query3->select('id')->from('escuelas')->where('facultad_id', $entidad_id);
            })->count();
        }

        return $resultados;
    }

    public static function ind47($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {

        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = Investigacion::query()->whereBetween('fecha_publicacion', [$fecha_inicio, $fecha_fin]);

        if ($es_escuela) {
            $resultados['resultado'] = $q->where('escuela_id', $entidad_id)->count();
        } else {
            $resultados['resultado'] = $q->whereIn('escuela_id', function ($query3) use ($entidad_id) {
                $query3->select('id')->from('escuelas')->where('facultad_id', $entidad_id);
            })->count();
        }

        return $resultados;
    }

    public static function ind48($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = RsuParticipante::query()->where('es_estudiante', true);

        if ($es_escuela) {
            $resultados['resultado'] = $q->whereIn('responsabilidad_social_id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('id')->from('responsabilidad_social')
                    ->where('escuela_id', $entidad_id)
                    ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
            })->count();
        } else {
            $resultados['resultado'] = $q->whereIn('responsabilidad_social_id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('id')->from('responsabilidad_social')
                    ->whereIn('escuela_id', function ($query2) use ($entidad_id) {
                        $query2->select('id')->from('escuelas')->where('facultad_id', $entidad_id);
                    })
                    ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
            })->count();
        }
        return $resultados;
    }

    public static function ind49($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = RsuParticipante::query()->where('es_estudiante', false);

        if ($es_escuela) {
            $resultados['resultado'] = $q->whereIn('responsabilidad_social_id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('id')->from('responsabilidad_social')
                    ->where('escuela_id', $entidad_id)
                    ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
            })->count();
        } else {
            $resultados['resultado'] = $q->whereIn('responsabilidad_social_id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('id')->from('responsabilidad_social')
                    ->whereIn('escuela_id', function ($query2) use ($entidad_id) {
                        $query2->select('id')->from('escuelas')->where('facultad_id', $entidad_id);
                    })
                    ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
            })->count();
        }
        return $resultados;
    }

    public static function ind50($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = RsuParticipante::query()->where('es_estudiante', false);

        if ($es_escuela) {
            $resultados['interes'] = $q->whereIn('responsabilidad_social_id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('id')->from('responsabilidad_social')
                    ->where('escuela_id', $entidad_id)
                    ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
            })->count();

            // FIXME OGE: Calcular el numero total de docentes por escuela desde OGE
            $resultados['total'] = 23; //Enf:23, Obs:21
        } else {
            $resultados['interes'] = $q->whereIn('responsabilidad_social_id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('id')->from('responsabilidad_social')
                    ->whereIn('escuela_id', function ($query2) use ($entidad_id) {
                        $query2->select('id')->from('escuelas')->where('facultad_id', $entidad_id);
                    })
                    ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
            })->count();

            // FIXME OGE: Calcular el numero total de docentes por facultad desde OGE
            $resultados['total'] = 44;
        }
        $resultados['resultado'] = $resultados['total'] === 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);
        return $resultados;
    }

    public static function ind51($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = RsuParticipante::query()->where('es_estudiante', true);

        if ($es_escuela) {
            $resultados['interes'] = $q->whereIn('responsabilidad_social_id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('id')->from('responsabilidad_social')
                    ->where('escuela_id', $entidad_id)
                    ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
            })->count();
            // FIXME OGE: Calcular el numero total de estudiantes por escuela desde OGE
            $resultados['total'] = 193; //Enf:193, Obs:216
        } else {
            $resultados['interes'] = $q->whereIn('responsabilidad_social_id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('id')->from('responsabilidad_social')
                    ->whereIn('escuela_id', function ($query2) use ($entidad_id) {
                        $query2->select('id')->from('escuelas')->where('facultad_id', $entidad_id);
                    })
                    ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
            })->count();
            // FIXME OGE: Calcular el numero total de estudiantes por escuela desde OGE
            $resultados['total'] = 409;
        }
        $resultados['resultado'] = $resultados['total'] === 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);;
        return $resultados;
    }

    public static function ind52($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {

        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = ResponsabilidadSocial::query()->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);

        if ($es_escuela) {
            $resultados['resultado'] = $q->where('escuela_id', $entidad_id)->count();
        } else {
            $resultados['resultado'] = $q->whereIn('escuela_id', function ($query2) use ($entidad_id) {
                $query2->select('id')->from('escuelas')->where('facultad_id', $entidad_id);
            })->count();
        }
        return $resultados;
    }

    public static function ind54($escuela_id, $semestre)
    {
        //X = (N° de docentes que realizan tutoría)/(Total de docentes del programa) x 100
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {
            // FIXME está devolviendo un 404
            $rsp1 = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'tutoria_consejeria/escuela/02?escuela=' . $escuela_id . '&semestre=' . $semestre);
            // FIXME está devolviendo un 404
            $rsp2 = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'tutoria_consejeria/escuela/01?escuela=' . $escuela_id . '&semestre=' . $semestre);

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

    public static function ind55($escuela_id, $semestre)
    {
        //X = (N° de estudiantes que asisten a tutoría)/(Total de estudiantes del programa) x 100
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {
            // FIXME está devolviendo un 404
            $rsp1 = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'tutoria_consejeria/escuela/04?escuela=' . $escuela_id . '&semestre=' . $semestre);
            // FIXME está devolviendo un 404
            $rsp2 = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'tutoria_consejeria/escuela/03?escuela=' . $escuela_id . '&semestre=' . $semestre);

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

    public static function ind56($escuela_id, $semestre)
    {
        //X = (N° de estudiantes con problemas de aprendizaje)/(Total de estudiantes del programa) x 100
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        try {
            // FIXME está devolviendo un 404
            $rsp1 = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'tutoria_consejeria/escuela/05?escuela=' . $escuela_id . '&semestre=' . $semestre);
            // FIXME está devolviendo un 404
            $rsp2 = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'tutoria_consejeria/escuela/03?escuela=' . $escuela_id . '&semestre=' . $semestre);

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
