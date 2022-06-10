<?php

namespace App\Http\Livewire\Tpu;

use App\Models\Escuela;
use App\Models\GradoEstudiante;
use App\Models\Oge;
use Livewire\Component;
use Livewire\WithPagination;

class ListaTitulados extends Component
{
    use WithPagination;

    public $facultad = null, $escuela = null, $search;
    public $open = false, $datos_estudiante = null;
    //Siver para hacer filtros.
    public $escuelas = null, $escuela_seleccionado = 0;

    /* Metodo:
     * Recibe parametros facultad y escuela
     * Si el usuario es de tipo facultad, el parametro facultad recibe dato y la escuela es nulo.
     * Si el usuario es de tipo escuela, el parametro facultad recibe dato y la escuela tambien recibe dato.
     */
    public function mount($escuela, $facultad)
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
        $callback = GradoEstudiante::query()
            ->with('escuela')
            ->where('grado_academico_id', 4)//4: Titulado
            ->where('dni_estudiante', 'like', '%' . $this->search . '%');

        //Si la escuela seleccionada es mayor que cero.
        if ($this->escuela_seleccionado > 0) {
            $callback = $callback->where('escuela_id', $this->escuela_seleccionado);
        }

        //Si el usuario es de escuela filtra por escuela
        if ($this->escuela) {
            $titulados = $callback->where('escuela_id', $this->escuela->id)
                ->paginate(10);
        } else {
            $titulados = $callback->paginate(10);
        }

        return view('livewire.tpu.lista-titulados', compact('titulados'));
    }

    public function mostrarDatos($dni)
    {
        $this->datos_estudiante = Oge::datos($dni);
        $this->open = true;
    }
}
