<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\ActividadCompletado;
use App\Models\Responsable;
use App\Models\Semestre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActividadController extends Controller
{
    public function index()
    {
        return view('actividad.index');
    }

    public function show($id, $semestre) //$id -> Id del Responsable
    {
        return view('actividad.show', compact('id', 'semestre'));
    }

    public function proveer()
    {
        return view('actividad.proveer');
    }

    public function recibidos()
    {
        return view('actividad.recibidos');
    }
}
