<?php

namespace App\Http\Livewire\Investigacion;

use App\Models\Investigacion;
use App\Models\InvestigacionInvestigador;
use App\Models\Oge;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaInvestigacionParticipantes extends Component
{
    public $investigacion_id;
    public $es_responsable;
    public $investigacion;
    public $open = false, $datos_participante = null;

    public $add = false;
    public $en_docentes = false; // Variable para saber en que API buscar, y que vista mostrar (Estudiantes, Docentes)
    public $depto_id, $semestre;

    protected $listeners = ["render","cerrarModal"];

    public function mount($investigacion_id, $es_responsable, $depto_id, $semestre)
    {
        $this->investigacion_id = $investigacion_id;
        $this->es_responsable = $es_responsable;
        $this->depto_id = $depto_id;
        $this->semestre = $semestre;
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

    public function cerrarModal()
    {
        $this->add = false;
    }

    public function buscarEnDocentes($es_docente)
    {
        $this->en_docentes = $es_docente; // Para cambiar de pestaña entre 'Añadir estudiantes' y 'Añadir docentes'
        if ($es_docente)
            $this->emitTo("investigacion.agregar-investigador-docente", "cargarDocentes");
    }
}
