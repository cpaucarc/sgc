<?php

namespace App\Http\Controllers;

use App\Exports\AuditoriaExport;
use App\Exports\BienestarExport;
use App\Exports\BolsaExport;
use App\Exports\ConvalidacionExport;
use App\Exports\ConvenioExport;
use App\Exports\EscuelaExport;
use App\Exports\IndicadorExport;
use App\Exports\InvestigacionExport;
use App\Exports\MaterialExport;
use App\Exports\RsuExport;
use App\Exports\VisitanteExport;
use App\Models\Convenio;
use App\Models\Escuela;
use App\Models\Estado;
use App\Models\Facultad;
use App\Models\Semestre;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        try {
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
        } catch (\Exception $e) {
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }

    public function convenio_excel(Request $request)
    {
        try {
            $facultad = intval($request->input('facultad'));
            $semestre = intval($request->input('semestre'));
            return Excel::download(new ConvenioExport($facultad, $semestre), $this->generarNombreReporte('convenio'));
        } catch (\Exception $e) {
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }

    /*Todo: Convalidaciones */
    public function convalidacion()
    {
        return view('admin.convalidacion.general');
    }

    public function convalidacion_reporte(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }

    public function convalidacion_excel(Request $request)
    {
        try {
            $facultad = intval($request->input('facultad'));
            $escuela = intval($request->input('escuela'));
            $semestre = intval($request->input('semestre'));
            return Excel::download(new ConvalidacionExport($facultad, $escuela, $semestre), $this->generarNombreReporte('convalidacion'));
        } catch (\Exception $e) {
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }

    /* RSU */
    public function rsu()
    {
        return view('admin.rsu.general');
    }

    public function rsu_reporte(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }

    public function rsu_excel(Request $request)
    {
        try {
            $facultad = intval($request->input('facultad'));
            $semestre = intval($request->input('semestre'));
            $escuela = intval($request->input('escuela'));
            return Excel::download(new RsuExport($facultad, $escuela, $semestre), $this->generarNombreReporte('rsu'));
        } catch (\Exception $e) {
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }

    /* Auditoria */
    public function auditoria()
    {
        return view('admin.auditoria.general');
    }

    public function auditoria_reporte(Request $request)
    {
        $facultad = intval($request->input('facultad'));
        $tipo = intval($request->input('tipo'));

        try {
            $facultades = Facultad::query()
                ->select('id', 'nombre');

            $facultades = $facultades->with(['auditorias' => function ($query) use ($tipo) {
                $query->withCount('documentos');
                if ($tipo > -1) {
                    $query->where('es_auditoria_interno', $tipo);
                }
            }]);

            if ($facultad > 0) {
                $facultades = $facultades->where('id', $facultad);
            }

            $facultades = $facultades->orderBy('nombre')->get();

            $facultad_nombre = $facultad === 0 ? 'Todos' : Facultad::where('id', $facultad)->first()->nombre;
            $tipo_nombre = $tipo === -1 ? 'Todos' : ($tipo === 0 ? 'Auditoria Externa' : 'Auditoria Interna');

            $pdf = PDF::loadView('reporte.auditorias.reporte_principal', [
                'tipo' => $tipo_nombre,
                'facultad' => $facultad_nombre,
                'facultades' => $facultades
            ]);
            return $pdf->setPaper('a3')->stream();
        } catch (\Exception $e) {
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }

    public function auditoria_excel(Request $request)
    {
        try {
            $facultad = intval($request->input('facultad'));
            $tipo = intval($request->input('tipo'));
            return Excel::download(new AuditoriaExport($facultad, $tipo), $this->generarNombreReporte('auditoria'));
        } catch (\Exception $e) {
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }

    /* Investigacion */
    public function investigacion()
    {
        return view('admin.investigacion.general');
    }

    public function investigacion_reporte(Request $request)
    {
        $facultad = intval($request->input('facultad'));
        $escuela = intval($request->input('escuela'));
        $estado = intval($request->input('estado'));

        try {
            $facultades = Facultad::query()->select('id', 'nombre');

            $facultades = $facultades->with(['escuelas' => function ($query) use ($escuela, $estado) {
                if ($escuela > 0) {
                    $query->where('id', $escuela);
                }
                $query->select('id', 'nombre', 'facultad_id')
                    ->with(['investigaciones' => function ($q2) use ($estado) {
                        $q2->select('id', 'titulo', 'escuela_id', 'estado_id', 'created_at');
                        if ($estado > 0) {
                            $q2->where('estado_id', $estado);
                        }
                    }]);
                $query->orderBy('nombre');
            }]);

            if ($facultad > 0) {
                $facultades = $facultades->where('id', $facultad);
            }

            $facultades = $facultades->orderBy('nombre')->get();

            $estado_nombre = $estado === 0 ? 'Todos' : Estado::query()->where('id', $estado)->first()->nombre;
            $facultad_nombre = $facultad === 0 ? 'Todos' : Facultad::where('id', $facultad)->first()->nombre;
            $escuela_nombre = $escuela === 0 ? 'Todos' : Escuela::where('id', $escuela)->first()->nombre;

            $pdf = PDF::loadView('reporte.investigacion.reporte_principal', [
                'estado' => $estado_nombre,
                'facultad' => $facultad_nombre,
                'escuela' => $escuela_nombre,
                'facultades' => $facultades
            ]);
            return $pdf->setPaper('a3')->stream();
        } catch (\Exception $e) {
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }

    public function investigacion_excel(Request $request)
    {
        try {
            $facultad = intval($request->input('facultad'));
            $escuela = intval($request->input('escuela'));
            $estado = intval($request->input('estado'));
            return Excel::download(new InvestigacionExport($facultad, $escuela, $estado), $this->generarNombreReporte('investigacion'));
        } catch (\Exception $e) {
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }

    /* Indicador */
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

    public function indicador_excel(Request $request)
    {
        try {
            $facultad = intval($request->input('facultad'));
            $escuela = intval($request->input('escuela'));
            $semestre = intval($request->input('semestre'));
            return Excel::download(new IndicadorExport($facultad, $escuela, $semestre), $this->generarNombreReporte('indicador'));
        } catch (\Exception $e) {
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }

    // FIXME: No funciona 😢
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

    /* Biblioteca */
    public function biblioteca()
    {
        return view('admin.biblioteca.general');
    }

    public function biblioteca_reporte_material(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }

    public function biblioteca_excel_material(Request $request)
    {
        try {
            $facultad = intval($request->input('facultad'));
            $semestre = intval($request->input('semestre'));

            return Excel::download(new MaterialExport($facultad, $semestre), $this->generarNombreReporte('biblioteca_material'));
        } catch (\Exception $e) {
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }

    public function biblioteca_reporte_visitante(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }

    public function biblioteca_excel_visitante(Request $request)
    {
        try {
            $facultad = intval($request->input('facultad'));
            $semestre = intval($request->input('semestre'));
            $escuela = intval($request->input('escuela'));

            return Excel::download(new VisitanteExport($facultad, $escuela, $semestre), $this->generarNombreReporte('biblioteca_visitante'));
        } catch (\Exception $e) {
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }

    /*Todo: Bolsa de Trabajo */
    public function bolsa()
    {
        return view('admin.bolsa.general');
    }

    public function bolsa_reporte(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }

    public function bolsa_excel(Request $request)
    {
        try {
            $facultad = intval($request->input('facultad'));
            $semestre = intval($request->input('semestre'));
            $escuela = intval($request->input('escuela'));
            return Excel::download(new BolsaExport($facultad, $escuela, $semestre), $this->generarNombreReporte('bolsa_de_trabajo'));
        } catch (\Exception $e) {
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }

    /*Todo: Bienestar Universitario */
    public function bienestar()
    {
        return view('admin.bienestar.general');
    }

    public function bienestar_reporte(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }

    public function bienestar_excel(Request $request)
    {
        try {
            $facultad = intval($request->input('facultad'));
            $escuela = intval($request->input('escuela'));
            $anio = intval($request->input('anio'));
            return Excel::download(new BienestarExport($facultad, $escuela, $anio), $this->generarNombreReporte('binestar'));
        } catch (\Exception $e) {
            abort(404, 'Hubo un error inesperado.\\n' . $e);
        }
    }

    private function generarNombreReporte($tipo)
    {
        return 'sgcfcm_' . $tipo . '_' . date("Ymd_his") . '.xlsx';
    }

}
