<?php

namespace App\Http\Livewire\Btu;

use App\Models\BolsaPostulante;
use App\Models\Escuela;
use App\Models\Semestre;
use Livewire\Component;

class ListaGeneralPostulantes extends Component
{
    public $semestre = 0, $semestres = null;
    public $escuela = 0, $escuelas = null;
    public $facultad_ids = [];

    public $listeners = ['render', 'eliminar'];

    public function mount($facultad_ids)
    {
        $this->facultad_ids = $facultad_ids;

        $this->semestres = Semestre::query()->orderBy('nombre', 'desc')->get();
        $this->semestre = $this->semestres->first()->id;

        $this->escuelas = Escuela::query()->whereIn('facultad_id', $this->facultad_ids)->orderBy('nombre', 'desc')->get();
    }

    public function eliminar($id)
    {
        BolsaPostulante::find($id)->delete();
    }

    public function render()
    {
        $postulantes = BolsaPostulante::query()
            ->with('semestre:id,nombre', 'escuela:id,nombre,facultad_id', 'escuela.facultad:id,abrev')
            ->where('semestre_id', $this->semestre);

        if ($this->escuela > 0) {
            $postulantes = $postulantes->where('escuela_id', $this->escuela);
        }

        $postulantes = $postulantes->orderBy('id', 'desc')->get();
        return view('livewire.btu.lista-general-postulantes', compact('postulantes'));
    }
}
