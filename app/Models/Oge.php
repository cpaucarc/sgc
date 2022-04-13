<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;

class Oge
{

    public static function datos($dni)
    {
        // Se obtienen los datos básicos de un estudiante o docente, a partir de su DNI
        $response = Http::withToken(env('OGE_TOKEN'))
            ->get(env('OGE_API') . 'ensenianza_aprendizaje/01?codigo=' . $dni);
        $response = $response->json();

        if (!isset($response['dni']))
            return null;

        return $response;
    }

}
