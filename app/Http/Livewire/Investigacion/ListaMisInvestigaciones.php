<?php

namespace App\Http\Livewire\Investigacion;

use App\Models\Investigacion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaMisInvestigaciones extends Component
{
    public $investigaciones = null;
    public $search = "";

    public function render()
    {
        $this->investigaciones = Investigacion::query()
            ->select('id', 'uuid', 'titulo', 'fecha_publicacion', 'escuela_id', 'estado_id', 'created_at')
            ->where('titulo', 'like', '%' . $this->search . '%')
            ->with('escuela:id,nombre', 'estado:id,nombre,color')
            ->withCount('investigadores')
            ->withSum('financiaciones as presupuesto_sum', 'investigacion_financiacion.presupuesto')
            ->whereHas('investigadores', function ($query) {
                $query->where("dni_investigador", Auth::user()->dni);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.investigacion.lista-mis-investigaciones');
    }
}
