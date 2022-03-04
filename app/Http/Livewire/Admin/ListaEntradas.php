<?php

namespace App\Http\Livewire\Admin;

use App\Models\Entrada;
use App\Models\Proceso;
use Livewire\Component;

class ListaEntradas extends Component
{
    public $search = "";
    public $proceso, $procesos = 0;
    public $entradas = null;

    public $listeners = ['render', 'eliminar'];

    public function mount()
    {
        $this->procesos = Proceso::query()->orderBy('nombre')->get();
    }

    public function updatedProceso($value)
    {
        if ($value > 0) {
            $this->entradas = Entrada::query()
                ->where('nombre', 'like', '%' . $this->search . '%')
                ->where('proceso_id', $value)
                ->orderBy('codigo')
                ->get();
        } else {
            $this->entradas = null;
        }
    }

    public function render()
    {
        $this->updatedProceso($this->proceso);

        return view('livewire.admin.lista-entradas');
    }

    /* Funciones */

    public function eliminar($id)
    {
        Entrada::find($id)->delete();
    }

}
