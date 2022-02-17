<?php

namespace App\Http\Livewire\Actividad;

use App\Models\Actividad;
use App\Models\ActividadCompletado;
use App\Models\Responsable;
use App\Models\Semestre;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InfoActividad extends Component
{
    public $resp;
    public $semestre_id;

    public function mount($responsable_id, $semestre_id)
    {
        $this->resp = Responsable::find($responsable_id);
        $this->semestre_id = $semestre_id;
    }

    public function render()
    {
        $responsable = Responsable::query()
            ->addSelect(['estado' => ActividadCompletado::select('created_at')
                ->where('responsable_id', $this->resp->id)
                ->where('semestre_id', $this->semestre_id)
                ->where('user_id', Auth::user()->id)
                ->take(1)
            ])
            ->with('actividad', 'entidad')
            ->where('actividad_id', $this->resp->actividad_id)
            ->first();

        $semestre = Semestre::find($this->semestre_id);

        return view('livewire.actividad.info-actividad', compact('responsable', 'semestre'));
    }

    public function completarActividad()
    {
        ActividadCompletado::create([
            'responsable_id' => $this->resp->id,
            'semestre_id' => $this->semestre_id,
            'user_id' => Auth::user()->id
        ]);
    }

}
