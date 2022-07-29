<?php

namespace App\Http\Livewire\Tpu;

use App\Lib\UsuarioHelper;
use App\Models\Solicitud;
use Livewire\Component;

class ContadorIncompleto extends Component
{
    public $escuelas_id = null;

    public function mount()
    {
        $this->escuelas_id = UsuarioHelper::escuelasDelUsuario()->pluck('id');
    }

    public function render()
    {
        $solicitudes = Solicitud::query()
            ->where('tipo_solicitud_id', 3)// 3 : Título
            ->withCount('documentos')
            ->having('documentos_count', '>', 0)
            ->whereIn('escuela_id', $this->escuelas_id)->get();

        $cantidad = $solicitudes->filter(function ($item) {
            return $item->documentos_count < 14; // 14 : Requisitos de titulo profesional
        })->count();

        return view('livewire.tpu.contador-incompleto', compact('cantidad'));
    }
}
