<?php

namespace App\Http\Livewire\Biblioteca;

use App\Models\BibliotecaVisitante;
use App\Models\Entidadable;
use App\Models\Escuela;
use App\Models\MaterialBibliografico;
use App\Models\Semestre;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaGeneralVisitantes extends Component
{
    public $semestre = 0, $semestres = null;
    public $escuela = 0, $escuelas = null;
    public $facultad_ids = [];

    public $listeners = ['render', 'eliminar'];

    public function mount($facultad_ids)
    {
        $this->facultad_ids = $facultad_ids;

        $this->semestres = Semestre::orderByDesc('nombre')->get();
        $this->semestre = $this->semestres->firstWhere('activo', true)->id;

        $this->escuelas = Escuela::query()->whereIn('facultad_id', $this->facultad_ids)->orderBy('nombre', 'desc')->get();
    }

    public function render()
    {
        $visitantes = BibliotecaVisitante::query()
            ->with('semestre:id,nombre', 'escuela:id,nombre,facultad_id', 'escuela.facultad:id,abrev')
            ->where('semestre_id', $this->semestre);

        if ($this->escuela > 0) {
            $visitantes = $visitantes->where('escuela_id', $this->escuela);
        }

        $visitantes = $visitantes->orderBy('id', 'desc')->get();

        return view('livewire.biblioteca.lista-general-visitantes', compact('visitantes'));
    }

    //Funciones
    public function eliminar($id)
    {
        $bibliotecaVisitante = BibliotecaVisitante::where('id', $id)->first();

        if ($bibliotecaVisitante != null) {
            $bibliotecaVisitante->delete();
        }
    }
}
