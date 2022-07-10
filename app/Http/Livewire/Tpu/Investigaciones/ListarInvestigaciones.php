<?php

namespace App\Http\Livewire\Tpu\Investigaciones;

use App\Models\Escuela;
use App\Models\Tesis;
use Livewire\Component;

class ListarInvestigaciones extends Component
{
    public $facultad = null, $escuela = null, $search;
    //Siver para hacer filtros.
    public $escuelas = null, $escuela_seleccionado = 0;

    /* Metodo:
     * Recibe parametros facultad y escuela
     * Si el usuario es de tipo facultad, el parametro facultad recibe dato y la escuela es nulo.
     * Si el usuario es de tipo escuela, el parametro facultad recibe dato y la escuela tambien recibe dato.
     */
    public function mount($facultad, $escuela)
    {
        $this->facultad = $facultad;
        $this->escuela = $escuela;

        //Si la escuela es vacía, el usuario es de tipo facultad.
        if (!$this->escuela) {
            $this->escuelas = Escuela::query()->where('facultad_id', $this->facultad->id)->get();
        }
    }


    public function render()
    {
        $callback = Tesis::query()
            ->where(function ($query) {
                $query->where('numero_registro', 'like', '%' . $this->search . '%')
                    ->orWhere('titulo', 'like', '%' . $this->search . '%')
                    ->orWhere('anio', 'like', '%' . $this->search . '%');
            })
            ->orderBy('anio', 'desc')
            ->orderBy('numero_registro', 'desc');

        //Si la escuela seleccionada es mayor que cero.
        if ($this->escuela_seleccionado > 0) {
            $callback = $callback->where('escuela_id', $this->escuela_seleccionado);
        }

        //Si el usuario es de escuela filtra por escuela
        if ($this->escuela) {
            $investigaciones = $callback->where('escuela_id', $this->escuela->id)->paginate(10);
        } else {
            $investigaciones = $callback->paginate(10);
        }

        return view('livewire.tpu.investigaciones.listar-investigaciones', compact('investigaciones'));
    }
}
