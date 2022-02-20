<?php

namespace App\Http\Controllers;

use App\Models\ResponsabilidadSocial;
use Illuminate\Http\Request;

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

        return view('rsu.show', compact('rsu'));
    }

    public function por_usuario()
    {
        // RSU por usuario
    }
}
