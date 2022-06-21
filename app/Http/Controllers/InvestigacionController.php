<?php

namespace App\Http\Controllers;

use App\Models\Investigacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvestigacionController extends Controller
{
    public function index()
    {
        return view('investigacion.index');
    }

    public function show($uuid)
    {
        $investigacion = Investigacion::query()
            ->with('escuela', 'estado', 'sublinea', 'semestre')
            ->where('uuid', $uuid)->first();

        return view('investigacion.show', compact('investigacion'));
    }

    public function crear()
    {
        return view('investigacion.crear');
    }
}
