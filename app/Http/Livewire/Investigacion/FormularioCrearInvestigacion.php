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
use App\Models\Semestre;
use App\Models\SublineaInvestigacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class FormularioCrearInvestigacion extends Component
{
    public $escuelas = null, $areas = null, $lineas = null, $sublineas = null;
    public $titulo, $resumen, $escuela = 0, $area = 0, $linea = 0, $sublinea = 0;
    public $semestres = null, $semestre = 1;

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

        $this->semestres = Semestre::query()->orderBy('nombre', 'desc')->get();
        $this->semestre = $this->semestres->where('activo', true)->first()->id;
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
        try {
            $investigacion = Investigacion::create([
                'uuid' => Str::uuid(),
                'titulo' => $this->titulo,
                'resumen' => $this->resumen,
                'fecha_publicacion' => null,
                'semestre_id' => $this->semestre,
                'escuela_id' => $this->escuela,
                'sublinea_id' => $this->sublinea,
                'estado_id' => 1, // Tabla Estados -> 1:En ejecuci??n
            ]);

            $investigador = Investigador::query()->where('dni_investigador', Auth::user()->persona->dni)->first();

            if (!$investigador) {
                $investigador = Investigador::create([
                    'es_docente' => !Auth::user()->hasRole('Estudiante'),
                    'dni_investigador' => Auth::user()->persona->dni
                ]);
            }

            InvestigacionInvestigador::create([
                'es_responsable' => true,
                'investigacion_id' => $investigacion->id,
                'investigador_id' => $investigador->id
            ]);

            $msg = "La investigaci??n llamada '" . $this->titulo . "' fue creado con ??xito.";
            $this->emit('guardado', ['titulo' => 'Investigaci??n creado', 'mensaje' => $msg]);
            return redirect()->route('investigacion.index');
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado: \n" . $e);
        }
    }
}
