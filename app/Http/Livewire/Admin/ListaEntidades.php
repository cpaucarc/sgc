<?php

namespace App\Http\Livewire\Admin;

use App\Models\Entidad;
use Livewire\Component;

class ListaEntidades extends Component
{
    public $search = "";
    public $listeners = ['render'];

    public function render()
    {
        $entidades = Entidad::query()
            ->with('pertenencia')
            ->where('nombre', 'like', '%' . $this->search . '%')
            ->withCount('salidas', 'entradas', 'actividades')
            ->orderBy('nombre')
            ->get();
        return view('livewire.admin.lista-entidades', compact('entidades'));
    }
}
