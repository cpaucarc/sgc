<?php

namespace App\Http\Livewire\Admin;

use App\Models\Actividad;
use App\Models\Proceso;
use Livewire\Component;

class ListaActividades extends Component
{
    public $search = "";
    public $proceso, $procesos = 0;
    public $actividades = null;

    public $listeners = ['render', 'eliminar'];

    public function mount()
    {
        $this->procesos = Proceso::query()->orderBy('nombre')->get();
    }

    public function updatedProceso($value)
    {
        if ($value > 0) {
            $this->actividades = Actividad::query()
                ->where('nombre', 'like', '%' . $this->search . '%')
                ->where('proceso_id', $value)
                ->with('tipo', 'proceso')
                ->orderBy('nombre')
                ->get();
        } else {
            $this->actividades = null;
        }
    }

    public function render()
    {
        $this->updatedProceso($this->proceso);

        return view('livewire.admin.lista-actividades');
    }

    /* Funciones */

    public function eliminar($id)
    {
        Actividad::find($id)->delete();
    }
}
