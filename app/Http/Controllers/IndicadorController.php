<?php

namespace App\Http\Controllers;

use App\Models\Entidad;
use App\Models\Entidadable;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Indicador;
use App\Models\Indicadorable;
use App\Models\Proceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndicadorController extends Controller
{
    public function index()
    {
        $entidades = Auth::user()->entidades->pluck('id');

        // Buscar si pertenece a la oficina: Decano
        $es_decano = Entidad::where('oficina_id', 5)->whereIn('id', $entidades)->exists();

        if ($es_decano) {
            // Averiguar de que facultad es decano
            $facultad_id = Entidadable::select('entidadable_id')
                ->where('entidadable_type', "App\\Models\\Facultad")
                ->whereIn('entidad_id', $entidades)
                ->first()->entidadable_id;

            $facultad = Facultad::select('id', 'uuid', 'nombre', 'abrev')->withCount('indicadores')->where('id', $facultad_id)->first();
            $facultad_indicadores = $facultad->indicadores->groupBy('proceso_id')->map->count();

            return view('indicador.index', compact('facultad', 'facultad_indicadores'));

        } else {
            // Buscar si pertenece a la oficina: Director Escuela o Departamento
            $es_director = Entidad::whereIn('oficina_id', [1, 2])->whereIn('id', $entidades)->exists();

            if (!$es_director) {
                abort(403);
            }

            // Averiguar de que escuela es Director de Escuela o Departamento
            $escuela_id = Entidadable::select('entidadable_id')
                ->where('entidadable_type', "App\\Models\\Escuela")
                ->whereIn('entidad_id', $entidades)
                ->first()->entidadable_id;

            $escuela = Escuela::select('id', 'uuid', 'nombre', 'abrev')->withCount('indicadores')->where('id', $escuela_id)->first();
            $escuela_indicadores = $escuela->indicadores->groupBy('proceso_id')->map->count();

            return view('indicador.index', compact('escuela', 'escuela_indicadores'));
        }
    }

    public function proceso($proceso_id, $tipo, $uuid)
    {
        $proceso = Proceso::query()->where('id', $proceso_id)->first();

        $indicadores = Indicador::query()
            ->with('medicion', 'reporte')
            ->where('proceso_id', $proceso_id);

        if ($tipo == 1) { // 1: escuela
            $escuela = Escuela::where('uuid', $uuid)->first();

            $indicadores = $indicadores->whereHas('escuelas', function ($query) use ($escuela) {
                $query->where('escuelas.id', $escuela->id);
            })->get();

            return view('indicador.por_proceso', compact('proceso', 'uuid', 'tipo', 'indicadores', 'escuela'));

        } else { // 2: facultad
            $facultad = Facultad::where('uuid', $uuid)->first();

            $indicadores = $indicadores->whereHas('facultades', function ($query) use ($facultad) {
                $query->where('facultades.id', $facultad->id);
            })->get();

            return view('indicador.por_proceso', compact('proceso', 'uuid', 'tipo', 'indicadores', 'facultad'));
        }
    }

    public function indicador($indicador_id, $tipo, $uuid)
    {
        $indicadorable = Indicadorable::query()
            ->with('indicador:id,objetivo,cod_ind_inicial,formula,proceso_id,frecuencia_medicion_id,frecuencia_reporte_id', 'indicador.medicion', 'indicador.reporte', 'indicador.proceso')
            ->where('indicador_id', $indicador_id);

        if ($tipo == 1) { // 1: escuela
            $escuela = Escuela::where('uuid', $uuid)->first();

            $indicadorable = $indicadorable->where('indicadorable_id', $escuela->id)
                ->where('indicadorable_type', "App\\Models\\Escuela")->first();

            return view('indicador.por_indicador', compact('indicadorable', 'escuela', 'tipo', 'uuid'));

        } else { // 2: facultad
            $facultad = Facultad::where('uuid', $uuid)->first();
            $indicadorable = $indicadorable->where('indicadorable_id', $facultad->id)
                ->where('indicadorable_type', "App\\Models\\Facultad")->first();
            return view('indicador.por_indicador', compact('indicadorable', 'facultad', 'tipo', 'uuid'));
        }
    }

}
