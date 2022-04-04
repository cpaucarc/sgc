<?php

namespace App\Http\Controllers;

use App\Models\Entidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BachillerController extends Controller
{
    public function index()
    {
        $alumnos = Entidad::query()->where('oficina_id', 9)->pluck('id')->toArray();
        $entidades = Auth::user()->entidades->pluck('id')->toArray();

        //Si es un alumno, lo redirrecionamos
        if (!empty(array_intersect($alumnos, $entidades))) {
            return redirect()->route('bachiller.request');
        }

        $escuela_id = User::escuelas_id(Auth::user()->id);

        if (empty($escuela_id))
            return redirect()->route('dashboard');

        return view('bachiller.index', compact('escuela_id'));
    }

    public function request()
    {
        return view('bachiller.request');
    }

    public function requests()
    {
        $alumnos = Entidad::query()->where('oficina_id', 9)->pluck('id')->toArray();
        $entidades = Auth::user()->entidades->pluck('id')->toArray();

        //Si es un alumno, lo redirrecionamos
        if (!empty(array_intersect($alumnos, $entidades))) {
            return redirect()->route('bachiller.request');
        }

        return view('bachiller.requests');
    }
}
