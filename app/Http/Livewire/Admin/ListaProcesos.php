<?php

namespace App\Http\Livewire\Admin;

use App\Models\Proceso;
use Livewire\Component;

class ListaProcesos extends Component
{
    public $search = "";

    public $listeners = ['render', 'eliminar'];

    public function render()
    {
        $procesos = Proceso::query()
            ->where('nombre', 'like', '%' . $this->search . '%')
            ->withCount('actividades')
            ->orderBy('nombre')
            ->get();
        return view('livewire.admin.lista-procesos', compact('procesos'));
    }

    /* Funciones */

    public function eliminar($id)
    {
        Proceso::find($id)->delete();
    }
}
