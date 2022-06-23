<?php

namespace App\Http\Livewire\Biblioteca;

use App\Models\Entidadable;
use App\Models\MaterialBibliografico;
use App\Models\Semestre;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaGeneralMaterialBibliografico extends Component
{
    public $semestre = 0, $semestres = null;
    public $facultad_ids = [];

    public $listeners = ['render', 'eliminar'];

    public function mount($facultad_ids)
    {
        $this->semestres = Semestre::query()->orderBy('nombre', 'desc')->get();
        $this->semestre = $this->semestres->where('activo', true)->first()->id;

        $this->facultad_ids = $facultad_ids;

    }

    public function render()
    {
        $materiales = MaterialBibliografico::query()
            ->with('semestre:id,nombre', 'facultad:id,abrev')
            ->where('semestre_id', $this->semestre)
            ->whereIn('facultad_id', $this->facultad_ids)
            ->orderBy('id', 'desc')
            ->get();
        return view('livewire.biblioteca.lista-general-material-bibliografico', compact('materiales'));
    }

    //Funciones
    public function eliminar($id)
    {
        $materialBibliografico = MaterialBibliografico::where('id', $id)->first();

        if ($materialBibliografico != null) {
            $materialBibliografico->delete();
        }
    }

}
