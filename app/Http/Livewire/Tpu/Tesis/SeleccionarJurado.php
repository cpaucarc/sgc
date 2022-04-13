<?php

namespace App\Http\Livewire\Tpu\Tesis;

use App\Models\Jurado;
use Livewire\Component;

class SeleccionarJurado extends Component
{
    public $open = false;
    public $jurados = null;
    public $search = "";

    public function render()
    {
        if ($this->open) {
            $this->buscarJurados();
        }

        return view('livewire.tpu.tesis.seleccionar-jurado');
    }

    /* Funciones */

    public function buscarJurados()
    {
        $this->jurados = Jurado::query()
            ->with('colegio')
            ->where('codigo_colegiatura', 'like', '%' . $this->search . '%')
            ->orWhere('dni_docente', 'like', '%' . $this->search . '%')
            ->orderBy('id')
            ->limit(6)
            ->get();
    }

    public function openModal()
    {
        $this->buscarJurados();
        $this->open = true;
    }

    public function seleccionarJurado($jurado_id, $dni_docente)
    {
        $this->emit('enviarJurado', $jurado_id, $dni_docente);
        $this->open = false;
    }
}
