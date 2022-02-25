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
use Livewire\Component;

class NuevoAnalisis extends Component
{
    public $open = false;
    public $tipo;
    public $indicadorable, $entidad, $type;
    public $min, $sat, $sob;
    public $inicio, $fin, $diffInDays, $diffIsOk = true;
    public $interes = null, $total = null, $resultado = null;
    public $elaborado, $revisado, $aprobado;
    public $analisis, $observacion;
    public $guardar = false; //Checkbox para saber si se va a guardar nuevos rangos de medida

    protected $listeners = ['openModal'];

    protected $rules = [
        'min' => 'required',
        'sat' => 'required|gte:min',
        'sob' => 'required|gte:sat',
        'resultado' => 'required',
    ];

    public function mount($indicadorable_id, $tipo, $uuid)
    {
        $this->tipo = $tipo;
        $this->indicadorable = Indicadorable::query()
            ->with('indicador', 'indicador.medicion')
            ->findOrFail($indicadorable_id);

        $this->categorizarPorTipo($tipo, $uuid);

        $this->min = $this->indicadorable->indicador->minimo;
        $this->sat = $this->indicadorable->indicador->satisfactorio;
        $this->sob = $this->indicadorable->indicador->sobresaliente;

        $this->elaborado = Auth::user()->name;

        $this->fechasPorDefecto($this->indicadorable->indicador->medicion->nombre);
    }

    public function render()
    {
        $this->obtenerResultados();

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
        if (strcmp($frecuencia, "semestral") === 0) {
            $this->inicio = Carbon::now()->subMonths(5)->startOfMonth()->format('Y-m-d');
        } elseif (strcmp($frecuencia, "mensual") === 0) {
            $this->inicio = Carbon::now()->startOfMonth()->format('Y-m-d');
        } elseif (strcmp($frecuencia, "anual") === 0) {
            $this->inicio = Carbon::now()->subYear()->startOfYear()->format('Y-m-d');
        }
        $this->fin = Carbon::now()->format('Y-m-d');

        $this->comprobarFechas();
    }

    public function comprobarFechas()
    {
        $this->diffInDays = Carbon::parse($this->fin)->diffInDays($this->inicio);
        $frecuenciaEnDias = $this->indicadorable->indicador->medicion->tiempo_meses * 30;

        if ($frecuenciaEnDias === 180) { //Semestral
            $this->diffIsOk = !($this->diffInDays > 184 || $this->diffInDays < 150);
        } elseif ($frecuenciaEnDias === 30) { //Mensual
            $this->diffIsOk = !($this->diffInDays > 31 || $this->diffInDays < 20);
        } elseif ($frecuenciaEnDias === 360) { //Anual
            $this->diffIsOk = !($this->diffInDays > 366 || $this->diffInDays < 330);
        }
    }

    public function guardarAnalisis()
    {
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
        if ($this->indicadorable->indicador->cod_ind_inicial === "IND-048") {
            $res = Medicion::ind48($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin);
        } elseif ($this->indicadorable->indicador->cod_ind_inicial === "IND-049") {
            $res = Medicion::ind49($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin);
        } elseif ($this->indicadorable->indicador->cod_ind_inicial === "IND-050") {
            $res = Medicion::ind50($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin);
        } elseif ($this->indicadorable->indicador->cod_ind_inicial === "IND-051") {
            $res = Medicion::ind51($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin);
        } elseif ($this->indicadorable->indicador->cod_ind_inicial === "IND-052") {
            $res = Medicion::ind52($this->tipo == 1, $this->entidad->id, $this->inicio, $this->fin);
        }


        $this->interes = $res['interes'];
        $this->total = $res['total'];
        $this->resultado = $res['resultado'];
    }
}