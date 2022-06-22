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
            ->select('id', 'uuid', 'titulo', 'fecha_publicacion', 'escuela_id', 'estado_id', 'semestre_id', 'created_at')
            ->with('escuela:id,nombre', 'estado:id,nombre,color', 'semestre:id,nombre')
            ->where('titulo', 'like', '%' . $this->search . '%')
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
