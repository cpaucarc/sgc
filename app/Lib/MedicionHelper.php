<?php

namespace App\Lib;

use App\Models\Comedor;
use App\Models\Convenio;
use App\Models\Escuela;
use App\Models\Investigador;
use App\Models\MaterialBibliografico;
use App\Models\RsuParticipante;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class MedicionHelper
{
    /*
     * Retorna un array precalculado con los resultados del indicador
     * */
    public static function getArrayResultados($interes = null, $total = null, $resultado = null)
    {
        // Indicador que solo maneja el resultado directamente
        if (is_null($interes) || is_null($total)) {
            return array(
                array(
                    'codigo' => null,
                    'curso' => null,
                    'interes' => null,
                    'total' => null,
                    'resultado' => is_null($resultado) ? 0 : $resultado
                )
            );
        }

        // Indicador que maneja el calculo del resultado a partir del interes y total
        return array(
            array(
                'codigo' => null,
                'curso' => null,
                'interes' => $interes,
                'total' => $total,
                'resultado' => $total == 0 ? 0 : round($interes / $total * 100)
            )
        );
    }

    /* Retorna el ID enviado antecediendo "0" si su valor es menor a 10
     * Es util para pasar luego al endpoint de OGE, ya que si se envia solo 8, en lugar de 08, no funciona
     * */
    public static function normalizarID($id)
    {
        return intval($id) < 10 ? "0" . $id : strval($id);
    }

    /*
     * Sirve en Medicion.php para calcular IND 09, 10, 11
     * */
    public static function medicionMatBibliografico($facultad_id, $fecha_inicio, $fecha_fin)
    {
        return MaterialBibliografico::query()
            ->where('facultad_id', $facultad_id)
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
            });
    }

    /* Sirve en Medicion.php para calcular IND 17, 19
     * */
    public static function medicionComedor($escuela_id, $fecha_inicio, $fecha_fin)
    {
        return Comedor::query()
            ->where('escuela_id', $escuela_id)
            ->whereBetween('mes', [DB::raw('month("' . $fecha_inicio . '")'), DB::raw('month("' . $fecha_fin . '")')])
            ->whereBetween('anio', [DB::raw('year("' . $fecha_inicio . '")'), DB::raw('year("' . $fecha_fin . '")')]);
    }

    public static function medicionConvenio($facultad_id, $semestre_id, $selects = ['*'])
    {
        return Convenio::query()
            ->select($selects)
            ->where('facultad_id', $facultad_id)
            ->where('semestre_id', $semestre_id)
            ->first();
    }

    public static function cantidadDocentesPorDepto($depto_id, $semestre)
    {
        try {
            $depto_id = self::normalizarID($depto_id);

            $cantidad = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_docente/departamento/05?departamento=' . $depto_id . '&semestre=' . $semestre);
            return intval($cantidad->body());
        } catch (\Exception $e) {
            return 0;
        }
    }

    public static function cantidadDocentesPorFacultad($facultad_id, $semestre)
    {
        try {
            $facultad_id = self::normalizarID($facultad_id);

            $cantidad = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_docente/facultad/05?facultad=' . $facultad_id . '&semestre=' . $semestre);
            return intval($cantidad->body());
        } catch (\Exception $e) {
            return 0;
        }
    }

    // Cantidad de Estudiantes Matriculados
    public static function cantidadEstudiantesPorEscuela($escuela_id, $semestre)
    {
        try {
            $escuela_id = self::normalizarID($escuela_id);

            $cantidad = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_matricula/escuela/01?escuela=' . $escuela_id . '&semestre=' . $semestre);
            return intval($cantidad->body());
        } catch (\Exception $e) {
            return 0;
        }
    }

    // Cantidad de Estudiantes Matriculados
    public static function cantidadEstudiantesPorFacultad($facultad_id, $semestre)
    {
        try {
            $facultad_id = self::normalizarID($facultad_id);

            $cantidad = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_matricula/facultad/01?facultad=' . $facultad_id . '&semestre=' . $semestre);
            return intval($cantidad->body());
        } catch (\Exception $e) {
            return 0;
        }
    }

    /*
     * $es_escuela : Boolean -> indicar si se medirá solo de la escuela o de una facultad
     * $es_docente : Boolean -> indicar si se medirá investigadores del tipo docente o no (true: docentes, false: estudiantes)
     * $entidad_id : Integer -> es el ID de la escuela o facultad (si $es_escuela es true, el ID será de la escuela, caso contrario, será de la facultad)
     * */
    public static function cantidadInvestigadores($es_escuela, $es_docente, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        try {
            $escuelas = $es_escuela ? array($entidad_id)
                : Escuela::query()->where('facultad_id', $entidad_id)->pluck('id');

            return Investigador::query()->where('es_docente', $es_docente)
                ->whereIn('id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin, $escuelas) {
                    $query->select('investigador_id')
                        ->from('investigacion_investigadores')
                        ->whereIn('investigacion_id', function ($query2) use ($entidad_id, $fecha_inicio, $fecha_fin, $escuelas) {
                            $query2->select('id')->from('investigaciones')
                                ->whereIn('escuela_id', $escuelas)
                                ->whereBetween('fecha_publicacion', [$fecha_inicio, $fecha_fin]);
                        });
                })->count();
        } catch (\Exception $e) {
            return 0;
        }
    }

    /*
     * $es_escuela : Boolean -> indicar si se medirá solo de la escuela o de una facultad
     * $es_estudiante : Boolean -> indicar si se medirá participantes del tipo estudiantes o no (true: estudiantes, false: docentes)
     * $entidad_id : Integer -> es el ID de la escuela o facultad (si $es_escuela es true, el ID será de la escuela, caso contrario, será de la facultad)
     * $semestre_id : Integer -> es el ID del semestre que del cual se va a medir los participantes
     * */
    public static function cantidadParticipantesRSU($es_escuela, $es_estudiante, $entidad_id, $semestre_id)
    {
        $escuelas = $es_escuela ? array($entidad_id)
            : Escuela::query()->where('facultad_id', $entidad_id)->pluck('id');

        return RsuParticipante::query()
            ->where('es_estudiante', $es_estudiante)
            ->whereIn('responsabilidad_social_id', function ($query) use ($entidad_id, $semestre_id, $escuelas) {
                $query->select('id')->from('responsabilidad_social')
                    ->whereIn('escuela_id', $escuelas)
                    ->where('semestre_id', $semestre_id);
            })->count();
    }

}
