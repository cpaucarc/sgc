<?php

namespace App\Http\Livewire\Bachiller\Solicitud;

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
            ->where('tipo_solicitud_id', 1) // 1: Bachiller
            ->distinct('id')
            ->count();
        $this->semestreActual = Semestre::query()
            ->where('fecha_fin', '>=', Carbon::now())
            ->where('fecha_inicio', '<=', Carbon::now())
            ->first();
        $this->entidad = Auth::user()->entidades()->first();
    }

    public function obtenerEstado()
    {
        $this->solicitud = Solicitud::query()
            ->with('estado')
            ->where('codigo_estudiante', Auth::user()->codigo)
            ->where('tipo_solicitud_id', 1) // 1: Bachiller
            ->first();
    }

    public function render()
    {
        $this->obtenerEstado();
        return view('livewire.bachiller.solicitud.estado-solicitud');
    }
}