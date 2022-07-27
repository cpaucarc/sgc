<?php

namespace App\Http\Livewire\Rsu;

use App\Models\RsuParticipante;
use Livewire\Component;

class CargoParticipante extends Component
{
    public $participante_id;

    public $cargo_participante;

    protected $listeners = ["render", "cambiarCargo"];

    public function mount($participante_id)
    {
        $this->participante_id = $participante_id;
        $this->cargo_participante = RsuParticipante::query()->where('id', $this->participante_id)->first()->es_responsable;
    }

    public function render()
    {
        $participante = RsuParticipante::query()->where('id', $this->participante_id)->first();
        return view('livewire.rsu.cargo-participante', compact('participante'));
    }

    public function cambiarCargo()
    {
        RsuParticipante::where('id', $this->participante_id)
            ->update(['es_responsable' => $this->cargo_participante]);
    }

    /* public function updatedcargo_participante($estado)
     {
         $part = RsuParticipante::find($this->participante->id);
         $part->update([
             'es_responsable' => $estado
         ]);
     }*/
}
