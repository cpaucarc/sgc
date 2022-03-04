<?php

namespace App\Http\Livewire\Admin;

use App\Models\Proceso;
use App\Models\Salida;
use Livewire\Component;

class ListaSalidas extends Component
{
    public $search = "";
    public $proceso, $procesos = 0;
    public $salidas = null;

    public $listeners = ['render', 'eliminar'];

    public function mount()
    {
        $this->procesos = Proceso::query()->orderBy('nombre')->get();
    }

    public function updatedProceso($value)
    {
        if ($value > 0) {
            $this->salidas = Salida::query()
                ->where('nombre', 'like', '%' . $this->search . '%')
                ->where('proceso_id', $value)
                ->orderBy('codigo')
                ->get();
        } else {
            $this->salidas = null;
        }
    }

    public function render()
    {
        $this->updatedProceso($this->proceso);

        return view('livewire.admin.lista-salidas');
    }

    /* Funciones */

    public function eliminar($id)
    {
        Salida::find($id)->delete();
    }
}
