<?php

namespace App\Http\Livewire\Rsu;

use App\Models\Empresa;
use Livewire\Component;

class SeleccionarEmpresa extends Component
{
    public $open = false;
    public $empresas = null;
    public $search = "";

    public function render()
    {
        if ($this->open) {
            $this->buscarEmpresas();
        }

        return view('livewire.rsu.seleccionar-empresa');
    }

    /* Funciones */

    public function buscarEmpresas()
    {
        $this->empresas = Empresa::query()
            ->where('ruc', 'like', '%' . $this->search . '%')
            ->orWhere('nombre', 'like', '%' . $this->search . '%')
            ->orWhere('ubicacion', 'like', '%' . $this->search . '%')
            ->orderBy('nombre')
            ->limit(6)
            ->get();
    }

    public function openModal()
    {
        $this->buscarEmpresas();
        $this->open = true;
    }

    public function seleccionarEmpresa($empresa_id, $empresa_nombre)
    {
        $this->emit('enviarEmpresa', $empresa_id, $empresa_nombre);
        $this->open = false;
    }

}
