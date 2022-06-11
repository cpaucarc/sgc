<?php

namespace App\Http\Livewire\Bachiller\Solicitudes;

use App\Models\DocumentoSolicitud;
use App\Models\GradoEstudiante;
use App\Models\Oge;
use App\Models\Solicitud;
use Livewire\Component;

class Completas extends Component
{
    public $solicitudesCompletas;
    public $solicitudSeleccionado = null, $openModelRequisitos = false;
    public $openModalEstudiante = false, $datos_estudiante = null;

    protected $listeners = [
        'documentoAprobado' => 'render',
        'documentoDenegado' => 'render',
        'estadoSolicitud' => 'render',
    ];

    public function mount($solicitudesCompletas)
    {
        $this->solicitudesCompletas = $solicitudesCompletas;
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

        $this->emit('documentoAprobado');
    }

    //Si el estudiante cumple con todos los requisitos se le asigna el grado de bachiller.
    public function estadoSolicitud($dni_estudiante)
    {
        if (!is_null($this->solicitudSeleccionado)) {
            $this->solicitudSeleccionado->estado_id = 6;// 6 : Estado Solicitud Aprobado
            $this->solicitudSeleccionado->save();

            $gradoestudiante = GradoEstudiante::query()
                ->where('dni_estudiante', $dni_estudiante)
                ->where('grado_academico_id', 3) // 3 : Bachiller
                ->where('escuela_id', $this->solicitudSeleccionado->escuela_id)
                ->get();

            if (!$gradoestudiante->count()) {
                GradoEstudiante::create([
                    'dni_estudiante' => $dni_estudiante,
                    'grado_academico_id' => 3, // 3 : Bachiller
                    'escuela_id' => $this->solicitudSeleccionado->escuela_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                $this->emit('guardado', 'El estudiante fue ascendido de grado al cumplir todos sus requisitos.');
            }
        }
        $this->emit('estadoSolicitud');
    }

    public function render()
    {
        return view('livewire.bachiller.solicitudes.completas');
    }
}
