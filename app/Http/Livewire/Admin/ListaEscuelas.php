<?php

namespace App\Http\Livewire\Admin;

use App\Models\Escuela;
use App\Models\Facultad;
use Livewire\Component;

class ListaEscuelas extends Component
{
    public $search = "";
    public $facultades, $facultad_seleccionado = 0;

    public $listeners = ['render'];

    public function mount()
    {
        $this->facultades = Facultad::select('id', 'nombre')->orderBy('nombre')->get();
    }

    public function render()
    {
        $escuelas = Escuela::query()
            ->select('id', 'nombre', 'abrev', 'facultad_id')
            ->where('nombre', 'like', '%' . $this->search . '%')
            ->with('facultad:id,nombre');

        if ($this->facultad_seleccionado > 0) {
            $escuelas = $escuelas->where('facultad_id', $this->facultad_seleccionado);
        }

        $escuelas = $escuelas->orderBy('facultad_id')->orderBy('nombre')
            ->get();

        return view('livewire.admin.lista-escuelas', compact('escuelas'));
    }
}
