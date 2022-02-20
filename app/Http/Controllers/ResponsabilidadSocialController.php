<?php

namespace App\Http\Controllers;

use App\Models\ResponsabilidadSocial;
use App\Models\RsuParticipante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponsabilidadSocialController extends Controller
{
    public function index()
    {
        //Todos los RSU
        return view('rsu.index');
    }

    public function show($uuid)
    {
        // Vista de un RSU
        $rsu = ResponsabilidadSocial::query()
            ->with('empresa', 'escuela', 'semestre')
            ->where('uuid', $uuid)->first();

        $es_responsable = RsuParticipante::query()
            ->where('es_responsable', true)
            ->where('codigo_participante', Auth::user()->codigo)
            ->where('responsabilidad_social_id', $rsu->id)
            ->exists();

        return view('rsu.show', compact('rsu', 'es_responsable'));
    }

    public function por_usuario()
    {
        // RSU por usuario
    }
}
