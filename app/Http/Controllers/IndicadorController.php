<?php

namespace App\Http\Controllers;

use App\Models\Entidad;
use App\Models\Entidadable;
use App\Models\Escuela;
use App\Models\Facultad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            $facultad = Facultad::select('id', 'nombre', 'abrev')->withCount('indicadores')->where('id', $facultad_id)->first();
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

            $escuela = Escuela::select('id', 'nombre', 'abrev')->withCount('indicadores')->where('id', $escuela_id)->first();
            $escuela_indicadores = $escuela->indicadores->groupBy('proceso_id')->map->count();

            return view('indicador.index', compact('escuela', 'escuela_indicadores'));
        }
    }



}
