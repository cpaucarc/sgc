<?php

namespace App\Http\Livewire\Tpu;

use App\Models\GradoEstudiante;
use Livewire\Component;
use Livewire\WithPagination;

class ListaTitulados extends Component
{
    use WithPagination;

    public $escuela;
    public $alumno_seleccionado = null, $open = false;

    public function mount($escuela)
    {
        $this->escuela = $escuela;
    }

    public function seleccionar($codigo)
    {
        $this->alumno_seleccionado = $codigo;
        $this->open = true;
    }

    public function render()
    {
        $titulados = GradoEstudiante::query()
            ->with('escuela')
            ->where('grado_academico_id', 4) //4: Titulado
            ->whereIn('escuela_id', $this->escuela)
            ->paginate(20);

        return view('livewire.tpu.lista-titulados', compact('titulados'));
    }
}
