<?php

namespace App\Http\Livewire\Docente;

use App\Lib\UsuarioHelper;
use App\Models\Capacitacion;
use App\Models\CapacitacionDocente;
use App\Models\Departamento;
use App\Models\Docente;
use App\Models\Semestre;
use Livewire\Component;

class ListaDocentesCapacitados extends Component
{
    public $semestres, $semestre, $semestre_activo, $depto;
    public $capacitaciones = null, $capacitacion, $inicio, $fin;

    protected $listeners = ['agregarParticipacion', 'quitarParticipacion'];

    public function mount()
    {
        $this->semestres = Semestre::query()->orderBy('nombre', 'desc')->get();
        $this->semestre = $this->semestres->where('activo', true)->first()->id;
        $this->semestre_activo = $this->semestre;

        // TODO: reemplazar por deptosDelUsuario() [si no existe, crearlo]
        $this->depto = Departamento::query()
            ->with('facultad')
            ->where('id', UsuarioHelper::escuelasDelUsuario()->pluck('depto_id')[0])
            ->first();

        $this->obtenerCapacitaciones();
    }

    public function render()
    {
        $docentes = Docente::query()
            ->select('id', 'persona_id')
            ->addSelect(['participa_id' => CapacitacionDocente::select('id')
                ->whereColumn('docente_id', 'docentes.id')
                ->where('capacitacion_id', $this->capacitacion)
                ->where('departamento_id', $this->depto->id)
                ->take(1)
            ])
            ->with('persona:id,apellido_paterno,apellido_materno,nombres,dni')
            ->whereIn('id', function ($query) {
                $query->select('docente_id')->from('docente_semestre')->where('semestre_id', $this->semestre)->where('departamento_id', $this->depto->id);
            })->get();

        return view('livewire.docente.lista-docentes-capacitados', compact('docentes'));
    }

    public function updatedSemestre()
    {
        $this->obtenerCapacitaciones();
    }

    public function obtenerCapacitaciones()
    {
        $this->capacitaciones = Capacitacion::query()->where('departamento_id', $this->depto->id)->where('semestre_id', $this->semestre)->get();

        if (count($this->capacitaciones)) {
            $this->capacitacion = $this->capacitaciones->first()->id;
            $this->inicio = $this->capacitaciones->first()->fecha_inicio;
            $this->fin = $this->capacitaciones->first()->fecha_fin;
        }
    }

    public function updatedCapacitacion($id)
    {
        $this->capacitacion = $this->capacitaciones->where('id', $id)->first()->id;
        $this->inicio = $this->capacitaciones->where('id', $id)->first()->fecha_inicio;
        $this->fin = $this->capacitaciones->where('id', $id)->first()->fecha_fin;
    }

    public function agregarParticipacion($docente_id)
    {
        CapacitacionDocente::create([
            'capacitacion_id' => $this->capacitacion,
            'docente_id' => $docente_id,
            'participa' => true,
            'departamento_id' => $this->depto->id,
        ]);
    }

    public function quitarParticipacion($participacion_id)
    {
        CapacitacionDocente::find($participacion_id)->delete();
    }

}
