<?php

namespace App\Http\Livewire\Indicador;

use App\Models\AnalisisIndicador;
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
    public $tipo, $frecuenciaEnDias = 30;
    public $indicadorable, $entidad, $type, $oficina;
    public $min, $sat, $sob;
    public $semestres = null, $semestre_id = 0, $semestre_nombre = null, $semestre_inicio = null, $semestre_fin = null;
    public $inicio, $fin, $diffInDays, $diffIsOk = true;
    public $interes = null, $total = null, $resultado = null;
    public $elaborado, $revisado, $aprobado;
    public $analisis, $observacion;
    public $guardar = false; //Checkbox para saber si se va a guardar nuevos rangos de medida

    protected $listeners = ['openModal'];

    protected $rules = [
        'min' => 'required',
        'sat' => 'required',
        'sob' => 'required',
        'resultado' => 'required',
    ];

    public function mount($indicadorable_id, $oficina, $tipo, $uuid)
    {
        $this->tipo = $tipo; //Tipo 1:Escuela o 2:Facultad
        $this->oficina = $oficina;

        $this->semestres = Semestre::query()->orderBy('nombre', 'desc')->get();
        $this->semestre_id = $this->semestres->first()->id;
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

        $this->elaborado = Auth::user()->name;

        $this->frecuenciaEnDias = $this->indicadorable->indicador->medicion->tiempo_semanas * 7;

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
        $this->comprobarFechas();
        $this->obtenerResultados();
    }

    public function updatedFin()
    {
        $this->comprobarFechas();
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
        $this->comprobarFechas();
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
        $this->comprobarFechas();
    }

    public function comprobarFechas()
    {
        $this->diffInDays = Carbon::parse($this->fin)->diffInDays($this->inicio);

        if ($this->frecuenciaEnDias === 180) { //Semestral
            $this->diffIsOk = !($this->diffInDays > 184 || $this->diffInDays < 150);
        } elseif ($this->frecuenciaEnDias === 30) { //Mensual
            $this->diffIsOk = !($this->diffInDays > 31 || $this->diffInDays < 20);
        } elseif ($this->frecuenciaEnDias === 7) { //Semanal
            $this->diffIsOk = !($this->diffInDays > 7 || $this->diffInDays < 4);
        } elseif ($this->frecuenciaEnDias === 360) { //Anual
            $this->diffIsOk = !($this->diffInDays > 366 || $this->diffInDays < 330);
        }
    }

    public function guardarAnalisis()
    {
        $this->emit('guardado', "Evento click " . $this->inicio . " y " . $this->fin);
        $this->validate();
        AnalisisIndicador::create([
            'fecha_medicion_inicio' => $this->inicio,
            'fecha_medicion_fin' => $this->fin,
            'cod_ind_final' => $this->indicadorable->indicador->cod_ind_inicial . '_' . $this->entidad->abrev,
            'minimo' => $this->min,
            'satisfactorio' => $this->sat,
            'sobresaliente' => $this->sob,
            'interes' => $this->interes,
            'total' => $this->total,
            'resultado' => $this->resultado,
            'interpretacion' => $this->analisis,
            'observacion' => $this->observacion,
            'elaborado_por' => $this->elaborado,
            'revisado_por' => $this->revisado,
            'aprobado_por' => $this->aprobado,
            'user_id' => Auth::user()->id,
            'semestre_id' => Semestre::query()->orderBy('nombre', 'desc')->first()->id,
            'indicadorable_id' => $this->indicadorable->id,
        ]);

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
        $codigo_inicial = $this->indicadorable->indicador->cod_ind_inicial;

        // Bienestar: 019 - 020
        if ($codigo_inicial === "IND-017") {
            $res = Medicion::ind17($this->entidad->id, $this->inicio, $this->fin);
        } elseif ($codigo_inicial === "IND-019") {
            $res = Medicion::ind19($this->entidad->id, $this->inicio, $this->fin);
        } // RSU: 048 - 053
        elseif ($codigo_inicial === "IND-048") {
            $res = Medicion::ind48($this->tipo == 1, $this->entidad->id, $this->semestre_id);
        } elseif ($codigo_inicial === "IND-049") {
            $res = Medicion::ind49($this->tipo == 1, $this->entidad->id, $this->semestre_id);
        } elseif ($codigo_inicial === "IND-050") {
            $res = Medicion::ind50($this->tipo == 1, $this->entidad->id, $this->semestre_nombre, $this->semestre_id, $this->tipo == 1 ? $this->entidad->depto_id : null);
        } elseif ($codigo_inicial === "IND-051") {
            $res = Medicion::ind51($this->tipo == 1, $this->entidad->id, $this->semestre_nombre, $this->semestre_id);
        } elseif ($codigo_inicial === "IND-052") {
            $res = Medicion::ind52($this->tipo == 1, $this->entidad->id, $this->semestre_id);
        } // Investigacion: 044 - 047
        elseif ($codigo_inicial === "IND-044") {
            $res = Medicion::ind44($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin, $this->semestre_nombre, $this->tipo == 1 ? $this->entidad->depto_id : null);
        } elseif ($codigo_inicial === "IND-045") {
            $res = Medicion::ind45($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin, $this->semestre_nombre);
        } elseif ($codigo_inicial === "IND-046") {
            $res = Medicion::ind46($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin);
        } elseif ($codigo_inicial === "IND-047") {
            $res = Medicion::ind47($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin);
        } // Biblioteca: 09 - 015
        elseif ($codigo_inicial === "IND-009") {
            $res = Medicion::ind09($this->entidad->id, $this->inicio, $this->fin);
        } elseif ($codigo_inicial === "IND-010") {
            $res = Medicion::ind10($this->entidad->id, $this->inicio, $this->fin);
        } elseif ($codigo_inicial === "IND-011") {
            $res = Medicion::ind11($this->entidad->id, $this->inicio, $this->fin);
        } elseif ($codigo_inicial === "IND-012") {
            $res = Medicion::ind12($this->entidad->id, $this->inicio, $this->fin);
        } elseif ($codigo_inicial === "IND-013") {
            $res = Medicion::ind13($this->entidad->id, $this->inicio, $this->fin);
        } elseif ($codigo_inicial === "IND-014") {
            $res = Medicion::ind14($this->entidad->id, $this->inicio, $this->fin);
        } // Bachiller: 58
        elseif ($codigo_inicial === "IND-058") {
            $res = Medicion::ind58($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin);
        } // Titulo Profesional: 59
        elseif ($codigo_inicial === "IND-059") {
            $res = Medicion::ind59($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin);
        } elseif ($codigo_inicial === "IND-060") {
            $res = Medicion::ind60($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin);
        } elseif ($codigo_inicial === "IND-061") {
            $res = Medicion::ind61($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin);
        } // Gestion de Calidad
        elseif ($codigo_inicial === "IND-001") {
            $res = Medicion::ind01($this->entidad->id, $this->inicio, $this->fin);
        } elseif ($codigo_inicial === "IND-068") {
            $res = Medicion::ind68($this->entidad->id, $this->inicio, $this->fin);
        } elseif ($codigo_inicial === "IND-070") {
            $res = Medicion::ind70($this->entidad->id, $this->inicio, $this->fin);
        } // Convalidaciones
        elseif ($codigo_inicial === "IND-024") {
            $res = Medicion::ind24($this->entidad->id, $this->inicio, $this->fin);
        } elseif ($codigo_inicial === "IND-025") {
            $res = Medicion::ind25($this->entidad->id, $this->inicio, $this->fin);
        } elseif ($codigo_inicial === "IND-026") {
            $res = Medicion::ind26($this->entidad->id, $this->inicio, $this->fin);
        } // Enseñanza y Aprendizaje
        elseif ($codigo_inicial === "IND-032") {
            $res = Medicion::ind32($this->entidad->id, $this->semestre_nombre);
        } elseif ($codigo_inicial === "IND-035") {
            $res = Medicion::ind35($this->entidad->id, $this->semestre_nombre);
        } elseif ($codigo_inicial === "IND-036") {
            $res = Medicion::ind36($this->entidad->id, $this->semestre_nombre);
        } elseif ($codigo_inicial === "IND-037") {
            $res = Medicion::ind37($this->entidad->id, $this->semestre_nombre, $this->inicio, $this->fin);
        } elseif ($codigo_inicial === "IND-038") {
            $res = Medicion::ind38($this->entidad->id, $this->semestre_nombre);
        } // Tutoria y Consejeria
        elseif ($codigo_inicial === "IND-054") {
            $res = Medicion::ind54($this->entidad->depto_id, $this->semestre_nombre);
        } elseif ($codigo_inicial === "IND-055") {
            $res = Medicion::ind55($this->entidad->id, $this->semestre_nombre);
        } elseif ($codigo_inicial === "IND-056") {
            $res = Medicion::ind56($this->entidad->id, $this->semestre_nombre);
        } elseif ($codigo_inicial === "IND-057") {
            $res = Medicion::ind57($this->entidad->id, $this->semestre_nombre);
        } // Matricula
        elseif ($codigo_inicial === "IND-039") {
            $res = Medicion::ind39($this->entidad->id, $this->semestre_nombre);
        } elseif ($codigo_inicial === "IND-040") {
            $res = Medicion::ind40($this->entidad->id, $this->semestre_nombre);
        } elseif ($codigo_inicial === "IND-041") {
            $res = Medicion::ind41($this->entidad->id, $this->semestre_nombre);
        } elseif ($codigo_inicial === "IND-042") {
            $res = Medicion::ind42($this->entidad->id, $this->semestre_nombre);
        } elseif ($codigo_inicial === "IND-043") {
            $res = Medicion::ind43($this->entidad->id, $this->semestre_nombre);
        } // Docente
        elseif ($codigo_inicial === "IND-062") {
            $res = Medicion::ind62($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_nombre);
        } elseif ($codigo_inicial === "IND-063") {
            $res = Medicion::ind63($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_nombre);
        } elseif ($codigo_inicial === "IND-065") {
            $res = Medicion::ind65($this->tipo == 1, $this->tipo == 1 ? $this->entidad->depto_id : $this->entidad->id, $this->semestre_nombre);
        } elseif ($codigo_inicial === "IND-066") {
            $res = Medicion::ind66($this->tipo == 1, $this->entidad->id, $this->semestre_nombre);
        } elseif ($codigo_inicial === "IND-067") {
            $res = Medicion::ind67($this->tipo == 1, $this->entidad->id, $this->semestre_nombre);
        } elseif ($codigo_inicial === "IND-074") {
            $res = Medicion::ind74($this->tipo == 1, $this->entidad->id, $this->semestre_nombre);
        } elseif ($codigo_inicial === "IND-075") {
            $res = Medicion::ind75($this->tipo == 1, $this->entidad->id, $this->semestre_nombre);
        } elseif ($codigo_inicial === "IND-076") {
            $res = Medicion::ind76($this->tipo == 1, $this->entidad->id, $this->semestre_nombre);
        } elseif ($codigo_inicial === "IND-077") {
            $res = Medicion::ind77($this->tipo == 1, $this->entidad->id, $this->semestre_nombre);
        } elseif ($codigo_inicial === "IND-078") {
            $res = Medicion::ind78($this->tipo == 1, $this->entidad->id, $this->semestre_nombre);
        } // Bolsa
        elseif ($codigo_inicial === "IND-021") {
            $res = Medicion::ind21($this->entidad->id, $this->inicio, $this->fin);
        } // Convenio
        elseif ($codigo_inicial === "IND-027") {
            $res = Medicion::ind27($this->entidad->id, $this->semestre_id);
        } elseif ($codigo_inicial === "IND-028") {
            $res = Medicion::ind28($this->entidad->id, $this->semestre_id);
        } elseif ($codigo_inicial === "IND-029") {
            $res = Medicion::ind29($this->entidad->id, $this->semestre_id);
        } elseif ($codigo_inicial === "IND-030") {
            $res = Medicion::ind30($this->entidad->id, $this->semestre_id);
        }

        if (isset($res)) {
            $this->interes = $res['interes'];
            $this->total = $res['total'];
            $this->resultado = $res['resultado'];
        }
    }
}
