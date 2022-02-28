<?php

namespace App\Http\Livewire\Admin;

use App\Models\Entidad;
use Livewire\Component;

class ListaEntidadCliente extends Component
{
    public $entidad_id;

    public function mount($entidad_id)
    {
        $this->entidad_id = $entidad_id;
    }

    public function render()
    {
        $entidad = Entidad::query()
            ->select('id')
            ->with('salidas')
            ->where('id', $this->entidad_id)
            ->first();
        return view('livewire.admin.lista-entidad-cliente', compact('entidad'));
    }
}
