<?php

namespace App\Http\Livewire\Admin;

use App\Models\Entidad;
use Livewire\Component;
use Livewire\WithPagination;

class ListaEntidades extends Component
{
    use WithPagination;

    public $search = "";
    public $listeners = ['render'];

    public function render()
    {
        $entidades = Entidad::query()
            ->with('pertenencia')
            ->where('nombre', 'like', '%' . $this->search . '%')
            ->withCount('salidas', 'entradas', 'actividades')
            ->orderBy('nombre')
            ->paginate(10);
        return view('livewire.admin.lista-entidades', compact('entidades'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
