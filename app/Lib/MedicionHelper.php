<?php

namespace App\Lib;

use App\Models\Comedor;
use App\Models\Convenio;
use App\Models\MaterialBibliografico;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class MedicionHelper
{
    /*
     * Retorna un array precalculado con los resultados del indicador
     * */
    public static function getArrayResultados($interes = null, $total = null, $resultado = null)
    {
        if (is_null($interes) || is_null($total)) {
            return array('interes' => null, 'total' => null, 'resultado' => is_null($resultado) ? 0 : $resultado);
        }

        return array('interes' => $interes, 'total' => $total, 'resultado' => $total == 0 ? 0 : round($interes / $total * 100));
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
            $depto_id = $depto_id < 10 ? "0" . $depto_id : $depto_id;

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
            $facultad_id = $facultad_id < 10 ? "0" . $facultad_id : $facultad_id;

            $cantidad = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_docente/facultad/05?facultad=' . $facultad_id . '&semestre=' . $semestre);
            return intval($cantidad->body());
        } catch (\Exception $e) {
            return -9;
        }
    }

    // Cantidad de Estudiantes Matriculados
    public static function cantidadEstudiantesPorEscuela($escuela_id, $semestre)
    {
        try {
            $escuela_id = $escuela_id < 10 ? "0" . $escuela_id : $escuela_id;

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
            $facultad_id = $facultad_id < 10 ? "0" . $facultad_id : $facultad_id;

            $cantidad = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_matricula/facultad/01?facultad=' . $facultad_id . '&semestre=' . $semestre);
            return intval($cantidad->body());
        } catch (\Exception $e) {
            return 0;
        }
    }

}
