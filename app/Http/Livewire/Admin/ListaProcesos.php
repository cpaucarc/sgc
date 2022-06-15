<?php

namespace App\Http\Livewire\Admin;

use App\Models\Actividad;
use App\Models\Proceso;
use Livewire\Component;

class ListaProcesos extends Component
{
    public $search = "";

    public $listeners = ['render', 'eliminar'];

    public function render()
    {
        $procesos = Proceso::query()
            ->where('nombre', 'like', '%' . $this->search . '%')
            ->withCount('actividades')
            ->orderBy('nombre')
            ->get();
        return view('livewire.admin.lista-procesos', compact('procesos'));
    }

    /* Funciones */

    public function eliminar($id)
    {
        $dependientes = Proceso::query()
            ->whereIn('id', function ($query) use ($id) {
                $query->select('proceso_id')->from('actividades')
                    ->where('proceso_id', $id);
            })
            ->orWhereIn('id', function ($query) use ($id) {
                $query->select('proceso_id')->from('requisitos')
                    ->where('proceso_id', $id);
            })
            ->orWhereIn('id', function ($query) use ($id) {
                $query->select('proceso_id')->from('entradas')
                    ->where('proceso_id', $id);
            })
            ->orWhereIn('id', function ($query) use ($id) {
                $query->select('proceso_id')->from('encuesta_preguntas')
                    ->where('proceso_id', $id);
            })
            ->orWhereIn('id', function ($query) use ($id) {
                $query->select('proceso_id')->from('indicadores')
                    ->where('proceso_id', $id);
            })
            ->orWhereIn('id', function ($query) use ($id) {
                $query->select('proceso_id')->from('facultad_procesos')
                    ->where('proceso_id', $id);
            })
            ->count();

        if ($dependientes > 0) {
            $this->emit('error', 'No es posible eliminar este proceso porque tiene tablas  dependientes.');
        } else {
            Proceso::find($id)->delete();
        }
    }
}
