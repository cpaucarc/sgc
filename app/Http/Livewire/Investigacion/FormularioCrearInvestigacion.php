<?php

namespace App\Http\Livewire\Investigacion;

use App\Lib\UsuarioHelper;
use App\Models\AreaInvestigacion;
use App\Models\Entidadable;
use App\Models\Escuela;
use App\Models\Investigacion;
use App\Models\InvestigacionInvestigador;
use App\Models\Investigador;
use App\Models\LineaInvestigacion;
use App\Models\SublineaInvestigacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class FormularioCrearInvestigacion extends Component
{
    public $escuelas = null, $areas = null, $lineas = null, $sublineas = null;
    public $titulo, $resumen, $escuela = 0, $area = 0, $linea = 0, $sublinea = 0;

    protected $rules = [
        'titulo' => 'required|string|max:250',
        'resumen' => 'required|string|max:1000',
        'escuela' => 'required|integer|gt:0',
        'area' => 'required|integer|gt:0',
        'linea' => 'required|integer|gt:0',
        'sublinea' => 'required|integer|gt:0',
    ];

    public function mount()
    {
        $this->escuelas = UsuarioHelper::escuelasDelUsuario();

        // Si hay solo una escuela, asignar como la escuela por defecto
        if (count($this->escuelas) === 1) {
            $this->escuela = $this->escuelas->first()->id;
        }

        $this->areas = AreaInvestigacion::query()
            ->whereIn('facultad_id', function ($query) {
                $query->select('facultad_id')->from('escuelas')->whereIn('id', $this->escuelas->pluck('id'));
            })
            ->get();

    }

    public function render()
    {
        return view('livewire.investigacion.formulario-crear-investigacion');
    }

    public function updatedArea()
    {
        if (intval($this->area) === 0) {
            $this->lineas = null;
        } else {
            $this->lineas = LineaInvestigacion::query()->where('area_id', $this->area)->get();
        }
    }

    public function updatedLinea()
    {
        if (intval($this->linea) === 0) {
            $this->sublineas = null;
        } else {
            $this->sublineas = SublineaInvestigacion::query()->where('linea_id', $this->linea)->get();
        }
    }

    public function guardar()
    {
        $this->validate();

        $investigacion = Investigacion::create([
            'uuid' => Str::uuid(),
            'titulo' => $this->titulo,
            'resumen' => $this->resumen,
            'fecha_publicacion' => null,
            'escuela_id' => $this->escuela,
            'sublinea_id' => $this->sublinea,
            'estado_id' => 1, // Tabla Estados -> 1:En ejecución
        ]);

        $investigador = Investigador::query()->where('dni_investigador', Auth::user()->dni)->first();

        if (!$investigador) {
            $investigador = Investigador::create([
                'es_docente' => !Auth::user()->hasRole('Estudiante'),
                'dni_investigador' => Auth::user()->dni
            ]);
        }

        InvestigacionInvestigador::create([
            'es_responsable' => true,
            'investigacion_id' => $investigacion->id,
            'investigador_id' => $investigador->id
        ]);

        $this->emit('guardado', "La Investigación llamada '" . $this->titulo . "' fue creado con éxito.");

        return redirect()->route('investigacion.index');
    }
}
