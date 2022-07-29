<?php

namespace App\Http\Livewire\Auditoria;

use App\Models\AuditoriaInterna;
use App\Models\AuditoriaInternaDetalle;
use App\Models\Entidad;
use App\Models\Responsable;
use App\Models\ResponsableSalida;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class RealizarAuditoriaInterna extends Component
{
    public $facultad_id, $semestre_id, $entidades;
    public $responsables_internos = null, $responsables_externos = null;
    public $cantSalidas = 0, $salidasValidados = [];
    public $obs_general = "", $dni = "", $auditor = "";

    public $resp_salida_selected = null, $res_selected = "", $mostrarModal = false;

    protected $rules = [
        'dni' => 'required|min:8|max:8',
        'auditor' => 'required',
        'obs_general' => 'nullable',
    ];

    public $listeners = ['validarSalida'];

    public function mount($facultad_id, $semestre_id)
    {
        $this->semestre_id = $semestre_id;
        $this->entidades = Entidad::query()->where('facultad_id', $facultad_id)->pluck('id');
        $this->responsables_internos = Responsable::query()
            ->with('actividad', 'entidad', 'actividad.proceso', 'respsalidas')
            ->whereIn('entidad_id', function ($query) use ($facultad_id) {
                $query->select('id')->from('entidades')->where('facultad_id', $facultad_id);
            })->get();
        $this->responsables_internos = $this->limpiarDatos($this->responsables_internos);

        $this->responsables_externos = 5;
    }

    public function render()
    {
        $auditoria_interna = AuditoriaInterna::query()->where('facultad_id', $this->facultad_id)->where('semestre_id', $this->semestre_id)->first();
        return view('livewire.auditoria.realizar-auditoria-interna', compact('auditoria_interna'));
    }

    private function limpiarDatos($responsables)
    {
        $entidades_nombre = array();
        foreach ($responsables as $responsable) {
            if (!in_array($responsable->entidad->nombre, $entidades_nombre)) {
                $entidades_nombre[] = $responsable->entidad->nombre;
            }
        }
        Log::info('$entidades_nombre', $entidades_nombre);

        $entidades_procesos = array();
        foreach ($entidades_nombre as $entidad_nombre) {
            $entidad_proceso = array();
            $entidad_proceso['entidad'] = $entidad_nombre;

            $procesos = array();
            foreach ($responsables as $responsable) {
                if ($entidad_nombre === $responsable->entidad->nombre && !in_array($responsable->actividad->proceso->nombre, $procesos))
                    $procesos[] = $responsable->actividad->proceso->nombre;
            }
            $entidad_proceso['procesos'] = $procesos;
            $entidades_procesos[] = $entidad_proceso;
        }
        Log::info('$entidades_procesos', $entidades_procesos);

        $entidades = array();
        foreach ($entidades_procesos as $entidad_proceso) {
            $nueva_entidad = array();
            $nueva_entidad['entidad'] = $entidad_proceso['entidad'];

            $entidad_salidas_count = 0;
            $procesos = array();
            foreach ($entidad_proceso['procesos'] as $proceso_nombre) {

                $nuevo_proceso = array();
                $nuevo_proceso['proceso'] = $proceso_nombre;

                $actividad_salidas_count = 0;
                $actividades = array();
                foreach ($responsables as $responsable) {
                    if ($entidad_proceso['entidad'] == $responsable->entidad->nombre && $proceso_nombre == $responsable->actividad->proceso->nombre) {
                        $nueva_actividad = array();
                        $nueva_actividad['actividad'] = $responsable->actividad->nombre;
                        $nueva_actividad['salidas_count'] = count($responsable->respsalidas);
                        $actividad_salidas_count += $nueva_actividad['salidas_count'];

                        $salidas = array();
                        $salidas_completados = 0;
                        foreach ($responsable->respsalidas as $respsalida) {
                            $salida = array();
                            $salida['responsable_salida_id'] = $respsalida->id;
                            $salida['codigo'] = $respsalida->salida->codigo;
                            $salida['salida'] = $respsalida->salida->nombre;
                            $salida['documentos_count'] = \App\Models\ResponsableSalida::cant_documentos_por_semestre($this->semestre_id, $this->entidades, $respsalida->id);
                            if ($salida['documentos_count'] > 0) {
                                $salidas_completados++;
                            }
                            $salidas[] = $salida;
                            $this->cantSalidas++;
                        }

                        $nueva_actividad['salidas_completados_count'] = $salidas_completados;
                        $nueva_actividad['salidas'] = $salidas;
                        $actividades[] = $nueva_actividad;
                    }
                }

                $nuevo_proceso['salidas_count'] = $actividad_salidas_count + count($actividades);
                $entidad_salidas_count += $nuevo_proceso['salidas_count'];
                $nuevo_proceso['actividades'] = $actividades;
                $procesos[] = $nuevo_proceso;
            }

            $nueva_entidad['salidas_count'] = $entidad_salidas_count + count($procesos);
            $nueva_entidad['procesos'] = $procesos;
            $entidades[] = $nueva_entidad;
        }

        Log::info('$entidades', $entidades);

        return $entidades;
    }

    public function validarSalida($responsable_salida_id, $observacion)
    {
        $existe = false;
        foreach ($this->salidasValidados as $key => $val) {
            if ($key == 'RS-' . $responsable_salida_id) {
                $existe = true;
                break;
            }
        }

        if (!$existe) {
            $this->salidasValidados['RS-' . $responsable_salida_id] = strlen($observacion) > 0 ? $observacion : null;
        }
    }

    public function quitarSalida($responsable_salida)
    {
        unset($this->salidasValidados['RS-' . $responsable_salida]);
    }

    public function verDocumentos($responsable, $resp_salida_id)
    {
        $this->res_selected = $responsable;
        $this->resp_salida_selected = ResponsableSalida::query()
            ->with(['salida', 'documentos' => function ($query) {
                $query->whereHas('documento', function ($query2) {
                    $query2->where('semestre_id', $this->semestre_id);
                });
            }])->find($resp_salida_id);
        $this->mostrarModal = true;
    }

    public function guardarAuditoria()
    {
        $this->validate();

        if ($this->cantSalidas !== count($this->salidasValidados)) {
            $this->emit('error', "Faltan " . ($this->cantSalidas - count($this->salidasValidados)) . " salidas por validar");
            return;
        }

        $auditoria = AuditoriaInterna::create([
            'auditor_dni' => $this->dni,
            'auditor_nombre' => $this->auditor,
            'observacion' => strlen($this->obs_general) > 0 ? $this->obs_general : null,
            'facultad_id' => $this->facultad_id,
            'semestre_id' => $this->semestre_id,
            'user_id' => Auth::user()->id
        ]);

        $detalles = array();
        $auditoria_id = $auditoria->id;
        foreach ($this->responsables_internos as $entidad) {
            foreach ($entidad['procesos'] as $proceso) {
                foreach ($proceso['actividades'] as $actividad) {
                    foreach ($actividad['salidas'] as $salida) {
                        $detalle = [
                            'observacion' => array_key_exists('RS-' . $salida['responsable_salida_id'], $this->salidasValidados) ? $this->salidasValidados['RS-' . $salida['responsable_salida_id']] : null,
                            'documentos' => $salida['documentos_count'],
                            'responsable_salida_id' => $salida['responsable_salida_id'],
                            'auditoria_interna_id' => $auditoria_id
                        ];
                        $detalles[] = $detalle;
                    }
                }
            }
        }

        AuditoriaInternaDetalle::insert($detalles);

        $this->reset('dni', 'auditor', 'obs_general');

        redirect()->route('auditoria.internapdf', ['facultad' => $this->facultad_id, 'semestre' => $this->semestre_id]);

        return redirect()->route('auditoria.create');
    }

    public function descargarPdf()
    {
        $this->validate();

        if ($this->cantSalidas !== count($this->salidasValidados)) {
            $this->emit('error', "Faltan " . ($this->cantSalidas - count($this->salidasValidados)) . " salidas por validar");
            return;
        }
        $this->emit('success', "Ok Faltan " . ($this->cantSalidas - count($this->salidasValidados)) . " salidas por validar");
    }
}
