<?php

namespace App\Http\Livewire\Tpu\Tesis;

use App\Models\Jurado;
use App\Models\JuradoSustentacion;
use App\Models\Sustentacion;
use Livewire\Component;

class VerTesis extends Component
{
    public $solicitud = null;
    public $tesis = null;
    public $sustentacion = null;
    public $jurados = null;
    public $asesor = null;
    public $juradoAsesor = null;

    public function mount()
    {
        $this->sustentacion = Sustentacion::query()
            ->where('tesis_id', $this->tesis->id)
            ->first();
        $this->jurados = JuradoSustentacion::query()
            ->with('jurado', 'cargoJurado')
            ->where('sustentacion_id', $this->sustentacion->id)
            ->get();
        $this->juradoAsesor = Jurado::query()
            ->with('colegio')
            ->where('id', $this->tesis->asesor_id)
            ->first();
    }

    public function render()
    {
        return view('livewire.tpu.tesis.ver-tesis');
    }
}
