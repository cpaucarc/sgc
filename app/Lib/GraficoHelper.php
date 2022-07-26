<?php

namespace App\Lib;

class GraficoHelper
{
    public static $colores = array(
        // Grafico de barras
        'rose_300' => '#fda4af', // Tailwind: rose-300
        'amber_300' => '#fcd34d',  // Tailwind: amber-300
        'green_300' => '#86efac',  // Tailwind: green-300
        // Grafico de lineas
        'rose_600' => '#e11d48', // Tailwind: rose-600
        'amber_600' => '#d97706',  // Tailwind: amber-600
        'green_600' => '#16a34a',  // Tailwind: green-600
    );

    /* Los indicadores puede ser Tipo Maximizar o Minimizar
     * Maximizar: los parametros son min <= sat <= sob
     * Minimizar: los parametros son min > sat > sob
     * */
    public static function esTipoMaximizar($sobresaliente, $minimo)
    {
        $sobresaliente = floatval($sobresaliente);
        $minimo = floatval($minimo);

        if ($minimo > $sobresaliente) {
            return false; // será del tipo Minimizar
        }

        return true;
    }

    public static function asignarColoresMaximizar($sobresaliente, $minimo, $valor)
    {
        if ($valor <= $minimo) {
            return self::$colores['rose_300'];
        } elseif ($valor <= $sobresaliente) {
            return self::$colores['amber_300'];
        } else {
            return self::$colores['green_300'];
        }
    }

    public static function asignarColoresMinimizar($sobresaliente, $minimo, $valor)
    {
        if ($valor >= $minimo) {
            return self::$colores['rose_300'];
        } elseif ($valor >= $sobresaliente) {
            return self::$colores['amber_300'];
        } else {
            return self::$colores['green_300'];
        }
    }

    public static function asignarColor($sobresaliente, $minimo, $valor)
    {
        $esMaximizar = self::esTipoMaximizar($sobresaliente, $minimo);

        return $esMaximizar ? self::asignarColoresMaximizar($sobresaliente, $minimo, $valor)
            : self::asignarColoresMinimizar($sobresaliente, $minimo, $valor);
    }
}
