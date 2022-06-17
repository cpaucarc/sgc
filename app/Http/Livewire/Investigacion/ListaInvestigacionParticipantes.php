<?php

namespace App\Http\Livewire\Investigacion;

use App\Models\Investigacion;
use App\Models\Oge;
use Livewire\Component;

class ListaInvestigacionParticipantes extends Component
{
    public $investigacion_id;
    public $investigacion;
    public $open = false, $datos_participante = null;

    public $add = false;
    public $en_docentes = false; // Variable para saber en que API buscar, y que vista mostrar (Estudiantes, Docentes)

    protected $listeners = ["render"];

    public function mount($investigacion_id)
    {
        $this->investigacion_id = $investigacion_id;
    }

    public function render()
    {
        $this->investigacion = Investigacion::query()
            ->select('id')
            ->with('investigadores')
            ->where('id', $this->investigacion_id)
            ->first();

        return view('livewire.investigacion.lista-investigacion-participantes');
    }

    public function mostrarDatos($dni)
    {
        $this->datos_participante = Oge::datos($dni);
        $this->open = true;
    }

    public function abrirModal()
    {
        $this->add = true;
    }

    public function buscarEnDocentes($es_docente)
    {
        $this->en_docentes = $es_docente; // Para cambiar de pestaña entre 'Añadir estudiantes' y 'Añadir docentes'
        if ($es_docente)
            $this->emitTo("investigacion.agregar-investigador-docente", "cargarDocentes");
    }
}
