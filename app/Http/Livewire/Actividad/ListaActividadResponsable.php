<?php

namespace App\Http\Livewire\Actividad;

use App\Models\Actividad;
use App\Models\ActividadCompletado;
use App\Models\Proceso;
use App\Models\Responsable;
use App\Models\Semestre;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaActividadResponsable extends Component
{
    public $semestres = null;
    public $semestre_seleccionado = null;
    public $entidades = [];
    public $procesos = null;
    public $proceso_seleccionado = null;

    public function mount()
    {
        $this->semestres = Semestre::orderBy('nombre', 'desc')->get();
        $this->semestre_seleccionado = $this->semestres->where('activo', 1)->first()->id;

        $this->entidades = Auth::user()->entidades->pluck('id');

        $this->procesos = Proceso::query()
            ->whereIn('id', function ($query) {
                $query->select('proceso_id')->from('actividades')
                    ->whereIn('id', function ($query2) {
                        $query2->select('actividad_id')->from('responsables')
                            ->whereIn('entidad_id', $this->entidades);
                    });
            })
            ->orderBy('nombre')->get();
        $this->proceso_seleccionado = count($this->procesos) ? $this->procesos->first()->id : 0;
    }

    public function render()
    {
        $actividades = Responsable::query()
            ->addSelect(['estado' => ActividadCompletado::select('created_at')
                ->whereColumn('responsable_id', 'responsables.id')
                ->where('semestre_id', $this->semestre_seleccionado)
                ->where('user_id', Auth::user()->id)
                ->take(1)
            ])
            ->with('actividad', 'entidad')
            ->whereIn('entidad_id', $this->entidades)
            ->whereHas('actividad', function ($query) {
                return $query->where('proceso_id', $this->proceso_seleccionado);
            })
            ->orderBy(Actividad::select('nombre')->whereColumn('actividades.id', 'responsables.actividad_id'))
            ->get();

        return view('livewire.actividad.lista-actividad-responsable', compact('actividades'));
    }
}
