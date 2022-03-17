<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConvenioController extends Controller
{
    public function index()
    {
        $facultad_ids = User::facultades_id(Auth::user()->id);

        if (count($facultad_ids) < 1) {
            abort(403, 'No tienes los permisos para estar en esta página');
        }

        return view('convenio.index', compact('facultad_ids'));
    }

    public function registrarConvenio()
    {
        return view('convenio.registrar-convenio');
    }
}
