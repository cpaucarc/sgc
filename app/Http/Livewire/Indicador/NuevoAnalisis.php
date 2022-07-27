<?php

namespace App\Http\Livewire\Indicador;

use App\Lib\AnalisisHelper;
use App\Models\AnalisisCapacitacion;
use App\Models\AnalisisCurso;
use App\Models\AnalisisIndicador;
use App\Models\AnalisisServicio;
use App\Models\Curso;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Indicadorable;
use App\Models\Medicion;
use App\Models\Semestre;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class NuevoAnalisis extends Component
{
    public $open = false;

    public $semestre_seleccionado = null;
    public $fecha_semana, $fecha_mes;
    public $fecha_inicio, $fecha_fin;
    public $limite_inferior, $limite_superior;

    public $tipo, $medicionEnSemanas = 4, $frecuencia;
    public $indicadorable, $entidad, $type, $oficina;
    public $min, $sob;
    public $semestres = null, $semestre_id = 0;
    public $inicio, $fin, $diffInDays, $diffIsOk = true;
    public $resultados = null;
    public $elaborado, $revisado, $aprobado;
    public $analisis, $observacion;
    public $guardar = false; //Checkbox para saber si se va a guardar nuevos rangos de medida

    public $cod_ind = "", $cursos = null;

    protected $listeners = ['openModal', 'recibirFechas'];

    protected $rules = [
        'min' => 'required',
        'sob' => 'required',
    ];

    public function mount($indicadorable_id, $oficina, $tipo, $uuid)
    {
        $this->tipo = $tipo; //Tipo 1:Escuela o 2:Facultad
        $this->oficina = $oficina;

        $this->indicadorable = Indicadorable::query()
            ->with('indicador', 'indicador.medicion')
            ->findOrFail($indicadorable_id);

        $this->categorizarPorTipo($tipo, $uuid);

        $this->min = $this->indicadorable->indicador->minimo;
        $this->sob = $this->indicadorable->indicador->sobresaliente;

        $this->cod_ind = $this->indicadorable->indicador->cod_ind_inicial;

        $this->elaborado = Auth::user()->name;

        $this->medicionEnSemanas = $this->indicadorable->indicador->medicion->tiempo_semanas;
        $this->frecuencia = strtolower($this->indicadorable->indicador->medicion->nombre);
        if ($this->frecuencia == 'semestral') {
            $this->semestres = Semestre::query()->orderBy('nombre', 'desc')->get();
            $this->semestre_seleccionado = $this->semestres->where('activo', true)->first();
        } else {
            $this->semestre_seleccionado = Semestre::query()->where('activo', true)->first();
        }

        $this->limite_inferior = $this->semestre_seleccionado->fecha_inicio;
        $this->limite_superior = $this->semestre_seleccionado->fecha_fin;

        $this->fechasPorDefecto($this->frecuencia);
    }

    public function render()
    {
        if ($this->open) {
            $this->obtenerResultados();
        }

        return view('livewire.indicador.nuevo-analisis');
    }

    /* Funciones */
    public function openModal()
    {
        $this->open = true;
    }

    /* Properties Updates */
    public function updatedInicio()
    {
        $this->diffIsOk = AnalisisHelper::rangoEsOk($this->inicio, $this->fin, $this->medicionEnSemanas);
        $this->obtenerResultados();
    }

    public function updatedFin()
    {
        $this->diffIsOk = AnalisisHelper::rangoEsOk($this->inicio, $this->fin, $this->medicionEnSemanas);
        $this->obtenerResultados();
    }

    public function updatedFechaSemana($nuevaSemana)
    {
        $semana = explode("-W", $nuevaSemana)[1];

        $this->inicio = now()->week($semana)->startOfWeek();
        $this->fin = now()->week($semana)->endOfWeek();
        $this->obtenerResultados();
    }

    public function updatedFechaMes($nuevoMes)
    {
        $mes = intval(explode("-", $nuevoMes)[1]);

        $this->inicio = now()->month($mes)->startOfMonth();
        $this->fin = now()->month($mes)->endOfMonth();
        $this->obtenerResultados();
    }

    public function updatedSemestreId($semestre_id)
    {
        $this->semestre_seleccionado = $this->semestres->where('id', $semestre_id)->first();
        $this->inicio = $this->semestre_seleccionado->fecha_inicio;
        $this->fin = $this->semestre_seleccionado->fecha_fin;
        $this->obtenerResultados();
    }


    /* Funciones */
    public function categorizarPorTipo($tipo, $uuid)
    {
        if ($tipo == 1) { // 1: escuela
            $this->entidad = Escuela::where('uuid', $uuid)->first();
            $this->type = "App\\Models\\Escuela";
        } else { // 2: facultad
            $this->entidad = Facultad::where('uuid', $uuid)->first();
            $this->type = "App\\Models\\Facultad";
        }
    }

    public function fechasPorDefecto($frecuencia)
    {
        if ($frecuencia == "semestral" && $this->semestre_seleccionado) {
            $this->inicio = $this->semestre_seleccionado->fecha_inicio;
            $this->fin = $this->semestre_seleccionado->fecha_fin;
            $this->semestre_id = $this->semestre_seleccionado->id;

        } elseif ($frecuencia == "mensual") {
            $this->inicio = now()->startOfMonth();
            $this->fin = now()->endOfMonth();
            $this->fecha_mes = now()->format('Y-m');

        } elseif ($frecuencia == "semanal") {
            $this->inicio = now()->startOfWeek();
            $this->fin = now()->endOfWeek();
            $this->fecha_semana = now()->format('Y') . "-W" . now()->week();

        } elseif ($frecuencia == "anual") {
            $this->inicio = now()->subYear()->startOfYear();
            $this->fin = now()->subYear()->endOfYear();
        }

        $this->diffIsOk = AnalisisHelper::rangoEsOk($this->inicio, $this->fin, $this->medicionEnSemanas);
    }

    public function guardarAnalisis()
    {
        if (is_null($this->resultados)) {
            return;
        }

        $this->validate();

        $analisis_cursos = array();
        $analisis_capacitaciones = array();
        $analisis_servicios = array();

        Log::info('Resultados', $this->resultados);

        foreach ($this->resultados as $res) {
            $analisis_indicador = AnalisisIndicador::create([
                'fecha_medicion_inicio' => $this->inicio,
                'fecha_medicion_fin' => $this->fin,
                'minimo' => $this->min,
                'sobresaliente' => $this->sob,
                'interes' => $res['interes'] ?? null,
                'total' => $res['total'] ?? null,
                'resultado' => $res['resultado'],
                'interpretacion' => $this->analisis,
                'observacion' => $this->observacion,
                'elaborado_por' => $this->elaborado,
                'revisado_por' => $this->revisado,
                'aprobado_por' => $this->aprobado,
                'user_id' => Auth::user()->id,
                'semestre_id' => $this->semestre_seleccionado->id,
                'indicadorable_id' => $this->indicadorable->id,
            ]);

            if (in_array($this->cod_ind, ['IND-032', 'IND-033', 'IND-034'])) {
                $analisis_cursos[] = [
                    "analisis_indicador_id" => $analisis_indicador->id,
                    "curso_id" => Curso::query()->where('codigo', $res['codigo'])->first()->id
                ];
            }

            if (in_array($this->cod_ind, ['IND-075'])) {
                $analisis_capacitaciones[] = [
                    "analisis_indicador_id" => $analisis_indicador->id,
                    "capacitacion_id" => $res['codigo']
                ];
            }

            if (in_array($this->cod_ind, ['IND-019'])) {
                $analisis_servicios[] = [
                    "analisis_indicador_id" => $analisis_indicador->id,
                    "servicio_id" => $res['codigo']
                ];
            }
        }

        if (!is_null($analisis_cursos)) {
            AnalisisCurso::insert($analisis_cursos);
        }

        if (!is_null($analisis_capacitaciones)) {
            AnalisisCapacitacion::insert($analisis_capacitaciones);
        }

        if (!is_null($analisis_servicios)) {
            AnalisisServicio::insert($analisis_servicios);
        }

        // Guardamos los nuevos valores de min, sob si el checkbox está activo
        if ($this->guardar) {
            $this->indicadorable->minimo = $this->min;
            $this->indicadorable->sobresaliente = $this->sob;
            $this->indicadorable->save();
        }

        $this->reset([
            'open', 'guardar', 'revisado', 'aprobado', 'analisis', 'observacion'
        ]);

        $this->emit('guardado', "Se creó con éxito un nuevo análisis para el rango de " . $this->inicio->format('d, M Y') . " y " . $this->fin->format('d, M Y'));
        $this->emit('renderizarTabla');
    }

    public function obtenerResultados()
    {
        // Bienestar: 019 - 020
        if ($this->cod_ind === "IND-017") {
            $res = Medicion::ind17($this->entidad->id, $this->fecha_mes);
        } elseif ($this->cod_ind === "IND-019") {
            $res = Medicion::ind19($this->entidad->id, $this->fecha_mes);
        } // RSU: 048 - 053
        elseif ($this->cod_ind === "IND-048") {
            $res = Medicion::ind48($this->tipo == 1, $this->entidad->id, $this->semestre_id);
        } elseif ($this->cod_ind === "IND-049") {
            $res = Medicion::ind49($this->tipo == 1, $this->entidad->id, $this->semestre_id);
        } elseif ($this->cod_ind === "IND-050") {
            $res = Medicion::ind50($this->tipo == 1, $this->entidad->id, $this->semestre_seleccionado->nombre, $this->semestre_id, $this->tipo == 1 ? $this->entidad->depto_id : null);
        } elseif ($this->cod_ind === "IND-051") {
            $res = Medicion::ind51($this->tipo == 1, $this->entidad->id, $this->semestre_seleccionado->nombre, $this->semestre_id);
        } elseif ($this->cod_ind === "IND-052") {
            $res = Medicion::ind52($this->tipo == 1, $this->entidad->id, $this->semestre_id);
        } // Investigacion: 044 - 047
        elseif ($this->cod_ind === "IND-044") {
            $res = Medicion::ind44($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin, $this->semestre_seleccionado->nombre, $this->tipo == 1 ? $this->entidad->depto_id : null);
        } elseif ($this->cod_ind === "IND-045") {
            $res = Medicion::ind45($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin, $this->semestre_seleccionado->nombre);
        } elseif ($this->cod_ind === "IND-046") {
            $res = Medicion::ind46($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin);
        } elseif ($this->cod_ind === "IND-047") {
            $res = Medicion::ind47($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin);
        } // Biblioteca: 09 - 015
        elseif ($this->cod_ind === "IND-009") {
            $res = Medicion::ind09($this->entidad->id, $this->inicio, $this->fin);
        } elseif ($this->cod_ind === "IND-010") {
            $res = Medicion::ind10($this->entidad->id, $this->inicio, $this->fin);
        } elseif ($this->cod_ind === "IND-011") {
            $res = Medicion::ind11($this->entidad->id, $this->inicio, $this->fin);
        } elseif ($this->cod_ind === "IND-012") {
            $res = Medicion::ind12($this->entidad->id, $this->inicio, $this->fin);
        } elseif ($this->cod_ind === "IND-013") {
            $res = Medicion::ind13($this->entidad->id, $this->inicio, $this->fin);
        } elseif ($this->cod_ind === "IND-014") {
            $res = Medicion::ind14($this->entidad->id, $this->inicio, $this->fin);
        } // Bachiller: 58
        elseif ($this->cod_ind === "IND-058") {
            $res = Medicion::ind58($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin);
        } // Titulo Profesional: 59
        elseif ($this->cod_ind === "IND-059") {
            $res = Medicion::ind59($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin);
        } elseif ($this->cod_ind === "IND-060") {
            $res = Medicion::ind60($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin);
        } elseif ($this->cod_ind === "IND-061") {
            $res = Medicion::ind61($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin);
        } // Gestion de Calidad
        elseif ($this->cod_ind === "IND-001") {
            $res = Medicion::ind01($this->entidad->id, $this->inicio, $this->fin);
        } elseif ($this->cod_ind === "IND-068") {
            $res = Medicion::ind68($this->entidad->id, $this->semestre_id);
        } elseif ($this->cod_ind === "IND-069") {
            $res = Medicion::ind69($this->entidad->id, $this->inicio, $this->fin);
        } elseif ($this->cod_ind === "IND-070") {
            $res = Medicion::ind70($this->entidad->id, $this->semestre_id);
        } // Convalidaciones
        elseif ($this->cod_ind === "IND-024") {
            $res = Medicion::ind24($this->entidad->id, $this->inicio, $this->fin);
        } elseif ($this->cod_ind === "IND-025") {
            $res = Medicion::ind25($this->entidad->id, $this->inicio, $this->fin);
        } elseif ($this->cod_ind === "IND-026") {
            $res = Medicion::ind26($this->entidad->id, $this->inicio, $this->fin);
        } // Enseñanza y Aprendizaje
        elseif ($this->cod_ind === "IND-032") {
            $res = Medicion::ind32($this->entidad->id, $this->semestre_seleccionado->nombre);
        } elseif ($this->cod_ind === "IND-033") {
            $res = Medicion::ind33($this->entidad->id, $this->semestre_seleccionado->nombre);
        } elseif ($this->cod_ind === "IND-034") {
            $res = Medicion::ind34($this->entidad->id, $this->semestre_seleccionado->nombre);
        } elseif ($this->cod_ind === "IND-035") {
            $res = Medicion::ind35($this->entidad->id, $this->semestre_seleccionado->nombre);
        } elseif ($this->cod_ind === "IND-036") {
            $res = Medicion::ind36($this->entidad->id, $this->semestre_seleccionado->nombre);
        } elseif ($this->cod_ind === "IND-037") {
            $res = Medicion::ind37($this->entidad->id, $this->semestre_seleccionado->nombre, $this->inicio, $this->fin);
        } elseif ($this->cod_ind === "IND-038") {
            $res = Medicion::ind38($this->entidad->id, $this->semestre_seleccionado->nombre);
        } // Tutoria y Consejeria
        elseif ($this->cod_ind === "IND-054") {
            $res = Medicion::ind54($this->entidad->depto_id, $this->semestre_seleccionado->nombre);
        } elseif ($this->cod_ind === "IND-055") {
            $res = Medicion::ind55($this->entidad->id, $this->semestre_seleccionado->nombre);
        } elseif ($this->cod_ind === "IND-056") {
            $res = Medicion::ind56($this->entidad->id, $this->semestre_seleccionado->nombre);
        } elseif ($this->cod_ind === "IND-057") {
            $res = Medicion::ind57($this->entidad->id, $this->semestre_seleccionado->nombre);
        } // Matricula
        elseif ($this->cod_ind === "IND-039") {
            $res = Medicion::ind39($this->entidad->id, $this->semestre_seleccionado->nombre);
        } elseif ($this->cod_ind === "IND-040") {
            $res = Medicion::ind40($this->entidad->id, $this->semestre_seleccionado->nombre);
        } elseif ($this->cod_ind === "IND-041") {
            $res = Medicion::ind41($this->entidad->id, $this->semestre_seleccionado->nombre);
        } elseif ($this->cod_ind === "IND-042") {
            $res = Medicion::ind42($this->entidad->id, $this->semestre_seleccionado->nombre);
        } elseif ($this->cod_ind === "IND-043") {
            $res = Medicion::ind43($this->entidad->id, $this->semestre_seleccionado->nombre);
        } // Docente
        elseif ($this->cod_ind === "IND-062") {
            $res = Medicion::ind62($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_id);
        } elseif ($this->cod_ind === "IND-063") {
            $res = Medicion::ind63($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_id);
        } elseif ($this->cod_ind === "IND-065") {
            $res = Medicion::ind65($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_seleccionado->nombre);
        } elseif ($this->cod_ind === "IND-066") {
            $res = Medicion::ind66($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_id);
        } elseif ($this->cod_ind === "IND-067") {
            // FIXME reemplazar directamente por el id del Depto
            $res = Medicion::ind67($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_id);
        } elseif ($this->cod_ind === "IND-074") {
            $res = Medicion::ind74($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_seleccionado->nombre);
        } elseif ($this->cod_ind === "IND-075") {
            // FIXME reemplazar directamente por el id del Depto
            $res = Medicion::ind75($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_id);
        } elseif ($this->cod_ind === "IND-076") {
            $res = Medicion::ind76($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_seleccionado->nombre);
        } elseif ($this->cod_ind === "IND-077") {
            // FIXME reemplazar directamente por el id del Depto
            $res = Medicion::ind77($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_id);
        } elseif ($this->cod_ind === "IND-078") {
            // FIXME reemplazar directamente por el id del Depto
            $res = Medicion::ind78($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_id);
        } // Bolsa
        elseif ($this->cod_ind === "IND-021") {
            $res = Medicion::ind21($this->entidad->id, $this->inicio, $this->fin);
        } // Convenio
        elseif ($this->cod_ind === "IND-027") {
            $res = Medicion::ind27($this->entidad->id, $this->semestre_id);
        } elseif ($this->cod_ind === "IND-028") {
            $res = Medicion::ind28($this->entidad->id, $this->semestre_id);
        } elseif ($this->cod_ind === "IND-029") {
            $res = Medicion::ind29($this->entidad->id, $this->semestre_id);
        } elseif ($this->cod_ind === "IND-030") {
            $res = Medicion::ind30($this->entidad->id, $this->semestre_id);
        }
        Log::info('Medición ' . $this->cod_ind . ' : ', $res ?? []);

        if (is_null($res)) {
            $this->resultados = null;
            return;
        }

        if (isset($res)) {
            $this->resultados = $res;
        }
    }
}
