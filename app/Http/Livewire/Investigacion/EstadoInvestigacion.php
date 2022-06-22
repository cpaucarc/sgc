<?php

namespace App\Http\Livewire\Investigacion;

use App\Models\Investigacion;
use Livewire\Component;

class EstadoInvestigacion extends Component
{
    public $investigacion_id;

    public function mount($investigacion_id)
    {
        $this->investigacion_id = $investigacion_id;
    }

    public function render()
    {
        $investigacion = Investigacion::query()
            ->select('id', 'estado_id', 'fecha_publicacion')
            ->with('estado')
            ->where('id', $this->investigacion_id)
            ->first();

        return view('livewire.investigacion.estado-investigacion', compact('investigacion'));
    }

    public function cambiarEstado($estado_id)
    {
        Investigacion::where('id', $this->investigacion_id)
            ->update(['estado_id' => $estado_id, 'fecha_publicacion' => now()->format('Y-m-d')]);
    }
}
