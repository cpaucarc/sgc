<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Tesis;
use Illuminate\Http\Request;

class TituloProfesionalController extends Controller
{
    public function index()
    {
        return view('tpu.index');
    }

    public function request()
    {
        return view('tpu.request');
    }

    public function requests()
    {
        return view('tpu.requests');
    }

    public function tesis(Solicitud $solicitud)
    {

        return view('tpu.tesis', compact('solicitud'));
    }

    public function seeTesis(Solicitud $solicitud, Tesis $tesis)
    {

        return view('tpu.see-tesis', compact('solicitud', 'tesis'));
    }
}
