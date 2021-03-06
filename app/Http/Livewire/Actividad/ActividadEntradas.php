<?php

namespace App\Http\Livewire\Actividad;

use App\Models\Documento;
use App\Models\Proveedor;
use App\Models\Responsable;
use Livewire\Component;

class ActividadEntradas extends Component
{
    public $responsable_id;
    public $semestre_id;
    public $open = false;
    public $proveedor_seleccionado = null;
    public $documentos = null;

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
            ->with('entrada', 'entidad')
            ->where('id', $proveedor_id)
            ->first();
        $this->documentos = Documento::query()
            ->where('semestre_id', $this->semestre_id)
            ->whereIn('id', function ($query) {
                $query->select('documento_id')
                    ->from('documento_enviado')
                    ->where('documentable_id', $this->proveedor_seleccionado->entrada_id)
                    ->where('documentable_type', 'App\\Models\\Entrada');
            })
            ->get();
    }
}
