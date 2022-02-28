<?php

namespace App\Http\Livewire\Admin;

use App\Models\Cliente;
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
        $salidas = Cliente::query()
            ->with('salida', 'entidad', 'responsable')
            ->where('entidad_id', $this->entidad_id)
            ->get();
        return view('livewire.admin.lista-entidad-cliente', compact('salidas'));
    }
}
