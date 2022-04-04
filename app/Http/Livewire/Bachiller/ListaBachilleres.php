<?php

namespace App\Http\Livewire\Bachiller;

use App\Models\GradoAcademico;
use App\Models\GradoEstudiante;
use Livewire\Component;
use Livewire\WithPagination;

class ListaBachilleres extends Component
{
    use WithPagination;

    public $escuela;
    public $alumno_seleccionado = null, $open = false;

    public function mount($escuela)
    {
        $this->escuela = $escuela;
    }

    public function render()
    {
        $bachilleres = GradoEstudiante::query()
            ->with('escuela')
            ->where('grado_academico_id', 3) //3:Bachiller
            ->whereIn('escuela_id', $this->escuela)
            ->paginate(20);

        return view('livewire.bachiller.lista-bachilleres', compact('bachilleres'));
    }

    public function seleccionar($codigo)
    {
        $this->alumno_seleccionado = $codigo;
        $this->open = true;
    }
}
