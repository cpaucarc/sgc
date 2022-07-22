<?php

namespace App\Http\Livewire\Rsu;

use App\Models\ResponsabilidadSocial;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaMisRsu extends Component
{
    public $search = "", $estado = 0;

    public function render()
    {
        $rsu = ResponsabilidadSocial::query()
            ->select('id', 'uuid', 'titulo', 'lugar', 'fecha_inicio', 'fecha_fin', 'escuela_id', 'empresa_id')
            ->with('escuela:id,nombre', 'empresa:id,nombre,ruc')
            ->where(function ($query) {
                $query->where('titulo', 'like', '%' . $this->search . '%')
                    ->orWhere('lugar', 'like', '%' . $this->search . '%');
            })
            ->whereIn('id', function ($query) {
                $query->select('responsabilidad_social_id')->from('rsu_participantes')
                    ->where('dni_participante', Auth::user()->persona->dni);
            });

        if (intval($this->estado) === 1) // Sin iniciar
            $rsu = $rsu->where('fecha_inicio', '>', now());

        if (intval($this->estado) === 2) // En progreso
            $rsu = $rsu->where('fecha_inicio', '<=', now())->where('fecha_fin', '>=', now());

        if (intval($this->estado) === 3) // En progreso
            $rsu = $rsu->where('fecha_fin', '<', now());


        $rsu = $rsu->orderBy('created_at', 'desc')->get();

        return view('livewire.rsu.lista-mis-rsu', compact('rsu'));
    }
}
