<?php

namespace App\Http\Livewire\Tpu\Solicitudes;

use App\Models\DocumentoSolicitud;
use App\Models\Oge;
use App\Models\Solicitud;
use Livewire\Component;

class Incompletas extends Component
{
    public $solicitudSeleccionado = null, $openModelRequisitos = false;
    public $datos_estudiante = null, $openModalEstudiante = false;
    public $escuelas_id = [];

    protected $listeners = [
        'documentoAprobado' => 'render',
        'documentoDenegado' => 'render',
    ];

    public function mount($escuelas_id)
    {
        $this->escuelas_id = $escuelas_id;
    }

    public function modalRequisitos($id)
    {
        $this->solicitudSeleccionado = Solicitud::query()
            ->with('documentos')
            ->where('tipo_solicitud_id', 3) // 3: Título
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
        // ya no es necesario verificar su rol, ya se hizo en el controller
        // se supone que si puede ver el componente, es director o decano

        $solicitudesIncompletas = Solicitud::query()
            ->with('escuela:id,nombre')
            ->withCount('documentos')
            ->where('tipo_solicitud_id', 3)// 3 : Título
            ->whereIn('escuela_id', $this->escuelas_id)
            ->having('documentos_count', '>', 0)
            ->having('documentos_count', '<', 8) // 8 : Requisitos de titulo profesional
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('livewire.tpu.solicitudes.incompletas', compact('solicitudesIncompletas'));
    }
}
