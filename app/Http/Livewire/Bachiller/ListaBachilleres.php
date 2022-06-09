<?php

namespace App\Http\Livewire\Bachiller;

use App\Models\GradoEstudiante;
use App\Models\Oge;
use Livewire\Component;
use Livewire\WithPagination;

class ListaBachilleres extends Component
{
    use WithPagination;

    public $facultad = null, $escuela = null;

    public $open = false, $datos_estudiante = null;

    public function mount($facultad, $escuela)
    {
        $this->facultad = $facultad;
        $this->escuela = $escuela;
    }

    public function render()
    {
        $callback = GradoEstudiante::query()
            ->with('escuela')
            ->where('grado_academico_id', 3);//3:Bachiller

        if ($this->escuela) {
            $bachilleres = $callback->whereIn('escuela_id', $this->escuela)
                ->paginate(10);
        } else {
            $bachilleres = $callback->paginate(10);
        }

        return view('livewire.bachiller.lista-bachilleres', compact('bachilleres'));
    }

    public function mostrarDatos($dni)
    {
        $this->datos_estudiante = Oge::datos($dni);
        $this->open = true;
    }
}
