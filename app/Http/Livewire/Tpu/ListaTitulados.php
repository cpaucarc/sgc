<?php

namespace App\Http\Livewire\Tpu;

use App\Models\GradoEstudiante;
use App\Models\Oge;
use Livewire\Component;
use Livewire\WithPagination;

class ListaTitulados extends Component
{
    use WithPagination;

    public $escuela;
    public $open = false, $datos_estudiante = null;

    public function mount($escuela)
    {
        $this->escuela = $escuela;
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

    public function mostrarDatos($dni)
    {
        $this->datos_estudiante = Oge::datos($dni);
        $this->open = true;
    }
}
