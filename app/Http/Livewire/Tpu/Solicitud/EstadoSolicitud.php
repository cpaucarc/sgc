<?php

namespace App\Http\Livewire\Tpu\Solicitud;

use App\Models\Semestre;
use App\Models\Solicitud;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EstadoSolicitud extends Component
{
    protected $listeners = [
        'solicitudCreado' => 'render',
    ];

    public $semestreActual = null;
    public $entidad = null;
    public $solicitud = null;
    public $numSolicitud = 0;

    public function mount()
    {
        $this->numSolicitud = Solicitud::query()
            ->where('tipo_solicitud_id', 3) // 3: Titulo profesional
            ->count();
        $this->semestreActual = Semestre::where('activo', 1)->first();
        $this->entidad = Auth::user()->entidades()->first();
    }

    public function obtenerEstado()
    {
        $this->solicitud = Solicitud::query()
            ->with('estado')
            ->where('dni_estudiante', Auth::user()->persona->dni)
            ->where('tipo_solicitud_id', 3) // 3: Bachiller
            ->first();
    }

    public function render()
    {
        $this->obtenerEstado();
        return view('livewire.tpu.solicitud.estado-solicitud');
    }
}
