<?php

namespace App\Http\Livewire\Indicador;

use App\Lib\AnalisisHelper;
use App\Models\AnalisisCurso;
use App\Models\AnalisisIndicador;
use App\Models\Curso;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Indicadorable;
use App\Models\Medicion;
use App\Models\Semestre;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NuevoAnalisis extends Component
{
    public $open = false;
    public $tipo, $medicionEnSemanas = 4;
    public $indicadorable, $entidad, $type, $oficina;
    public $min, $sat, $sob;
    public $semestres = null, $semestre_id = 0, $semestre_nombre = null, $semestre_inicio = null, $semestre_fin = null;
    public $inicio, $fin, $diffInDays, $diffIsOk = true;
    public $resultados = null;
    public $elaborado, $revisado, $aprobado;
    public $analisis, $observacion;
    public $guardar = false; //Checkbox para saber si se va a guardar nuevos rangos de medida

    public $cod_ind = "", $cursos = null;

    protected $listeners = ['openModal'];

    protected $rules = [
        'min' => 'required',
        'sat' => 'required',
        'sob' => 'required',
    ];

    public function mount($indicadorable_id, $oficina, $tipo, $uuid)
    {
        $this->tipo = $tipo; //Tipo 1:Escuela o 2:Facultad
        $this->oficina = $oficina;

        $this->semestres = Semestre::query()->orderBy('nombre', 'desc')->get();
        $this->semestre_id = $this->semestres->where('activo', true)->first()->id;
        $this->semestre_nombre = $this->semestres->first()->nombre;
        $this->semestre_inicio = $this->semestres->first()->fecha_inicio->format('Y-m-d');
        $this->semestre_fin = $this->semestres->first()->fecha_fin->format('Y-m-d');

        $this->indicadorable = Indicadorable::query()
            ->with('indicador', 'indicador.medicion')
            ->findOrFail($indicadorable_id);

        $this->categorizarPorTipo($tipo, $uuid);

        $this->min = $this->indicadorable->indicador->minimo;
        $this->sat = $this->indicadorable->indicador->satisfactorio;
        $this->sob = $this->indicadorable->indicador->sobresaliente;

        $this->cod_ind = $this->indicadorable->indicador->cod_ind_inicial;

        $this->elaborado = Auth::user()->name;

        $this->medicionEnSemanas = $this->indicadorable->indicador->medicion->tiempo_semanas;

        $this->fechasPorDefecto($this->indicadorable->indicador->medicion->nombre);
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

    public function updatedSemestreId($value)
    {
        $s = Semestre::find($value);
        $this->semestre_nombre = $s->nombre;
        $this->semestre_inicio = $s->fecha_inicio->format('Y-m-d');
        $this->semestre_fin = $s->fecha_fin->format('Y-m-d');
        $this->inicio = $this->semestre_inicio;
        $this->fin = $this->semestre_fin;
        $this->diffIsOk = AnalisisHelper::rangoEsOk($this->inicio, $this->fin, $this->medicionEnSemanas);
        $this->obtenerResultados();
    }

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
        $frecuencia = strtolower($frecuencia);
        $now = Carbon::now();

        if (strcmp($frecuencia, "semestral") === 0) {
            $this->inicio = $this->semestre_inicio;
            $this->fin = $this->semestre_fin;
        } elseif (strcmp($frecuencia, "mensual") === 0) {
            $this->inicio = $now->startOfMonth()->format('Y-m-d');
            $this->fin = $now->endOfMonth()->format('Y-m-d');
        } elseif (strcmp($frecuencia, "semanal") === 0) {
            $this->inicio = $now->startOfWeek()->format('Y-m-d');
            $this->fin = $now->endOfWeek()->format('Y-m-d');
        } elseif (strcmp($frecuencia, "anual") === 0) {
            $this->inicio = $now->subYear()->startOfYear()->format('Y-m-d');
            $this->fin = $now->subYear()->endOfYear()->format('Y-m-d');
        }
        $this->diffIsOk = AnalisisHelper::rangoEsOk($this->inicio, $this->fin, $this->medicionEnSemanas);
    }

    public function guardarAnalisis()
    {
        if (is_null($this->resultados)) {
            return;
        }

        $this->validate();

        $usuario_actual = Auth::user()->id;
        $analisis_cursos = array();

        foreach ($this->resultados as $res) {
            $analisis_indicador = AnalisisIndicador::create([
                'fecha_medicion_inicio' => $this->inicio,
                'fecha_medicion_fin' => $this->fin,
                'cod_ind_final' => $this->indicadorable->indicador->cod_ind_inicial . '_' . $this->entidad->abrev,
                'minimo' => $this->min,
                'satisfactorio' => $this->sat,
                'sobresaliente' => $this->sob,
                'interes' => $res['interes'],
                'total' => $res['total'],
                'resultado' => $res['resultado'],
                'interpretacion' => $this->analisis,
                'observacion' => $this->observacion,
                'elaborado_por' => $this->elaborado,
                'revisado_por' => $this->revisado,
                'aprobado_por' => $this->aprobado,
                'user_id' => $usuario_actual,
                'semestre_id' => $this->semestre_id,
                'indicadorable_id' => $this->indicadorable->id,
            ]);

            if (in_array($this->cod_ind, ['IND-032', 'IND-033', 'IND-034'])) {
                $analisis_cursos[] = [
                    "analisis_indicador_id" => $analisis_indicador->id,
                    "curso_id" => Curso::query()->where('codigo', $res['codigo'])->first()->id
                ];
            }
        }

        if (!is_null($analisis_cursos)) {
            AnalisisCurso::insert($analisis_cursos);
        }

        // Guardamos los nuevos valores de min, sat, sob si el checkbox está activo
        if ($this->guardar) {
            $this->indicadorable->indicador->minimo = $this->min;
            $this->indicadorable->indicador->satisfactorio = $this->sat;
            $this->indicadorable->indicador->sobresaliente = $this->sob;
            $this->indicadorable->indicador->save();
        }

        $this->reset([
            'open', 'guardar', 'revisado', 'aprobado', 'analisis', 'observacion'
        ]);

        $this->emit('guardado', "Se creó con éxito un nuevo análisis para el rango de " . $this->inicio . " y " . $this->fin);
        $this->emit('renderizarTabla');
    }

    public function obtenerResultados()
    {
        // Bienestar: 019 - 020
        if ($this->cod_ind === "IND-017") {
            $res = Medicion::ind17($this->entidad->id, $this->inicio, $this->fin);
        } elseif ($this->cod_ind === "IND-019") {
            $res = Medicion::ind19($this->entidad->id, $this->inicio, $this->fin);
        } // RSU: 048 - 053
        elseif ($this->cod_ind === "IND-048") {
            $res = Medicion::ind48($this->tipo == 1, $this->entidad->id, $this->semestre_id);
        } elseif ($this->cod_ind === "IND-049") {
            $res = Medicion::ind49($this->tipo == 1, $this->entidad->id, $this->semestre_id);
        } elseif ($this->cod_ind === "IND-050") {
            $res = Medicion::ind50($this->tipo == 1, $this->entidad->id, $this->semestre_nombre, $this->semestre_id, $this->tipo == 1 ? $this->entidad->depto_id : null);
        } elseif ($this->cod_ind === "IND-051") {
            $res = Medicion::ind51($this->tipo == 1, $this->entidad->id, $this->semestre_nombre, $this->semestre_id);
        } elseif ($this->cod_ind === "IND-052") {
            $res = Medicion::ind52($this->tipo == 1, $this->entidad->id, $this->semestre_id);
        } // Investigacion: 044 - 047
        elseif ($this->cod_ind === "IND-044") {
            $res = Medicion::ind44($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin, $this->semestre_nombre, $this->tipo == 1 ? $this->entidad->depto_id : null);
        } elseif ($this->cod_ind === "IND-045") {
            $res = Medicion::ind45($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin, $this->semestre_nombre);
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
            $res = Medicion::ind32($this->entidad->id, $this->semestre_nombre);
        } elseif ($this->cod_ind === "IND-033") {
            $res = Medicion::ind33($this->entidad->id, $this->semestre_nombre);
        } elseif ($this->cod_ind === "IND-034") {
            $res = Medicion::ind34($this->entidad->id, $this->semestre_nombre);
        } elseif ($this->cod_ind === "IND-035") {
            $res = Medicion::ind35($this->entidad->id, $this->semestre_nombre);
        } elseif ($this->cod_ind === "IND-036") {
            $res = Medicion::ind36($this->entidad->id, $this->semestre_nombre);
        } elseif ($this->cod_ind === "IND-037") {
            $res = Medicion::ind37($this->entidad->id, $this->semestre_nombre, $this->inicio, $this->fin);
        } elseif ($this->cod_ind === "IND-038") {
            $res = Medicion::ind38($this->entidad->id, $this->semestre_nombre);
        } // Tutoria y Consejeria
        elseif ($this->cod_ind === "IND-054") {
            $res = Medicion::ind54($this->entidad->depto_id, $this->semestre_nombre);
        } elseif ($this->cod_ind === "IND-055") {
            $res = Medicion::ind55($this->entidad->id, $this->semestre_nombre);
        } elseif ($this->cod_ind === "IND-056") {
            $res = Medicion::ind56($this->entidad->id, $this->semestre_nombre);
        } elseif ($this->cod_ind === "IND-057") {
            $res = Medicion::ind57($this->entidad->id, $this->semestre_nombre);
        } // Matricula
        elseif ($this->cod_ind === "IND-039") {
            $res = Medicion::ind39($this->entidad->id, $this->semestre_nombre);
        } elseif ($this->cod_ind === "IND-040") {
            $res = Medicion::ind40($this->entidad->id, $this->semestre_nombre);
        } elseif ($this->cod_ind === "IND-041") {
            $res = Medicion::ind41($this->entidad->id, $this->semestre_nombre);
        } elseif ($this->cod_ind === "IND-042") {
            $res = Medicion::ind42($this->entidad->id, $this->semestre_nombre);
        } elseif ($this->cod_ind === "IND-043") {
            $res = Medicion::ind43($this->entidad->id, $this->semestre_nombre);
        } // Docente
        elseif ($this->cod_ind === "IND-062") {
            $res = Medicion::ind62($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_nombre);
        } elseif ($this->cod_ind === "IND-063") {
            $res = Medicion::ind63($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_nombre);
        } elseif ($this->cod_ind === "IND-065") {
            $res = Medicion::ind65($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_nombre);
        } elseif ($this->cod_ind === "IND-066") {
            $res = Medicion::ind66($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_nombre);
        } elseif ($this->cod_ind === "IND-067") {
            $res = Medicion::ind67($this->tipo == 1, $this->entidad->id, $this->semestre_nombre, $this->tipo == 1 ? $this->entidad->depto_id : null);
        } elseif ($this->cod_ind === "IND-074") {
            $res = Medicion::ind74($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_nombre);
        } elseif ($this->cod_ind === "IND-075") {
            $res = Medicion::ind75($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_nombre);
        } elseif ($this->cod_ind === "IND-076") {
            $res = Medicion::ind76($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_nombre);
        } elseif ($this->cod_ind === "IND-077") {
            $res = Medicion::ind77($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_nombre);
        } elseif ($this->cod_ind === "IND-078") {
            $res = Medicion::ind78($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_nombre);
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

        if (isset($res)) {
            $this->resultados = $res;
        }
    }
}
