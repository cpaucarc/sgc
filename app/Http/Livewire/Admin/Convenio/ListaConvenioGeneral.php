<?php

namespace App\Http\Livewire\Admin\Convenio;

use App\Models\Convenio;
use App\Models\Facultad;
use App\Models\Semestre;
use Livewire\Component;

class ListaConvenioGeneral extends Component
{
    public $facultades = null, $facultad = 0;
    public $semestres = null, $semestre = 0;

    public function mount()
    {
        $this->facultades = Facultad::query()->select('id', 'nombre')->orderBy('nombre')->get();
        $this->semestres = Semestre::query()->select('id', 'nombre')->orderBy('nombre', 'desc')->get();
    }

    public function render()
    {
        $convenios = Convenio::query()
            ->with('semestre', 'facultad')
            ->orderBy('semestre_id', 'desc')
            ->orderBy(Facultad::select('nombre')->whereColumn('facultades.id', 'convenios.facultad_id'));

        if ($this->facultad > 0) {
            $convenios = $convenios->where('facultad_id', $this->facultad);
        }
        if ($this->semestre > 0) {
            $convenios = $convenios->where('semestre_id', $this->semestre);
        }
        $convenios = $convenios->get();
        return view('livewire.admin.convenio.lista-convenio-general', compact('convenios'));
    }
}
