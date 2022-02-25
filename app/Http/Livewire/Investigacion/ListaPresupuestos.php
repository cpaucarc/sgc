<?php

namespace App\Http\Livewire\Investigacion;

use App\Models\Investigacion;
use Livewire\Component;

class ListaPresupuestos extends Component
{
    public $investigacion;

    public function mount($investigacion_id)
    {
        $this->investigacion = Investigacion::query()
            ->select('id')
            ->with('financiaciones')
            ->where('id', $investigacion_id)
            ->first();
    }

    public function render()
    {
        return view('livewire.investigacion.lista-presupuestos');
    }
}
