<?php

namespace App\Http\Livewire\Indicador;

use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Indicador;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BuscadorIndicadores extends Component
{
    public $search = '';
    public $facultades_id = null, $facultades = [];
    public $escuelas_id = null, $escuelas = [];

    public function mount()
    {
        $this->resetear();
        $this->facultades_id = User::facultades_id(Auth::user()->id);
        $this->escuelas_id = User::escuelas_id(Auth::user()->id);
    }

    public function resetear()
    {
        $this->search = '';
        $this->facultades = [];
        $this->escuelas = [];
    }

    public function updatedSearch()
    {
        if (count($this->escuelas_id)) {
            $this->escuelas = Escuela::query()
                ->with(['indicadores' => function ($query) {
                    return $query->select('indicadores.id', 'objetivo', 'cod_ind_inicial')
                        ->where('objetivo', 'like', '%' . $this->search . '%')
                        ->orWhere('cod_ind_inicial', 'like', '%' . $this->search . '%')
                        ->take(5);
                }])
                ->find($this->escuelas_id);
        }

        if (count($this->facultades_id)) {
            $this->facultades = Facultad::query()
                ->with(['indicadores' => function ($query) {
                    return $query->select('indicadores.id', 'objetivo', 'cod_ind_inicial')
                        ->where('objetivo', 'like', '%' . $this->search . '%')
                        ->orWhere('cod_ind_inicial', 'like', '%' . $this->search . '%')
                        ->take(5);
                }])
                ->find($this->facultades_id);
        }
    }

    public function render()
    {
        return view('livewire.indicador.buscador-indicadores');
    }
}
