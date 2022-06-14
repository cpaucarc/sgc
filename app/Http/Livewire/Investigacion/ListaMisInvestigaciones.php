<?php

namespace App\Http\Livewire\Investigacion;

use App\Models\Investigacion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaMisInvestigaciones extends Component
{
    public $investigaciones = null;
    public $investigador_dni = null;

    public function mount()
    {
        $this->investigador_dni = Auth::user()->dni;
    }

    public function render()
    {
        $this->investigaciones = Investigacion::query()
            ->select('id', 'uuid', 'titulo', 'fecha_publicacion', 'escuela_id', 'estado_id', 'created_at')
            ->with('escuela:id,nombre', 'estado:id,nombre,color')
            ->withCount('investigadores')
            ->withSum('financiaciones as presupuesto_sum', 'investigacion_financiacion.presupuesto')
            ->whereHas('investigadores', function ($query) {
                $query->where("dni_investigador", $this->investigador_dni);
            })
            ->get();

        return view('livewire.investigacion.lista-mis-investigaciones');
    }
}
