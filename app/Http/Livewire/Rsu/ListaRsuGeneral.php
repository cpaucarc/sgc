<?php

namespace App\Http\Livewire\Rsu;

use App\Models\Entidadable;
use App\Models\Escuela;
use App\Models\ResponsabilidadSocial;
use App\Models\Semestre;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListaRsuGeneral extends Component
{
    use WithPagination;

    public $semestres = null;
    public $semestre_seleccionado;
    public $search = "", $estado = 0;

    public $escuelas = null, $escuela_seleccionado = 0;

    public function mount()
    {
        $this->semestres = Semestre::orderBy('nombre', 'desc')->get();
        $this->semestre_seleccionado = $this->semestres->where('activo', 1)->first()->id;

        $entidades = Auth::user()->entidades->pluck('id');

        $callback = function ($query) use ($entidades) {
            $query->whereIn('id', $entidades);
        };

        $entidad_facultad = Entidadable::query()
            ->where('entidadable_type', "App\\Models\\Facultad")
            ->whereHas('entidad', $callback)
            ->pluck('entidadable_id');

        if ($entidad_facultad) {
            $this->escuelas = Escuela::query()->whereIn('facultad_id', $entidad_facultad)->get();
        }

    }

    public function render()
    {
        $entidades = Auth::user()->entidades->pluck('id');

        $callback = function ($query) use ($entidades) {
            $query->whereIn('id', $entidades);
        };

        $entidad_escuela = Entidadable::query()
            ->where('entidadable_type', "App\\Models\\Escuela")
            ->whereHas('entidad', $callback)
            ->pluck('entidadable_id');

        $entidad_facultad = Entidadable::query()
            ->where('entidadable_type', "App\\Models\\Facultad")
            ->whereHas('entidad', $callback)
            ->pluck('entidadable_id');

        $rsu = ResponsabilidadSocial::query()
            ->select('id', 'uuid', 'titulo', 'lugar', 'fecha_inicio', 'fecha_fin', 'escuela_id')
            ->with('escuela:id,nombre')
            ->where(function ($query) {
                $query->where('titulo', 'like', '%' . $this->search . '%')
                    ->orWhere('lugar', 'like', '%' . $this->search . '%');
            })
            ->where('semestre_id', $this->semestre_seleccionado);

        if (count($entidad_facultad)) { // El usuario pertenece a alguna facultad
            $rsu = $rsu->whereIn('escuela_id', function ($query) use ($entidad_facultad) {
                $query->select('id')->from('escuelas')->whereIn('facultad_id', $entidad_facultad);
            });
            //Si la escuela seleccionada es mayor que cero.
            if ($this->escuela_seleccionado > 0) {
                $rsu = $rsu->where('escuela_id', $this->escuela_seleccionado);
            }
        } else { // El usuario NO pertenece a ninguna facultad
            $rsu = $rsu->whereIn('escuela_id', $entidad_escuela);
        }

        if (intval($this->estado) === 1) // Sin iniciar
            $rsu = $rsu->where('fecha_inicio', '>', now());

        if (intval($this->estado) === 2) // En progreso
            $rsu = $rsu->where('fecha_inicio', '<=', now())->where('fecha_fin', '>=', now());

        if (intval($this->estado) === 3) // En progreso
            $rsu = $rsu->where('fecha_fin', '<', now());

        $rsu = $rsu->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.rsu.lista-rsu-general', compact('rsu', 'entidad_facultad'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingEstado()
    {
        $this->resetPage();
    }

    public function updatingSemestreSeleccionado()
    {
        $this->resetPage();
    }
}
