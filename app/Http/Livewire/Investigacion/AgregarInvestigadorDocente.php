<?php

namespace App\Http\Livewire\Investigacion;

use App\Models\Investigacion;
use App\Models\InvestigacionInvestigador;
use App\Models\Investigador;
use App\Models\RsuParticipante;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AgregarInvestigadorDocente extends Component
{
    public $mensaje_docentes = null;
    public $docentes_seleccionados = []; // array con el DNI de los docentes
    public $docentes = null;
    public $investigacion_id;
    public $dni_usados; // DNI de docentes ya registrados como participantes
    public $depto_id, $semestre;

    protected $listeners = ["cargarDocentes" => "cargarDatosDocentes"];

    public function mount($investigacion_id, $depto_id, $semestre)
    {
        $this->investigacion_id = $investigacion_id;
        $this->depto_id = $depto_id;
        $this->semestre = $semestre;

        $investigaciones = Investigacion::query()
            ->select('id')
            ->with(['investigadores' => function ($query) {
                $query->where('es_docente', false);
            }])
            ->where('id', $this->investigacion_id)
            ->first();
        $this->dni_usados = $investigaciones->investigadores->pluck('dni_investigador')->toArray();
        $this->cargarDatosDocentes();
    }

    public function render()
    {
        return view('livewire.investigacion.agregar-investigador-docente');
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

                $investigador = Investigador::query()->where('dni_investigador', $dni_doc)->first();

                if (is_null($investigador))
                    $investigador = Investigador::create(['es_docente' => true, 'dni_investigador' => $dni_doc]);

                $arrayParticipantes[] = [
                    'es_responsable' => false,
                    'investigador_id' => $investigador->id,
                    'investigacion_id' => $this->investigacion_id
                ];

                $this->dni_usados[] = $dni_doc;
            }

            if (count($arrayParticipantes)) {
                InvestigacionInvestigador::insert($arrayParticipantes);
                $this->emit('guardado', "Se añadieron correctamente " . count($arrayParticipantes) . " nuevos docentes investigadores.");
                $this->emitTo("investigacion.lista-investigacion-participantes", "render");
                $this->mensaje_docentes = null;
                $this->reset(['docentes_seleccionados', 'docentes']);
                $this->cargarDatosDocentes();
            }
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado\n" . $e);
        }
    }
}
