<?php

namespace App\Http\Livewire\Tpu\Solicitud;

use App\Models\Solicitud;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RequisitosEnviados extends Component
{
    public $solicitud = null;

    protected $listeners = [
        'requisitoGuardado' => 'render'
    ];

    public function render()
    {
        $this->solicitud = Solicitud::query()
            ->with('documentos')
            ->where('tipo_solicitud_id', 3)
            ->where('codigo_estudiante', Auth::user()->codigo)
            ->first();
        return view('livewire.tpu.solicitud.requisitos-enviados');
    }
}
