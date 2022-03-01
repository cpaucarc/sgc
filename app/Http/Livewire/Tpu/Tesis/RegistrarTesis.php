<?php

namespace App\Http\Livewire\Tpu\Tesis;

use App\Models\Entidadable;
use App\Models\Escuela;
use App\Models\Estado;
use App\Models\Jurado;
use App\Models\JuradoSustentacion;
use App\Models\Sustentacion;
use App\Models\Tesis;
use App\Models\TipoTesis;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegistrarTesis extends Component
{
    protected $listeners = ['enviarJurado' => 'recibirJurado'];

    public $solicitud = null;
    public $tipoTesis = null;
    public $tipoTesisSeleccionado = 0;
    public $estados = null;
    public $estadoSustentacion = 0;

    public $numeroRegistro = null;
    public $titulo = null;
    public $anio = null;
    public $fechaSustentacion = null;

    public $entidad_escuela = 0;

    public $docente = [];
    public $countCJ = 0;

    protected $rules = [
        'numeroRegistro' => 'required',
        'titulo' => 'required',
        'tipoTesisSeleccionado' => 'required|integer|gt:0',
        'anio' => 'required',
        'fechaSustentacion' => 'required|date',
        'estadoSustentacion' => 'required|integer|gt:0',
    ];


    public function mount()
    {
        $this->tipoTesis = TipoTesis::all();
        $this->estados = Estado::query()
            ->where('categoria_id', 4)
            ->orderBy('id', 'desc')
            ->get();

        $entidades = Auth::user()->entidades->pluck('id');

        $callback = function ($query) use ($entidades) {
            $query->whereIn('id', $entidades);
        };

        $this->entidad_escuela = Entidadable::query()
            ->where('entidadable_type', "App\\Models\\Escuela")
            ->whereHas('entidad', $callback)
            ->pluck('entidadable_id');

        /*if (count($entidad_escuela)) {
            $this->escuelas = Escuela::whereIn('id', $entidad_escuela)
                ->orderBy('nombre')->get();
        }*/
    }

    /* Funciones */

    public function quitar($i)
    {
        unset($this->docente[$i]);
    }

    public function recibirJurado($docente_id, $codigo_docente)
    {
        if (count($this->docente) < 3) {
            array_push($this->docente, ['docente_id' => $docente_id, 'codigo_docente' => $codigo_docente]);
        }
    }

    public function guardarTesis()
    {
        $this->validate();

        if (count($this->docente) == 3) {
            $tesis = Tesis::create([
                'numero_registro' => $this->numeroRegistro,
                'titulo' => $this->titulo,
                'anio' => $this->anio,
                'codigo_estudiante' => $this->solicitud->codigo_estudiante,
                'escuela_id' => $this->entidad_escuela[0],
                'asesor_id' => $this->docente[2]['docente_id'],
                'tipo_tesis_id' => $this->tipoTesisSeleccionado
            ]);

            $sustentacion = Sustentacion::create([
                'fecha_sustentacion' => $this->fechaSustentacion,
                'tesis_id' => $tesis->id,
                'estado_id' => $this->estadoSustentacion,
            ]);

            foreach ($this->docente as $doc) {
                $this->countCJ++;
                JuradoSustentacion::create([
                    'sustentacion_id' => $sustentacion->id,
                    'jurado_id' => $doc['docente_id'],
                    'cargo_jurado_id' => $this->countCJ
                ]);
            }
            $this->emit('guardado', "La tesis con código '$tesis->numero_registro' fue creado con éxito. Puede volver a requisitos y teminar el proceso.");
        } else {
            $this->emit('guardado', "Lo sentimos hubo algunos problemas.");
        }

        $this->docente = [];
        $this->countCJ = 0;
        $this->reset(['numeroRegistro', 'titulo', 'tipoTesisSeleccionado', 'anio', 'fechaSustentacion', 'estadoSustentacion']);

        $this->emitTo('Tpu.Solicitud.EnviarRequisito', 'tesisRegistrado');
    }

    public function render()
    {
        return view('livewire.tpu.tesis.registrar-tesis');
    }
}
