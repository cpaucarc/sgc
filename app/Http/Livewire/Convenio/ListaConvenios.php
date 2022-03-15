<?php

namespace App\Http\Livewire\Convenio;

use App\Models\Convenio;
use Livewire\Component;

class ListaConvenios extends Component
{
    public $convenios = null;

    protected $listeners = [
        'convenioCreado' => 'render',
    ];

    public function obtenerConvenio()
    {
        $this->convenios = Convenio::query()
            ->with('semestre')
            ->get();
    }

    public function eliminarConvenio($id)
    {
        $convenio = Convenio::where('id', $id);
        $convenio->delete();
    }

    public function render()
    {
        $this->obtenerConvenio();
        return view('livewire.convenio.lista-convenios');
    }
}
