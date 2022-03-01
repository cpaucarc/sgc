<?php

namespace App\Http\Livewire\Investigacion;

use App\Models\Investigacion;
use Livewire\Component;

class ListaInvestigacionParticipantes extends Component
{
    public $investigacion_id;
    public $investigacion;

    public function mount($investigacion_id)
    {
        $this->investigacion_id = $investigacion_id;
    }

    public function render()
    {
        $this->investigacion = Investigacion::query()
            ->select('id')
            ->with('investigadores')
            ->where('id', $this->investigacion_id)
            ->first();

        return view('livewire.investigacion.lista-investigacion-participantes');
    }
}
