<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConvalidacionController extends Controller
{
    public function index()
    {
        $facultad_ids = User::facultades_id(Auth::user()->id);

        if (count($facultad_ids) < 1) {
            abort(403, 'No tienes los permisos para estar en esta página');
        }

        return view('convalidacion.index', compact('facultad_ids'));
    }
    public function registrarConvalidacion()
    {
        return view('convalidacion.registrar-convalidacion');
    }
}
