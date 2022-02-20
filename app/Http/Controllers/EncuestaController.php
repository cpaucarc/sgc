<?php

namespace App\Http\Controllers;

use App\Models\EncuestaLink;
use App\Models\EncuestaPregunta;
use Illuminate\Http\Request;

class EncuestaController extends Controller
{
    public function rsu($uuid)
    {
        $encuesta = EncuestaLink::where('uuid', $uuid)->first();

        if (!$encuesta)
            abort(404);

        $proceso = 9;
        $preguntas = EncuestaPregunta::where('proceso_id', $proceso)->get();

        return view('encuesta.encuesta-rsu', compact('uuid', 'encuesta', 'preguntas'));
    }
}
