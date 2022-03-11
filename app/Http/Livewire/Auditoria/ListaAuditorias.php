<?php

namespace App\Http\Livewire\Auditoria;

use App\Models\Auditoria;
use App\Models\Entidadable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaAuditorias extends Component
{
    public function render()
    {
        $facultad_id = Entidadable::query()
            ->where('entidadable_type', 'App\\Models\\Facultad')
            ->whereIn('entidad_id', function ($query) {
                $query->select('id')->from('entidades')->whereIn('id', function ($query2) {
                    $query2->select('entidad_id')->from('entidad_user')->where('user_id', Auth::user()->id);
                });
            })->get()->pluck('entidadable_id');

        $auditorias = Auditoria::query()
            ->withCount('documentos')
            ->whereIn('facultad_id', $facultad_id)
            ->with('facultad:id,nombre')
            ->get();

        return view('livewire.auditoria.lista-auditorias', compact('auditorias'));
    }
}
