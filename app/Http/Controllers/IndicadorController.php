<?php

namespace App\Http\Controllers;

use App\Models\Entidad;
use App\Models\Entidadable;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Indicador;
use App\Models\Indicadorable;
use App\Models\Proceso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndicadorController extends Controller
{
    public function index()
    {
        $entidades_autorizadas = Entidad::query()
            ->whereIn('oficina_id', [1, 5]) // 1:Director de Escuela, 5:Decano
            ->pluck('id')->toArray();
        $entidades_del_usuario = Auth::user()->entidades->pluck('id')->toArray();

        //Si no esta asignado a alguna entidad autorizada, lanzar error 403
        if (empty(array_intersect($entidades_del_usuario, $entidades_autorizadas))) {
            abort(403, 'No estas autorizado para estar aquí');
        }

        //Si esta autorizado, buscamos a que escuelas o facultades pertenece
        $facultades = Facultad::query()
            ->withCount('indicadores')
            ->with(['indicadores' => function ($query) {
                $query->select('indicadores.id', 'proceso_id');
            }])
            ->find(User::facultades_id(Auth::user()->id));

        $escuelas = Escuela::query()
            ->withCount('indicadores')
            ->with(['indicadores' => function ($query) {
                $query->select('indicadores.id', 'proceso_id');
            }])
            ->find(User::escuelas_id(Auth::user()->id));

        $data = [];
        foreach ($facultades as $facultad) {
            $subdata = [];
            foreach ($facultad->indicadores as $indicador) {
                if (array_key_exists($indicador->proceso_id, $subdata)) {
                    $subdata[$indicador->proceso_id]["cantidad"] += 1;
                } else {
                    $subdata[$indicador->proceso_id] = ["proceso" => $indicador->proceso->nombre,
                        "cantidad" => 1];
                }
            }
            $data[] = ["nombre" => $facultad->nombre, "uuid" => $facultad->uuid, "count" => $facultad->indicadores_count, "tipo" => 2, "data" => $subdata];
        }

        foreach ($escuelas as $escuela) {
            $subdata = [];
            foreach ($escuela->indicadores as $indicador) {
                if (array_key_exists($indicador->proceso_id, $subdata)) {
                    $subdata[$indicador->proceso_id]["cantidad"] += 1;
                } else {
                    $subdata[$indicador->proceso_id] = ["proceso" => $indicador->proceso->nombre,
                        "cantidad" => 1];
                }
            }
            $data[] = ["nombre" => $escuela->nombre, "uuid" => $escuela->uuid, "count" => $escuela->indicadores_count, "tipo" => 1, "data" => $subdata];
        }

        return view('indicador.index', compact('data'));

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

        $nombre = "";
        if ($tipo == 1) { // 1: escuela
            $escuela = Escuela::where('uuid', $uuid)->first();
            $nombre = $escuela->nombre;
            $indicadorable = $indicadorable->where('indicadorable_id', $escuela->id)
                ->where('indicadorable_type', "App\\Models\\Escuela")->first();

        } else { // 2: facultad
            $facultad = Facultad::where('uuid', $uuid)->first();
            $nombre = $facultad->nombre;
            $indicadorable = $indicadorable->where('indicadorable_id', $facultad->id)
                ->where('indicadorable_type', "App\\Models\\Facultad")->first();
        }

        return view('indicador.por_indicador', compact('indicadorable', 'nombre', 'tipo', 'uuid'));
    }

}
