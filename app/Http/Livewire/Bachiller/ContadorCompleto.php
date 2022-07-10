<?php

namespace App\Http\Livewire\Bachiller;

use App\Lib\UsuarioHelper;
use App\Models\Solicitud;
use Livewire\Component;

class ContadorCompleto extends Component
{
    public $escuelas_id = null;

    protected $listeners = ['render'];

    public function mount()
    {
        $this->escuelas_id = UsuarioHelper::escuelasDelUsuario()->pluck('id');
    }

    public function render()
    {
        $solicitudes = Solicitud::query()
            ->where('tipo_solicitud_id', 1)// 1 : Bachiller
            ->withCount('documentos')
            ->having('documentos_count', '>', 0)
            ->whereIn('escuela_id', $this->escuelas_id)->get();

        $cantidad = $solicitudes->filter(function ($item) {
            return $item->documentos_count == 15; // 15 : Requisitos para bachiller
        })->count();

        return view('livewire.bachiller.contador-completo', compact('cantidad'));
    }
}
