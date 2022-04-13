<?php

namespace App\Http\Livewire\Tpu\Solicitudes;

use App\Models\DocumentoSolicitud;
use App\Models\GradoEstudiante;
use App\Models\Solicitud;
use App\Models\Tesis;
use Livewire\Component;

class Pendiente extends Component
{
    protected $solicitudes;
    public $solicitudesCompletas, $solicitudesIncompletas;
    public $open = false;
    public $requisitosCompleto = false;
    public $solicitudSeleccionado = null;
    public $solicitante = null;

    public $tesis = null;

    protected $listeners = [
        'documentoAprobado' => 'render',
        'estadoSolicitud' => 'render',
    ];

    public function mount()
    {
        $this->obtenerPendientes();
    }

    public function obtenerPendientes()
    {
        $this->solicitudes = Solicitud::query()
            ->where('tipo_solicitud_id', 3)// 3 : Titulo profesional
            ->withCount('documentos')
            ->having('documentos_count', '>', 0)
            ->get();

        $this->solicitudesCompletas = $this->solicitudes->filter(function ($item) {
            return $item->documentos_count == 8; // 8 : Requisitos de titulo profesional
        });
        $this->solicitudesIncompletas = $this->solicitudes->filter(function ($item) {
            return $item->documentos_count < 8;
        });
    }

    public function mostrarModal($id, $codigoEstudiante, $completo)
    {
        $this->solicitanteCodigo = $codigoEstudiante;
        $this->requisitosCompleto = $completo;
        $this->solicitudSeleccionado = Solicitud::query()
            ->with('documentos')
            ->where('tipo_solicitud_id', 3) // 3 : Titulo profesional
            ->where('id', $id)
            ->first();

        $this->tesis = Tesis::query()
            ->where('dni_estudiante', $this->solicitudSeleccionado->dni_estudiante)
            ->first();

        $this->estadoSolicitud();

        $this->open = true;
    }

    public function estadoSolicitud()
    {
        $countAprobado = 0;
        $countDenegado = 0;

        if (!is_null($this->solicitudSeleccionado)) {
            foreach ($this->solicitudSeleccionado->documentos as $doc) {
                if ($doc->estado->nombre == 'Aprobado') {
                    $countAprobado++;
                } elseif ($doc->estado->nombre == 'Denegado') {
                    $countDenegado++;
                }
            }

            if ($countDenegado > 0) {
                $this->solicitudSeleccionado->estado_id = 5;// 5 : Estado Solicitud Denegado
                $this->solicitudSeleccionado->save();
            } else {
                $this->solicitudSeleccionado->estado_id = 4;// 4 : Estado Solicitud En Evaluación
                $this->solicitudSeleccionado->save();
            }
            if ($countAprobado == 8) {
                $this->solicitudSeleccionado->estado_id = 6;// 6 : Estado Solicitud Aprobado
                $this->solicitudSeleccionado->save();

                $gradoestudiante = GradoEstudiante::query()
                    ->where('dni_estudiante', $this->solicitanteCodigo)
                    ->where('grado_academico_id', 4) // 4 : Titulado
                    ->get();
                if (!$gradoestudiante->count()) {
                    GradoEstudiante::create([
                        'dni_estudiante' => $this->solicitanteCodigo,
                        'grado_academico_id' => 4, // 4 : Titulado
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    $this->emit('guardado', 'El estudiante fue ascendido de grado al cumplir todos sus requisitos.');
                }
            }
        }
        $this->emit('estadoSolicitud');
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


    public function render()
    {
        return view('livewire.tpu.solicitudes.pendiente');
    }
}
