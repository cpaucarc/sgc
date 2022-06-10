<?php

namespace App\Lib;

use App\Models\Comedor;
use App\Models\MaterialBibliografico;
use Illuminate\Support\Facades\DB;

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

}