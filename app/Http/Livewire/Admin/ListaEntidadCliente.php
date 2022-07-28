<?php

namespace App\Http\Livewire\Admin;

use App\Models\Cliente;
use App\Models\Entidad;
use Livewire\Component;
use Livewire\WithPagination;

class ListaEntidadCliente extends Component
{
    use WithPagination;

    public $entidad_id;

    public $listeners = ['render', 'eliminarActividad'];

    public function mount($entidad_id)
    {
        $this->entidad_id = $entidad_id;
    }

    public function render()
    {
        $salidas = Cliente::query()
            ->with('respsalida')
            ->where('entidad_id', $this->entidad_id)
            ->paginate(10);
        return view('livewire.admin.lista-entidad-cliente', compact('salidas'));
    }

    /* Funciones */

    public function openModal()
    {
        $this->emitTo('admin.asignar-salida-entidad', 'openModal');
    }

    public function eliminarActividad($id)
    {
        Cliente::find($id)->delete();
    }
}
