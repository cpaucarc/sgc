<?php

namespace App\Http\Livewire\Actividad;

use App\Models\Proveedor;
use App\Models\Responsable;
use Livewire\Component;

class ActividadEntradas extends Component
{
    public $responsable_id;
    public $semestre_id;
    public $open = false;
    public $proveedor_seleccionado = null;

    public function mount($responsable_id, $semestre_id)
    {
        $this->responsable_id = $responsable_id;
        $this->semestre_id = $semestre_id;
    }

    public function render()
    {
        $proveedores = Proveedor::query()
            ->where('responsable_id', $this->responsable_id)
            ->get();

        return view('livewire.actividad.actividad-entradas', compact('proveedores'));
    }

    /* Funciones */
    public function abrirModal($proveedor_id)
    {
        $this->open = true;
        $this->proveedor_seleccionado = Proveedor::query()
            ->with('entrada', 'entrada.documentos', 'entidad')
            ->where('id', $proveedor_id)
            ->first();
    }
}
