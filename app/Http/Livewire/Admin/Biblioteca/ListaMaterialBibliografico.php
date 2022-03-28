<?php

namespace App\Http\Livewire\Admin\Biblioteca;

use App\Models\Facultad;
use App\Models\MaterialBibliografico;
use App\Models\Semestre;
use Livewire\Component;

class ListaMaterialBibliografico extends Component
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
        $materialBibliografico = MaterialBibliografico::query()
            ->with('semestre', 'facultad')
            ->orderBy('semestre_id', 'desc')
            ->orderBy(Facultad::select('nombre')->whereColumn('facultades.id', 'material_bibliografico.facultad_id'));

        if ($this->facultad > 0) {
            $materialBibliografico = $materialBibliografico->where('facultad_id', $this->facultad);
        }
        if ($this->semestre > 0) {
            $materialBibliografico = $materialBibliografico->where('semestre_id', $this->semestre);
        }

        $materialBibliografico = $materialBibliografico->get();

        return view('livewire.admin.biblioteca.lista-material-bibliografico', compact('materialBibliografico'));
    }
}
