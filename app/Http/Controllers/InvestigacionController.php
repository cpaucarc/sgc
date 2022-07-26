<?php

namespace App\Http\Controllers;

use App\Models\Investigacion;
use App\Models\InvestigacionInvestigador;
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
            ->with('escuela', 'sublinea', 'semestre')
            ->where('uuid', $uuid)->first();

        $es_responsable = InvestigacionInvestigador::query()
            ->where('es_responsable', true)
            ->whereIn('investigador_id', function ($query) {
                $query->select('id')->from('investigadores')
                    ->where('dni_investigador', Auth::user()->persona->dni);
            })
            ->where('investigacion_id', $investigacion->id)
            ->exists();

        return view('investigacion.show', compact('investigacion', 'es_responsable'));
    }

    public function crear()
    {
        return view('investigacion.crear');
    }
}
