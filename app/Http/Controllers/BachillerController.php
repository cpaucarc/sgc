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
    /* Variables
     * Sirve para saber el usuario a que facultad o escuela pertenece.
     */
    public $facultad = null, $escuela = null;

    public function index()
    {
        $alumnos = Entidad::query()->where('oficina_id', 9)->pluck('id')->toArray();
        $entidades = Auth::user()->entidades->pluck('id')->toArray();

        //Si es un alumno, lo redirrecionamos para que realice la solicitud de bachiller
        if (!empty(array_intersect($alumnos, $entidades))) {
            return redirect()->route('bachiller.request');
        }

        //Toma los ids de la facultad que pertence el usuario. Retorna en un array.
        $facultades_id = User::facultades_id(Auth::user()->id);
        $escuelas_id = User::escuelas_id(Auth::user()->id);

        $callback_socicitud = Solicitud::query()
            ->where('tipo_solicitud_id', 1)// 1 : Bachiller
            ->withCount('documentos')
            ->having('documentos_count', '>', 0);

        $callback_bachilleres = GradoEstudiante::query()->distinct('dni_estudiante')
            ->where('grado_academico_id', 3);

        if (count($escuelas_id) > 0) {
            $this->escuela = Escuela::query()->whereIn('id', $escuelas_id)->first();
            $this->facultad = Facultad::query()->whereIn('id', function ($query) {
                $query->select('facultad_id')->from('escuelas')
                    ->where('id', $this->escuela->id);
            })->first();

            $solicitudes = $callback_socicitud->where('escuela_id', $this->escuela->id)->get();
            $bachilleres = $callback_bachilleres->where('escuela_id', $this->escuela->id)->count();

        } elseif (count($facultades_id) > 0) {
            $this->facultad = Facultad::query()->whereIn('id', $facultades_id)->first();

            $solicitudes = $callback_socicitud->whereIn('escuela_id', function ($query) {
                $query->select('id')->from('escuelas')
                    ->where('facultad_id', $this->facultad->id);
            })->get();

            $bachilleres = $callback_bachilleres->whereIn('escuela_id', function ($query) {
                $query->select('id')->from('escuelas')
                    ->where('facultad_id', $this->facultad->id);
            })->count();

        } else {
//            abort(403, 'No tienes los permisos para estar en esta página');
            return redirect()->route('dashboard');
        }

        $solicitudesCompletas = $solicitudes->filter(function ($item) {
            return $item->documentos_count == 15; // 15 : Requisitos para bachiller
        });

        $solicitudesIncompletas = $solicitudes->filter(function ($item) {
            return $item->documentos_count < 15; // 15 : Requisitos para bachiller
        });

        $facultad = $this->facultad;
        $escuela = $this->escuela;

        $incompletas = $solicitudesIncompletas->count();
        $completas = $solicitudesCompletas->count();

        /* Evia: facultad y escuela
         * Si el usuario es de tipo facultad, el parametro facultad evia dato y la escuela es nulo.
         * Si el usuario es de tipo escuela, el parametro facultad evia dato y la escuela tambien envia dato.
         */
        return view('bachiller.index', compact('facultad', 'escuela', 'incompletas', 'completas', 'bachilleres'));
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

    public function incompletas()
    {
        $alumnos = Entidad::query()->where('oficina_id', 9)->pluck('id')->toArray();
        $entidades = Auth::user()->entidades->pluck('id')->toArray();

        //Si es un alumno, lo redirecionamos para que realice la solicitud de bachiller
        if (!empty(array_intersect($alumnos, $entidades))) {
            return redirect()->route('bachiller.request');
        }

        $facultades_id = User::facultades_id(Auth::user()->id);
        $escuelas_id = User::escuelas_id(Auth::user()->id);

        $callback_socicitud = Solicitud::query()
            ->where('tipo_solicitud_id', 1)// 1 : Bachiller
            ->withCount('documentos')
            ->having('documentos_count', '>', 0);

        if (count($escuelas_id) > 0) {
            $this->escuela = Escuela::query()->whereIn('id', $escuelas_id)->first();
            $this->facultad = Facultad::query()->whereIn('id', function ($query) {
                $query->select('facultad_id')->from('escuelas')
                    ->where('id', $this->escuela->id);
            })->first();

            $solicitudes = $callback_socicitud->where('escuela_id', $this->escuela->id)->get();

        } elseif (count($facultades_id) > 0) {
            $this->facultad = Facultad::query()->whereIn('id', $facultades_id)->first();

            $solicitudes = $callback_socicitud->whereIn('escuela_id', function ($query) {
                $query->select('id')->from('escuelas')
                    ->where('facultad_id', $this->facultad->id);
            })->get();

        } else {
//            abort(403, 'No tienes los permisos para estar en esta página');
            return redirect()->route('dashboard');
        }
        $solicitudesIncompletas = $solicitudes->filter(function ($item) {
            return $item->documentos_count < 15; // 15 : Requisitos para bachiller
        });

        return view('bachiller.solicitudes.incompletas', compact('solicitudesIncompletas'));
    }

    public function completas()
    {
        $alumnos = Entidad::query()->where('oficina_id', 9)->pluck('id')->toArray();
        $entidades = Auth::user()->entidades->pluck('id')->toArray();

        //Si es un alumno, lo redirrecionamos para que realice la solicitud de bachiller
        if (!empty(array_intersect($alumnos, $entidades))) {
            return redirect()->route('bachiller.request');
        }

        $facultades_id = User::facultades_id(Auth::user()->id);
        $escuelas_id = User::escuelas_id(Auth::user()->id);

        $callback_socicitud = Solicitud::query()
            ->where('tipo_solicitud_id', 1)// 1 : Bachiller
            ->withCount('documentos')
            ->having('documentos_count', '>', 0);

        if (count($escuelas_id) > 0) {
            $this->escuela = Escuela::query()->whereIn('id', $escuelas_id)->first();
            $this->facultad = Facultad::query()->whereIn('id', function ($query) {
                $query->select('facultad_id')->from('escuelas')
                    ->where('id', $this->escuela->id);
            })->first();

            $solicitudes = $callback_socicitud->where('escuela_id', $this->escuela->id)->get();

        } elseif (count($facultades_id) > 0) {
            $this->facultad = Facultad::query()->whereIn('id', $facultades_id)->first();

            $solicitudes = $callback_socicitud->whereIn('escuela_id', function ($query) {
                $query->select('id')->from('escuelas')
                    ->where('facultad_id', $this->facultad->id);
            })->get();

        } else {
//            abort(403, 'No tienes los permisos para estar en esta página');
            return redirect()->route('dashboard');
        }

        $solicitudesCompletas = $solicitudes->filter(function ($item) {
            return $item->documentos_count == 15; // 15 : Requisitos para bachiller
        });

        return view('bachiller.solicitudes.completas', compact('solicitudesCompletas'));
    }
}
