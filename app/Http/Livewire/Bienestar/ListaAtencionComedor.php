<?php

namespace App\Http\Livewire\Bienestar;

use App\Models\Comedor;
use Livewire\Component;

class ListaAtencionComedor extends Component
{
    protected $listeners = ["cargarDatos" => "render"];

    public function render()
    {
        $comedor = Comedor::query()
            ->with('escuela')
            ->orderBy('anio', 'desc')
            ->orderBy('mes', 'desc')
            ->get();
        return view('livewire.bienestar.lista-atencion-comedor', compact('comedor'));
    }
}
