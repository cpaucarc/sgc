<?php

namespace App\Http\Livewire\Investigacion;

use App\Models\Entidadable;
use App\Models\Investigacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaInvestigacionGeneral extends Component
{
    public $inicio, $fin, $search;
    public $escuelas_id, $facultades_id;

    public function mount()
    {
        $this->inicio = Carbon::today()->startOfYear()->format('Y-m-d');
        $this->fin = Carbon::today()->format('Y-m-d');

        $callback = function ($query) {
            $query->whereIn('id', Auth::user()->entidades->pluck('id'));
        };

        $this->escuelas_id = Entidadable::query()
            ->where('entidadable_type', "App\\Models\\Escuela")
            ->whereHas('entidad', $callback)
            ->pluck('entidadable_id');

        $this->facultades_id = Entidadable::query()
            ->where('entidadable_type', "App\\Models\\Facultad")
            ->whereHas('entidad', $callback)
            ->pluck('entidadable_id');
    }

    public function render()
    {
        $investigaciones = Investigacion::query()
            ->select('id', 'uuid', 'titulo', 'fecha_publicacion', 'escuela_id', 'estado_id', 'created_at')
            ->with('escuela:id,nombre', 'estado:id,nombre,color')
            ->withCount('investigadores')
            ->withSum('financiaciones as presupuesto_sum', 'investigacion_financiacion.presupuesto')
            ->where('titulo', 'like', '%' . $this->search . '%')
            ->whereBetween('fecha_publicacion', [$this->inicio, $this->fin]);

        if (count($this->facultades_id)) { // El usuario pertenece a alguna facultad
            $investigaciones = $investigaciones->whereIn('escuela_id', function ($query) {
                $query->select('id')->from('escuelas')
                    ->whereIn('facultad_id', $this->facultades_id);
            });
        } else { // El usuario NO pertenece a ninguna facultad
            $investigaciones = $investigaciones->whereIn('escuela_id', $this->escuelas_id);
        }

        $investigaciones = $investigaciones->orderBy('fecha_publicacion')->orderBy('titulo')->get();

        return view('livewire.investigacion.lista-investigacion-general', compact('investigaciones'));
    }
}
