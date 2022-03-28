<?php

namespace App\Http\Controllers;

use App\Models\Convalidacion;
use App\Models\Convenio;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Semestre;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index()
    {

    }

    /*Todo: Convenios */
    public function convenio()
    {
        return view('admin.convenio.general');
    }

    public function convenio_reporte(Request $request)
    {
        $facultad = intval($request->input('facultad'));
        $semestre = intval($request->input('semestre'));

        $convenios = Convenio::query()
            ->with('semestre', 'facultad')
            ->orderBy('semestre_id', 'desc')
            ->orderBy(Facultad::select('nombre')->whereColumn('facultades.id', 'convenios.facultad_id'));

        if ($facultad > 0) {
            $convenios = $convenios->where('facultad_id', $facultad);
        }
        if ($semestre > 0) {
            $convenios = $convenios->where('semestre_id', $semestre);
        }
        $convenios = $convenios->get();

        $facultad_nombre = $facultad === 0 ? 'Todos' : Facultad::query()->where('id', $facultad)->first()->nombre;
        $semestre_nombre = $semestre === 0 ? 'Todos' : Semestre::query()->where('id', $semestre)->first()->nombre;

        $pdf = PDF::loadView('reporte.convenio.reporte_principal', [
            'convenios' => $convenios,
            'facultad' => $facultad_nombre,
            'semestre' => $semestre_nombre]);
        return $pdf->setPaper('a3')->stream();
    }


    /*Todo: Convalidaciones */
    public function convalidacion()
    {
        return view('admin.convalidacion.general');
    }

    public function convalidacion_reporte(Request $request)
    {
        $facultad = intval($request->input('facultad'));
        $escuela = intval($request->input('escuela'));
        $semestre = intval($request->input('semestre'));

        $facultades = Facultad::query()->orderBy('nombre')
            ->select('id', 'nombre')
            ->with('escuelas.convalidacion.semestre');

        if ($escuela > 0) {
            $facultades = $facultades->with(['escuelas' => function ($query) use ($escuela) {
                $query->where('id', $escuela);
            }]);
        }

        if ($semestre > 0) {
            if ($escuela > 0) {
                $facultades = $facultades->with(['escuelas.convalidacion' => function ($query) use ($semestre, $escuela) {
                    $query->where('semestre_id', $semestre)
                        ->where('escuela_id', $escuela);
                }]);
            } else {
                $facultades = $facultades->with(['escuelas.convalidacion' => function ($query) use ($semestre) {
                    $query->where('semestre_id', $semestre);
                }]);
            }
        }

        if ($facultad > 0) {
            $facultades = $facultades->where('id', $facultad);
        }

        $facultades = $facultades->get();

        $semestre_nombre = $semestre === 0 ? 'Todos' : Semestre::query()->where('id', $semestre)->first()->nombre;

        $pdf = PDF::loadView('reporte.convalidacion.reporte_principal', [
            'semestre' => $semestre_nombre,
            'facultades' => $facultades
        ]);
        return $pdf->setPaper('a3')->stream();
    }

    /* RSU */
    public function rsu()
    {
        return view('admin.rsu.general');
    }

    public function rsu_reporte(Request $request)
    {
        $facultad = intval($request->input('facultad'));
        $semestre = intval($request->input('semestre'));
        $escuela = intval($request->input('escuela'));

        $facultades = Facultad::query()->orderBy('nombre')
            ->select('id', 'nombre')
            ->with('escuelas.rsu.semestre');

        if ($escuela > 0) {
            $facultades = $facultades->with(['escuelas' => function ($query) use ($escuela) {
                $query->where('id', $escuela);
            }]);
        }

        if ($semestre > 0) {
            $facultades = $facultades->with(['escuelas.rsu' => function ($query) use ($semestre) {
                $query->where('semestre_id', $semestre);
            }]);
        }

        if ($facultad > 0) {
            $facultades = $facultades->where('id', $facultad);
        }

        $facultades = $facultades->get();
//
//        $convenios = Convenio::query()
//            ->with('semestre', 'facultad')
//            ->orderBy('semestre_id', 'desc')
//            ->orderBy(Facultad::select('nombre')->whereColumn('facultades.id', 'convenios.facultad_id'));
//
//        if ($facultad > 0) {
//            $convenios = $convenios->where('facultad_id', $facultad);
//        }
//        if ($semestre > 0) {
//            $convenios = $convenios->where('semestre_id', $semestre);
//        }
//        $convenios = $convenios->get();
//
//        $facultad_nombre = $facultad === 0 ? 'Todos' : Facultad::query()->where('id', $facultad)->first()->nombre;
        $semestre_nombre = $semestre === 0 ? 'Todos' : Semestre::query()->where('id', $semestre)->first()->nombre;

        $pdf = PDF::loadView('reporte.rsu.reporte_principal', [
            'semestre' => $semestre_nombre,
            'facultades' => $facultades
        ]);
        return $pdf->setPaper('a3')->stream();

//        [
//        'convenios' => $convenios,
//        'facultad' => $facultad_nombre,
//        'semestre' => $semestre_nombre]
    }

    /*Todo: Biblioteca */
    public function biblioteca()
    {
        return view('admin.biblioteca.general');
    }

    public function biblioteca_reporte_material(Request $request)
    {
        $facultad = intval($request->input('facultad'));
        $semestre = intval($request->input('semestre'));

        $facultades = Facultad::query()->orderBy('nombre')
            ->select('id', 'nombre')
            ->with('materialBibliografico');

        if ($facultad > 0) {
            $facultades = $facultades->where('id', $facultad);
        }

        if ($semestre > 0) {
            $facultades = $facultades->with(['materialBibliografico' => function ($query) use ($semestre) {
                $query->where('semestre_id', $semestre);
            }]);
        }

        $facultades = $facultades->get();

        $semestre_nombre = $semestre === 0 ? 'Todos' : Semestre::query()->where('id', $semestre)->first()->nombre;

        $pdf = PDF::loadView('reporte.biblioteca.reporte_material', [
            'semestre' => $semestre_nombre,
            'facultades' => $facultades
        ]);
        return $pdf->setPaper('a3')->stream();
    }

    public function biblioteca_reporte_visitante(Request $request)
    {

        $facultad = intval($request->input('facultad'));
        $semestre = intval($request->input('semestre'));
        $escuela = intval($request->input('escuela'));

        $facultades = Facultad::query()->orderBy('nombre')
            ->select('id', 'nombre')
            ->with('escuelas.bibliotecaVisitante.semestre');

        if ($escuela > 0) {
            $facultades = $facultades->with(['escuelas' => function ($query) use ($escuela) {
                $query->where('id', $escuela);
            }]);
        }

        if ($semestre > 0) {
            $facultades = $facultades->with(['escuelas.rsu' => function ($query) use ($semestre) {
                $query->where('semestre_id', $semestre);
            }]);
        }

        if ($facultad > 0) {
            $facultades = $facultades->where('id', $facultad);
        }

        $facultades = $facultades->get();

        $semestre_nombre = $semestre === 0 ? 'Todos' : Semestre::query()->where('id', $semestre)->first()->nombre;

        $pdf = PDF::loadView('reporte.biblioteca.reporte_visitantes', [
            'semestre' => $semestre_nombre,
            'facultades' => $facultades
        ]);
        return $pdf->setPaper('a3')->stream();
    }

    /*Todo: Biblioteca */
    public function bolsa()
    {
        return view('admin.bolsa.general');
    }

    public function bolsa_reporte(Request $request)
    {

        $facultad = intval($request->input('facultad'));
        $semestre = intval($request->input('semestre'));
        $escuela = intval($request->input('escuela'));

        $facultades = Facultad::query()->orderBy('nombre')
            ->select('id', 'nombre')
            ->with('escuelas.bolsaPostulante.semestre');

        if ($escuela > 0) {
            $facultades = $facultades->with(['escuelas' => function ($query) use ($escuela) {
                $query->where('id', $escuela);
            }]);
        }

        if ($semestre > 0) {
            $facultades = $facultades->with(['escuelas.bolsaPostulante' => function ($query) use ($semestre) {
                $query->where('semestre_id', $semestre);
            }]);
        }

        if ($facultad > 0) {
            $facultades = $facultades->where('id', $facultad);
        }

        $facultades = $facultades->get();

        $semestre_nombre = $semestre === 0 ? 'Todos' : Semestre::query()->where('id', $semestre)->first()->nombre;

        $pdf = PDF::loadView('reporte.bolsa.reporte_bolsa_postulantes', [
            'semestre' => $semestre_nombre,
            'facultades' => $facultades
        ]);
        return $pdf->setPaper('a3')->stream();
    }

    /*Todo: Bienestar Universitario */
    public function bienestar()
    {
        return view('admin.bienestar.general');
    }

    public function bienestar_reporte(Request $request)
    {

        $facultad = intval($request->input('facultad'));
        $escuela = intval($request->input('escuela'));
        $anio = intval($request->input('anio'));

        $facultades = Facultad::query()->orderBy('nombre')
            ->select('id', 'nombre')
            ->with('escuelas.comedor');

        if ($escuela > 0) {
            $facultades = $facultades->with(['escuelas' => function ($query) use ($escuela) {
                $query->where('id', $escuela);
            }]);
        }

        if ($anio > 0) {
            $facultades = $facultades->with(['escuelas.comedor' => function ($query) use ($anio) {
                $query->where('anio', $anio);
            }]);
        }

        if ($facultad > 0) {
            $facultades = $facultades->where('id', $facultad);
        }

        $facultades = $facultades->get();

        $anio_nombre = $anio === 0 ? 'Todos' : $anio;

        $pdf = PDF::loadView('reporte.bienestar.reporte_atencion_comedor', [
            'anio' => $anio_nombre,
            'facultades' => $facultades
        ]);
        return $pdf->setPaper('a3')->stream();
    }

}
