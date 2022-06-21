<?php

namespace App\Http\Livewire\Rsu;

use App\Models\RsuParticipante;
use Livewire\Component;

class CargoParticipante extends Component
{
    public $participante;

    public $cargo_participante;

    protected $listeners = ["render", "cambiarCargo"];

    public function mount(RsuParticipante $participante)
    {
        $this->participante = $participante;

        $this->cargo_participante = $this->participante->es_responsable;
    }

    public function render()
    {
        return view('livewire.rsu.cargo-participante');
    }

    public function cambiarCargo()
    {
        $this->participante->update([
            'es_responsable' => $this->cargo_participante
        ]);
    }

    /* public function updatedcargo_participante($estado)
     {
         $part = RsuParticipante::find($this->participante->id);
         $part->update([
             'es_responsable' => $estado
         ]);
     }*/
}
