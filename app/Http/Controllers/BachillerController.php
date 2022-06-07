<?php

namespace App\Http\Controllers;

use App\Models\Entidad;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\GradoEstudiante;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BachillerController extends Controller
{
    public function index()
    {
        $alumnos = Entidad::query()->where('oficina_id', 9)->pluck('id')->toArray();
        $entidades = Auth::user()->entidades->pluck('id')->toArray();

        //Si es un alumno, lo redirrecionamos para que realice la solicitud de bachiller
        if (!empty(array_intersect($alumnos, $entidades))) {
            return redirect()->route('bachiller.request');
        }

        $facultades_id = User::facultades_id(Auth::user()->id);
        $escuelas_id = User::escuelas_id(Auth::user()->id);

        $callback_socicitud=Solicitud::query()
            ->where('tipo_solicitud_id', 1)// 1 : Bahiller
            ->withCount('documentos')
            ->having('documentos_count', '>', 0);

        $callback_bachilleres=GradoEstudiante::query()->distinct('dni_estudiante')
            ->where('grado_academico_id', 3);

        $facultades=null;
        $escuelas=null;

        if (count($escuelas_id) > 0) {
            $escuelas = Escuela::query()->orderBy('nombre')->whereIn('id', $escuelas_id)->get();
            $escuela = $escuelas->first()->id;

            $solicitudes = $callback_socicitud->where('escuela_id', $escuela)->get();
            $bachilleres = $callback_bachilleres->where('escuela_id',$escuela)->get();

        } elseif (count($facultades_id) > 0) {
            $facultades = Facultad::query()->orderBy('nombre')->whereIn('id', $facultades_id)->get();
            $facultad = $facultades->first()->id;

            $escuelas = Escuela::query()->orderBy('nombre')->where('facultad_id', $facultad)->get();
            $solicitudes = $callback_socicitud->get();
            $bachilleres = $callback_bachilleres->get();

        } else {
//            abort(403, 'No tienes los permisos para estar en esta página');
            return redirect()->route('dashboard');
        }

        $solicitudesCompletas = $solicitudes->filter(function ($item) {
            return $item->documentos_count == 8; // 8 : Requisitos de titulo profesional
        });

        $solicitudesIncompletas = $solicitudes->filter(function ($item) {
            return $item->documentos_count < 8;
        });

        return view('bachiller.index', compact('facultades','escuelas','solicitudesIncompletas','solicitudesCompletas','bachilleres'));
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
