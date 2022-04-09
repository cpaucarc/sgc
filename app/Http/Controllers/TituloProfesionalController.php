<?php

namespace App\Http\Controllers;

use App\Models\Entidad;
use App\Models\Solicitud;
use App\Models\Tesis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TituloProfesionalController extends Controller
{
    public function index()
    {
        $alumnos = Entidad::query()->where('oficina_id', 9)->pluck('id')->toArray();
        $entidades = Auth::user()->entidades->pluck('id')->toArray();

        //Si es un alumno, lo redirrecionamos
        if (!empty(array_intersect($alumnos, $entidades))) {
            return redirect()->route('tpu.request');
        }

        $escuela_id = User::escuelas_id(Auth::user()->id);

        if (empty($escuela_id))
            return redirect()->route('dashboard');

        return view('tpu.index', compact('escuela_id'));
    }

    public function request()
    {
        return view('tpu.request');
    }

    public function requests()
    {
        $alumnos = Entidad::query()->where('oficina_id', 9)->pluck('id')->toArray();
        $entidades = Auth::user()->entidades->pluck('id')->toArray();

        //Si es un alumno, lo redirrecionamos
        if (!empty(array_intersect($alumnos, $entidades))) {
            return redirect()->route('tpu.request');
        }

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
