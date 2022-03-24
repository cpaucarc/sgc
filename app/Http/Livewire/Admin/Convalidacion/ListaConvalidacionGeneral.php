<?php

namespace App\Http\Livewire\Admin\Convalidacion;

use App\Models\Convalidacion;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Semestre;
use Livewire\Component;

class ListaConvalidacionGeneral extends Component
{
    public $facultades = null, $facultad = 0;
    public $escuelas = null, $escuela = 0;
    public $semestres = null, $semestre = 0;

    public function mount()
    {
        $this->facultades = Facultad::query()->select('id', 'nombre')->orderBy('nombre')->get();
        $this->semestres = Semestre::query()->select('id', 'nombre')->orderBy('nombre', 'desc')->get();
    }

    public function render()
    {
        $this->escuelas = Escuela::query()
            ->select('id', 'nombre')
            ->where('facultad_id', $this->facultad)
            ->orderBy('nombre')
            ->get();
        $convalidaciones = Convalidacion::query()
            ->with('semestre', 'escuela')
            ->orderBy('semestre_id', 'desc')
            ->orderBy(Escuela::select('nombre')->whereColumn('escuelas.id', 'convalidaciones.escuela_id'));

        if ($this->escuela > 0) {
            $convalidaciones = $convalidaciones->where('escuela_id', $this->escuela);
        }
        if ($this->semestre > 0) {
            $convalidaciones = $convalidaciones->where('semestre_id', $this->semestre);
        }
        $convalidaciones = $convalidaciones->get();
        return view('livewire.admin.convalidacion.lista-convalidacion-general', compact('convalidaciones'));
    }
}
