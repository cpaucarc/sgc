<?php

namespace App\Http\Livewire\Admin;

use App\Models\Facultad;
use Livewire\Component;

class ListaFacultades extends Component
{
    public $search = "";

    public $listeners = ['render'];

    public function render()
    {
        $facultades = Facultad::query()
            ->where('nombre', 'like', '%' . $this->search . '%')
            ->where('abrev', 'like', '%' . $this->search . '%')
            ->orderBy('nombre')
            ->get();

        return view('livewire.admin.lista-facultades', compact('facultades'));
    }
}
