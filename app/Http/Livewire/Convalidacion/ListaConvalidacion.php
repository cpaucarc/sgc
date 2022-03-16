<?php

namespace App\Http\Livewire\Convalidacion;

use App\Models\Convalidacion;
use App\Models\Escuela;
use App\Models\Semestre;
use Livewire\Component;

class ListaConvalidacion extends Component
{
    public $semestres = null, $semestre = 0;
    public $escuelas = null, $escuela = 0;
    public $facultad_ids = [];

    public function mount($facultad_ids)
    {
        $this->facultad_ids = $facultad_ids;

        $this->semestres = Semestre::query()->orderBy('nombre', 'desc')->get();
        $this->semestre = $this->semestres->first()->id;

        $this->escuelas = Escuela::query()->whereIn('facultad_id', $this->facultad_ids)->orderBy('nombre', 'desc')->get();
    }

    public function eliminar($id)
    {
        $convalidacion = Convalidacion::where('id', $id);
        $convalidacion->delete();
    }

    public function render()
    {
        $convalidaciones = Convalidacion::query()
            ->with('semestre:id,nombre', 'escuela:id,nombre,facultad_id', 'escuela.facultad:id,abrev')
            ->where('semestre_id', $this->semestre);

        if ($this->escuela > 0) {
            $convalidaciones = $convalidaciones->where('escuela_id', $this->escuela);
        }

        $convalidaciones = $convalidaciones->orderBy('id', 'desc')->get();

        return view('livewire.convalidacion.lista-convalidacion', compact('convalidaciones'));
    }
}
