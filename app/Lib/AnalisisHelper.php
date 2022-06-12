<?php

namespace App\Lib;

use Carbon\Carbon;

class AnalisisHelper
{
    /* Dado una fecha, devolver si esta dentro del rango de fechas optimo
     * */
    public static function rangoEsOk($inicio, $fin, $medicionEnSemanas): bool
    {
        $diffEnDias = Carbon::parse($fin)->diffInDays($inicio);
        // semestre academico: 4 meses = 112 dias: rango [105 a 115] es Ok
        if ($medicionEnSemanas === 16) {
            return !($diffEnDias > 115 || $diffEnDias < 105);
        }
        //mensual: 1 mes = 28 dias: rango [21 a 35] es Ok
        if ($medicionEnSemanas === 4) { //Mensual
            return !($diffEnDias > 35 || $diffEnDias < 21);
        }

        // semanal: rango [4 a 7] es Ok
        return !($diffEnDias > 7 || $diffEnDias < 4);
    }

    /* Dado un numero de dias, nos devuelve su equivalente en semanas
     * Ej. 8 dias -> 1 semana y 1 dia, 14 dias -> 2 semanas
     * */
    public static function diasASemanas($inicio, $fin): string
    {
        $dias = Carbon::parse($fin)->diffInDays($inicio);

        if ($dias < 7) {
            return "Hay " . $dias . " dias entre estas fechas";
        }

        $semanas = intval($dias / 7);
        $dias_restantes = intval($dias % 7);

        return "Hay " . $semanas . " semanas" .
            ($dias_restantes > 0 ? " y " . $dias_restantes . " dias" : '') .
            ' entre estas fechas';
    }
}
