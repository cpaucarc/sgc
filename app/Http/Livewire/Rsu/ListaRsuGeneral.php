<?php

namespace App\Http\Livewire\Rsu;

use App\Models\Entidad;
use App\Models\Entidadable;
use App\Models\Oficina;
use App\Models\ResponsabilidadSocial;
use App\Models\Semestre;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListaRsuGeneral extends Component
{
    use WithPagination;

    public $semestres = null;
    public $semestre_seleccionado;
    public $search = "";

    public function mount()
    {
        $this->semestres = Semestre::orderBy('nombre', 'desc')->get();
        $this->semestre_seleccionado = $this->semestres->first()->id;
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
            ->select('id', 'uuid', 'titulo', 'lugar', 'fecha_inicio', 'fecha_fin', 'escuela_id', 'empresa_id')
            ->with('escuela:id,nombre', 'empresa:id,nombre,ruc')
            ->where(function ($query) {
                $query->where('titulo', 'like', '%' . $this->search . '%')
                    ->orWhere('lugar', 'like', '%' . $this->search . '%');
            });

        if (count($entidad_facultad)) { // El usuario pertenece a alguna facultad
            $rsu = $rsu->whereIn('escuela_id', function ($query) use ($entidad_facultad) {
                $query->select('id')->from('escuelas')->whereIn('facultad_id', $entidad_facultad);
            });
        } else { // El usuario NO pertenece a ninguna facultad
            $rsu = $rsu->whereIn('escuela_id', $entidad_escuela);
        }
        $rsu = $rsu->where('semestre_id', $this->semestre_seleccionado);
        $rsu = $rsu->paginate(10);

        return view('livewire.rsu.lista-rsu-general', compact('rsu'));
    }
}
