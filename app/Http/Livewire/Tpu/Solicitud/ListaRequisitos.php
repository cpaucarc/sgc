<?php

namespace App\Http\Livewire\Tpu\Solicitud;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListaRequisitos extends Component
{
    public $crypto_modal = false;

    protected $listeners = [
        'requisitoGuardado' => 'render',
    ];

    public function render()
    {
        $requisitos = DB::table('requisitos')
            ->select('id', 'nombre')
            ->where('proceso_id', 5)
            ->whereNotIn('id', function ($query) {
                $query->select('requisito_id')
                    ->from('documento_solicitud')
                    ->whereIn('solicitud_id', function ($query2) {
                        $query2->select('id')
                            ->from('solicitudes')
                            ->where('dni_estudiante', Auth::user()->dni)
                            ->where('tipo_solicitud_id', 3); // 1: Título
                    });
            })
            ->get();

        return view('livewire.tpu.solicitud.lista-requisitos')
            ->with(compact('requisitos'));
    }
}
