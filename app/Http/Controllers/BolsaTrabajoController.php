<?php

namespace App\Http\Controllers;

use App\Models\Entidadable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BolsaTrabajoController extends Controller
{
    public function index()
    {
        $callback = function ($query) {
            $query->whereIn('id', Auth::user()->entidades->pluck('id'));
        };

        $facultad_ids = Entidadable::query()
            ->where('entidadable_type', "App\\Models\\Facultad")
            ->whereHas('entidad', $callback)
            ->pluck('entidadable_id');

        if (count($facultad_ids) < 1) {
            abort(403, 'No tienes los permisos para estar en esta página');
        }

        return view('btu.index', compact('facultad_ids'));
    }

    public function registrarPostulante()
    {
        return view('btu.registrar-postulante');
    }
}
