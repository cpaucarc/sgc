<?php

namespace App\Http\Livewire\Investigacion;

use App\Models\InvestigacionInvestigador;
use Livewire\Component;

class CargoParticipante extends Component
{
    public $investigacion_id;
    public $investigador_id;

    public $cargo_participante;

    protected $listeners = ["render", "cambiarCargo"];

    public function mount($investigacion_id, $investigador_id)
    {
        $this->investigacion_id = $investigacion_id;
        $this->investigador_id = $investigador_id;
        $this->cargo_participante = InvestigacionInvestigador::query()
            ->where('investigacion_id', $this->investigacion_id)
            ->where('investigador_id', $this->investigador_id)
            ->first()->es_responsable;
    }

    public function render()
    {
        $participante = InvestigacionInvestigador::query()
            ->where('investigacion_id', $this->investigacion_id)
            ->where('investigador_id', $this->investigador_id)
            ->first();
        return view('livewire.investigacion.cargo-participante', compact('participante'));
    }

    public function cambiarCargo($id)
    {
        InvestigacionInvestigador::where('id', $id)
            ->update(['es_responsable' => $this->cargo_participante]);
    }
}
