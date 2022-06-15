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
        $dependientes = Actividad::query()
            ->whereIn('id', function ($query) use ($id) {
                $query->select('actividad_id')->from('responsables')
                    ->where('actividad_id', $id);
            })
            ->count();

        if ($dependientes > 0) {
            $this->emit('error', 'No es posible eliminar esta actividad porque tiene tablas  dependientes.');
        } else {
            Actividad::find($id)->delete();
        }
    }
}
