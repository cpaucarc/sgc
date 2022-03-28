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
        $semestre_nombre = $semestre === 0 ? 'Todos' : Semestre::query()->where('id', $semestre)->first()->nombre;

        $pdf = PDF::loadView('reporte.rsu.reporte_principal', [
            'semestre' => $semestre_nombre,
            'facultades' => $facultades
        ]);
        return $pdf->setPaper('a3')->stream();

    }

    /* RSU */
    public function indicador()
    {
        return view('admin.indicador.general');
    }

    public function indicador_reporte(Request $request)
    {
        $facultad = intval($request->input('facultad'));
        $semestre = intval($request->input('semestre'));
        $escuela = intval($request->input('escuela'));

        if ($facultad < 1) {
            abort(404, 'No existe ningun registro con estos parametros.');
        }

        try {
            if ($escuela > 0) {
                $entidad = Escuela::query()->where('id', $escuela);
            } else {
                $entidad = Facultad::query()->where('id', $facultad);
            }

            $entidad = $entidad->withCount('indicadores')->with('indicadores')
                ->with(['indicadores.analisis' => function ($query) use ($semestre) {
                    if ($semestre > 0) {
                        $query->where('semestre_id', $semestre);
                    }
                }])
                ->first();

            $semestre_nombre = $semestre === 0 ? 'Todos' : Semestre::query()->where('id', $semestre)->first()->nombre;
            $semestre_count = $semestre === 0 ? Semestre::count() : 1;

            $pdf = PDF::loadView('reporte.indicador.reporte_principal', [
                'semestre' => $semestre_nombre,
                'semestre_count' => $semestre_count,
                'entidad' => $entidad
            ]);
            return $pdf->setPaper('a3')->stream();
        } catch (\Exception $e) {
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }

    public function indicador_por_indicador(Request $request)
    {
        $indicadorable_id = intval($request->input('indicadorable_id'));
        $facultad = intval($request->input('facultad'));
        $semestre = intval($request->input('semestre'));
        $escuela = intval($request->input('escuela'));

        if ($facultad < 1) {
            abort(404, 'No existe ningun registro con estos parametros.');
        }

        try {
//            if ($escuela > 0) {
//                $entidad = Escuela::query()->where('id', $escuela);
//            } else {
//                $entidad = Facultad::query()->where('id', $facultad);
//            }
//
//            $entidad = $entidad->withCount('indicadores')->with('indicadores')
//                ->with(['indicadores.analisis' => function ($query) use ($semestre) {
//                    if ($semestre > 0) {
//                        $query->where('semestre_id', $semestre);
//                    }
//                }])
//                ->first();
//
//            $semestre_nombre = $semestre === 0 ? 'Todos' : Semestre::query()->where('id', $semestre)->first()->nombre;
//            $semestre_count = $semestre === 0 ? Semestre::count() : 1;

            $pdf = PDF::loadView('reporte.indicador.reporte_por_indicador', [
                'indicadorable_id' => $indicadorable_id,
                'facultad' => $facultad,
                'semestre' => $semestre,
                'escuela' => $escuela,
            ]);
            return $pdf->setPaper('a3')->stream();
        } catch (\Exception $e) {
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }

}
