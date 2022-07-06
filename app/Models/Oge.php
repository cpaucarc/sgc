<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;

class Oge
{

    public static function datos($dni)
    {
        $datos = self::datosDocente($dni);

        if (is_null($datos))
            $datos = self::datosEstudiante($dni);

        if (is_null($datos))
            return null;

        return $datos;
    }

    public static function datosEstudiante($dni)
    {
        $response = Http::withToken(env('OGE_TOKEN'))
            ->get(env('OGE_API') . 'ensenianza_aprendizaje/01?codigo=' . $dni);
        $response = $response->json();

        if (!isset($response['dni']))
            return null;

        return $response;
    }

    public static function datosDocente($dni)
    {
        $response = Http::withToken(env('OGE_TOKEN'))
            ->get(env('OGE_API') . 'proceso_docente/01?codigo=' . $dni);
        $response = $response->json();

        if (!isset($response['dni']))
            return null;

        return $response;
    }

    public static function listaDocentes($depto_id, $semeste)
    {
        $response = Http::withToken(env('OGE_TOKEN'))
            ->get(env('OGE_API') . 'proceso_docente/departamento/02?departamento=' . $depto_id . '&semestre='.$semeste);

        $response = $response->json();

        return $response;
    }

}
