<?php

namespace App\Http\Livewire\Admin;

use App\Models\Indicador;
use Livewire\Component;

class InfoIndicador extends Component
{
    public $indicador_id;

    public $listeners = ['cambiarEstado', 'render'];

    public function mount($indicador_id)
    {
        $this->indicador_id = $indicador_id;
    }

    public function render()
    {
        $indicador = Indicador::where('id', $this->indicador_id)->first();
        return view('livewire.admin.info-indicador', compact('indicador'));
    }

    public function cambiarEstado($id, $status)
    {
        Indicador::where('id', $id)->update(['esta_implementado' => $status]);
    }
}
