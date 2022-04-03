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
    public $indicadores = null;
    public $facultades_id = null;
    public $escuelas_id = null;

    public function mount()
    {
        $this->resetear();
        $this->facultades_id = User::facultades_id(Auth::user()->id);
        $this->escuelas_id = User::escuelas_id(Auth::user()->id);
    }

    public function resetear()
    {
        $this->search = '';
        $this->indicadores = null;
    }

    public function updatedSearch()
    {
        $this->indicadores = Indicador::query()
            ->where('objetivo', 'like', '%' . str_replace(" ", "%", $this->search) . '%')
            ->orWhere('cod_ind_inicial', 'like', '%' . str_replace(" ", "%", $this->search) . '%')
            ->orderBy('cod_ind_inicial')
            ->limit(5)
            ->get();
    }

    public function render()
    {
        $escuelas = Escuela::query()
            ->with(['indicadores' => function ($query) {
                return $query->select('indicadores.id', 'objetivo', 'cod_ind_inicial')
                    ->where('objetivo', 'like', '%' . $this->search . '%')
                    ->take(5);
            }])
            ->find($this->escuelas_id);

        $facultades = Facultad::query()
            ->with(['indicadores' => function ($query) {
                return $query->select('objetivo')
                    ->where('objetivo', 'like', '%' . $this->search . '%')
                    ->take(5);
            }])
            ->find($this->facultades_id);

        return view('livewire.indicador.buscador-indicadores', compact('escuelas', 'facultades'));
    }
}
