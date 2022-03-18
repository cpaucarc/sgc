<?php

namespace App\Http\Livewire\Bienestar;

use App\Models\Comedor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaAtencionComedor extends Component
{
    public $mes, $anio, $escuelas;
    protected $listeners = ["cargarDatos" => "render"];

    public function mount()
    {
        $this->mes = 0;
        $this->anio = now()->year;
        $this->escuelas = User::escuelas_id(Auth::user()->id);
    }

    public function render()
    {
        $comedor = Comedor::query()
            ->with('escuela')
            ->whereIn('escuela_id', $this->escuelas)
            ->where('anio', 'like', '%' . $this->anio . '%');

        if ($this->mes > 0) {
            $comedor = $comedor->where('mes', 'like', '%' . $this->mes . '%');
        }

        $comedor = $comedor->orderBy('anio', 'desc')
            ->orderBy('mes', 'desc')
            ->get();

        return view('livewire.bienestar.lista-atencion-comedor', compact('comedor'));
    }
}
