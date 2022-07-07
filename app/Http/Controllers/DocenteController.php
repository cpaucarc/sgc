<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index()
    {
        return view('docente.index');
    }

    public function por_semestre()
    {
        return view('docente.por_semestre');
    }

    public function resultados()
    {
        return view('docente.resultados');
    }

    public function capacitaciones()
    {
        return view('docente.capacitaciones');
    }
}
