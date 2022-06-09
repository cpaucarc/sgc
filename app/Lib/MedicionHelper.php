<?php

namespace App\Lib;

use App\Models\MaterialBibliografico;

class MedicionHelper
{
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
}
