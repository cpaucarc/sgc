<?php

namespace App\Http\Livewire\Bachiller\Solicitudes;

use App\Models\DocumentoSolicitud;
use App\Models\Oge;
use App\Models\Solicitud;
use Livewire\Component;

class Incompletas extends Component
{
    public $solicitudesIncompletas;
    public $solicitudSeleccionado = null, $openModelRequisitos = false;
    public $datos_estudiante = null, $openModalEstudiante = false;

    protected $listeners = [
        'documentoAprobado' => 'render',
        'documentoDenegado' => 'render',
    ];

    public function mount($solicitudesIncompletas)
    {
        $this->solicitudesIncompletas = $solicitudesIncompletas;
    }

    public function modalRequisitos($id)
    {
        $this->solicitudSeleccionado = Solicitud::query()
            ->with('documentos')
            ->where('tipo_solicitud_id', 1) // 1 : Bachiller
            ->where('id', $id)
            ->first();

        $this->datos_estudiante = Oge::datos($this->solicitudSeleccionado->dni_estudiante);

        $this->openModelRequisitos = true;
    }

    public function mostrarDatos($dni)
    {
        $this->datos_estudiante = Oge::datos($dni);
        $this->openModalEstudiante = true;
    }

    public function aprobarDocumentoRequisito($documentoSolicitudId)
    {
        //Cambiar estado a aprobado
        $documentoSolicitud = DocumentoSolicitud::query()
            ->where('id', $documentoSolicitudId)
            ->first();
        $documentoSolicitud->estado_id = 6;// 6: Estado documento Aprobado
        $documentoSolicitud->save();

        $this->emit('documentoAprobado');
    }

    public function denegarDocumentoRequisito($documentoSolicitudId)
    {
        //Cambiar estado a aprobado
        $documentoSolicitud = DocumentoSolicitud::query()
            ->where('id', $documentoSolicitudId)
            ->first();
        $documentoSolicitud->estado_id = 5; // 5 : Estado documento Denegado
        $documentoSolicitud->save();

        $this->emit('documentoDenegado');
    }

    public function render()
    {
        return view('livewire.bachiller.solicitudes.incompletas');
    }
}
