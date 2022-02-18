<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponsabilidadSocialController extends Controller
{
    public function index()
    {
        //Todos los RSU
        return view('rsu.index');
    }

    public function por_usuario()
    {
        // RSU por usuario
    }
}
