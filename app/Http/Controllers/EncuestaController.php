<?php

namespace App\Http\Controllers;

use App\Models\EncuestaLink;
use App\Models\EncuestaPregunta;
use Illuminate\Http\Request;

class EncuestaController extends Controller
{
    public function rsu($uuid)
    {
        $proceso = 9;
        $preguntas = EncuestaPregunta::where('proceso_id', $proceso)->get();

        $encuesta = EncuestaLink::where('uuid', $uuid)
            ->first();

        return view('encuesta.rsu', compact('uuid', 'encuesta', 'preguntas'));
    }
}
