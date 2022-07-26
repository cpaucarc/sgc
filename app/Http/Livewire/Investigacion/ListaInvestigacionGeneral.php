<?php

namespace App\Http\Livewire\Investigacion;

use App\Models\Entidadable;
use App\Models\Escuela;
use App\Models\Investigacion;
use App\Models\Semestre;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaInvestigacionGeneral extends Component
{
    public $search;
    public $escuelas_id, $facultades_id;
    public $estado = 1, $semestres = null, $semestre = 0;

    public $escuelas = null, $escuela_seleccionado = 0;

    public function mount()
    {
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

        $this->semestres = Semestre::query()->orderBy('nombre', 'desc')->get();
        $this->semestre = $this->semestres->where('activo', true)->first()->id;

        if (count($this->facultades_id)) {
            $this->escuelas = Escuela::query()->whereIn('facultad_id', $this->facultades_id)->get();
        }
    }

    public function render()
    {
        $investigaciones = Investigacion::query()
            ->select('id', 'uuid', 'titulo', 'fecha_publicacion', 'escuela_id', 'estado_id', 'semestre_id', 'created_at')
            ->with('escuela:id,nombre', 'estado:id,nombre,color', 'semestre:id,nombre')
            ->withCount('investigadores')
            ->withSum('financiaciones as presupuesto_sum', 'investigacion_financiacion.presupuesto')
            ->where('titulo', 'like', '%' . $this->search . '%');

        if ($this->estado > 0)
            $investigaciones = $investigaciones->where('estado_id', $this->estado);

        if ($this->semestre > 0)
            $investigaciones = $investigaciones->where('semestre_id', $this->semestre);

        if (count($this->facultades_id)) { // El usuario pertenece a alguna facultad
            $investigaciones = $investigaciones->whereIn('escuela_id', function ($query) {
                $query->select('id')->from('escuelas')
                    ->whereIn('facultad_id', $this->facultades_id);
            });

            //Si la escuela seleccionada es mayor que cero.
            if ($this->escuela_seleccionado > 0) {
                $investigaciones = $investigaciones->where('escuela_id', $this->escuela_seleccionado);
            }
        } else { // El usuario NO pertenece a ninguna facultad
            $investigaciones = $investigaciones->whereIn('escuela_id', $this->escuelas_id);
        }

        $investigaciones = $investigaciones->orderBy('created_at', 'desc')->orderBy('titulo')->get();

        return view('livewire.investigacion.lista-investigacion-general', compact('investigaciones'));
    }
}
