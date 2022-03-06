<?php

namespace App\Http\Livewire\Convalidacion;

use App\Models\Convalidacion;
use App\Models\Semestre;
use Livewire\Component;

class ListaConvalidacion extends Component
{
    public $semestres = null;
    public $semestreSeleccionado;
    public $convalidaciones;

    protected $listeners = [
        'convalidacionCreado' => 'render',
    ];

    public function mount()
    {
        $this->semestres = Semestre::orderBy('nombre', 'desc')->get();
        $this->semestreSeleccionado = $this->semestres->first()->id;
    }

    public function obtenerConvalidaciones()
    {
        $this->convalidaciones = Convalidacion::query()
            ->with('escuela')
            ->where('semestre_id', $this->semestreSeleccionado)
            ->get();
    }

    public function eliminarConvalidacion($id)
    {
        $convalidacion = Convalidacion::where('id', $id);
        $convalidacion->delete();
    }

    public function render()
    {
        $this->obtenerConvalidaciones();
        return view('livewire.convalidacion.lista-convalidacion');
    }
}
