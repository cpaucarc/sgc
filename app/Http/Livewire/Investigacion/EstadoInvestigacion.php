<?php

namespace App\Http\Livewire\Investigacion;

use App\Models\Investigacion;
use App\Models\InvestigacionInvestigador;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EstadoInvestigacion extends Component
{
    public $investigacion_id, $es_responsable;

    public function mount($investigacion_id)
    {
        $this->investigacion_id = $investigacion_id;
        $this->es_responsable = InvestigacionInvestigador::query()
            ->where('investigacion_id', $this->investigacion_id)
            ->where('investigador_id', function ($query){
                $query->select('id')->from('investigadores')->where('dni_investigador', Auth::user()->persona->dni);
            })->exists();
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
