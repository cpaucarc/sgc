<?php

namespace App\Http\Livewire\Rsu;

use App\Models\Oge;
use App\Models\ResponsabilidadSocial;
use App\Models\RsuParticipante;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Participantes extends Component
{
    public $rsu_id;
    public $es_responsable;
    public $en_docentes = false; // Variable para saber en que API buscar, y que vista mostrar (Estudiantes, Docentes)
    public $open = false; // Abrir modal de datos del participante
    public $datos_participante = null;
    public $add = false; // Abrir modal para agregar participantes

    protected $listeners = ["render", "quitarParticipante"];

    public function mount($rsu_id, $es_responsable)
    {
        $this->rsu_id = $rsu_id;
        $this->es_responsable = $es_responsable;
        $this->emitTo("rsu.agregar-participante-docente", "cargarDocentes");
        Log::info('montando datos', [$rsu_id]);
    }

    public function render()
    {
        $rsu = ResponsabilidadSocial::query()
            ->select('id')
            ->withCount('participantes')
            ->with('participantes')
            ->where('id', $this->rsu_id)
            ->first();

        return view('livewire.rsu.participantes', compact('rsu'));
    }

    public function abrirModal()
    {
        $this->add = true;
    }

    public function mostrarDatos($dni)
    {
        $this->datos_participante = Oge::datos($dni);
        $this->open = true;
    }

    public function buscarEnDocentes($es_docente)
    {
        $this->en_docentes = $es_docente; // Para cambiar de pestaña entre 'Añadir estudiantes' y 'Añadir docentes'
        if ($es_docente)
            $this->emitTo("rsu.agregar-participante-docente", "cargarDocentes");
    }

    public function quitarParticipante($participante_id)
    {
        RsuParticipante::find($participante_id)->delete();
    }

}
