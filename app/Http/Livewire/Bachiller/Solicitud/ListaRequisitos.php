<?php

namespace App\Http\Livewire\Bachiller\Solicitud;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListaRequisitos extends Component
{

    protected $listeners = [
        'requisitoGuardado' => 'render',
    ];

    public function render()
    {
        $requisitos = DB::table('requisitos')
            ->select('id', 'nombre')
            ->where('proceso_id', 12) // 12: Grado Bachiller
            ->whereNotIn('id', function ($query) {
                $query->select('requisito_id')
                    ->from('documento_solicitud')
                    ->whereIn('solicitud_id', function ($query2) {
                        $query2->select('id')
                            ->from('solicitudes')
                            ->where('codigo_estudiante', Auth::user()->codigo)
                            ->where('tipo_solicitud_id', 1); // 1: Bahicller
                    });
            })
            ->get();
        return view('livewire.bachiller.solicitud.lista-requisitos')
            ->with(compact('requisitos'));
    }
}
