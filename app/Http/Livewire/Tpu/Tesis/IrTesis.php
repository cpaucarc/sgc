<?php

namespace App\Http\Livewire\Tpu\Tesis;

use App\Models\Solicitud;
use App\Models\Tesis;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class IrTesis extends Component
{
    public $tesis = null;
    public $solicitud = null;

    public function obtenerTesis()
    {
        $this->tesis = Tesis::query()
            ->where('dni_estudiante', Auth::user()->dni)->first();
        $this->solicitud = Solicitud::query()
            ->where('dni_estudiante', Auth::user()->dni)->first();
    }

    public function render()
    {
        $this->obtenerTesis();
        return view('livewire.tpu.tesis.ir-tesis');
    }
}
