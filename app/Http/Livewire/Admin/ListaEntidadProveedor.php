<?php

namespace App\Http\Livewire\Admin;

use App\Models\Entidad;
use App\Models\Proveedor;
use Livewire\Component;

class ListaEntidadProveedor extends Component
{
    public $entidad_id;

    public function mount($entidad_id)
    {
        $this->entidad_id = $entidad_id;
    }

    public function render()
    {
        $entradas = Proveedor::query()
            ->with('entrada','responsable')
            ->where('entidad_id', $this->entidad_id)
            ->get();
        return view('livewire.admin.lista-entidad-proveedor', compact('entradas'));
    }
}
