<?php

namespace App\Http\Livewire\Convenio;

use App\Models\Convenio;
use App\Models\Escuela;
use App\Models\Semestre;
use Livewire\Component;

class ListaConvenios extends Component
{
    public $semestres = null, $semestre = 0;
    public $facultad_ids = [];

    public function mount($facultad_ids)
    {
        $this->facultad_ids = $facultad_ids;

        $this->semestres = Semestre::query()->orderBy('nombre', 'desc')->get();
    }

    public function eliminar($id)
    {
        $convenio = Convenio::find($id)->delete();
    }

    public function render()
    {
        $convenios = Convenio::query()
            ->with('semestre:id,nombre', 'facultad:id,nombre,abrev');
        if ($this->semestre > 0) {
            $convenios = $convenios->where('semestre_id', $this->semestre);
        }
        $convenios = $convenios->orderBy('id', 'desc')->get();
        return view('livewire.convenio.lista-convenios', compact('convenios'));
    }
}
