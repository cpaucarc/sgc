<?php

namespace App\Http\Livewire\Rsu;

use App\Models\ResponsabilidadSocial;
use App\Models\RsuParticipante;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AgregarParticipanteDocente extends Component
{
    public $mensaje_docentes = null;
    public $docentes_seleccionados = []; // array con el DNI de los docentes
    public $docentes = null;
    public $rsu_id;
    public $dni_usados; // DNI de docentes ya registrados como participantes
    public $depto_id, $semestre;

    protected $listeners = ["cargarDocentes" => "cargarDatosDocentes"];

    public function mount($rsu_id, $depto_id, $semestre)
    {
        $this->rsu_id = $rsu_id;
        $rsu = ResponsabilidadSocial::query()->select('id')
            ->with(['participantes' => function ($query) {
                $query->where('es_estudiante', false);
            }])
            ->where('id', $this->rsu_id)->first();
        $this->dni_usados = $rsu->participantes->pluck('dni_participante')->toArray();
        $this->depto_id = $depto_id;
        $this->semestre = $semestre;
        $this->cargarDatosDocentes();
    }

    public function render()
    {
        return view('livewire.rsu.agregar-participante-docente');
    }

    public function cargarDatosDocentes()
    {
        $docentes_no_participantes = array();

        if (is_null($this->docentes)) {
            $response = Http::withToken(env('OGE_TOKEN'))
                ->get(env('OGE_API') . 'proceso_docente/departamento/02?departamento=' . $this->depto_id . '&semestre=' . $this->semestre);
            $arrayDocentes = $response->json();

            foreach ($arrayDocentes as $doct) {
                if (!in_array($doct['dni'], $this->dni_usados))
                    $docentes_no_participantes[] = $doct;
            }

            // Ordena el array por el apellido paterno de los docentes
            $keys = array_column($docentes_no_participantes, 'apellido_paterno');
            array_multisort($keys, SORT_ASC, $docentes_no_participantes);

            $this->docentes = $docentes_no_participantes;
        }
    }

    public function agregarDocentes()
    {
        try {
            if (!count($this->docentes_seleccionados)) {
                $this->emit('error', "Seleccione al menos un docente");
                return;
            }

            $arrayParticipantes = [];
            foreach ($this->docentes_seleccionados as $dni_doc) {
                $arrayParticipantes[] = [
                    'fecha_incorporacion' => now()->format('Y-m-d'),
                    'es_responsable' => false,
                    'es_estudiante' => false,
                    'dni_participante' => $dni_doc,
                    'responsabilidad_social_id' => $this->rsu_id
                ];
                $this->dni_usados[] = $dni_doc;
            }

            if (count($arrayParticipantes)) {
                RsuParticipante::insert($arrayParticipantes);
                $this->emit('guardado', "Se añadieron correctamente " . count($arrayParticipantes) . " nuevos docentes participantes.");
                $this->emitTo("rsu.participantes", "render");
                $this->reset(['docentes_seleccionados', 'docentes']);
                $this->cargarDatosDocentes();
            }
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado\n" . $e);
        }
    }
}
