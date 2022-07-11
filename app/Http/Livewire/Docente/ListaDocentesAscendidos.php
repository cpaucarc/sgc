<?php

namespace App\Http\Livewire\Docente;

use App\Lib\UsuarioHelper;
use App\Models\Departamento;
use App\Models\Docente;
use App\Models\DocenteAscendido;
use App\Models\Semestre;
use Livewire\Component;

class ListaDocentesAscendidos extends Component
{
    public $semestres, $semestre, $semestre_activo, $depto;
    public $reconocidoss = null, $reconocido, $inicio, $fin;

    protected $listeners = ['agregarAscendido', 'quitarAscendido'];

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
    }

    public function render()
    {
        $docentes = Docente::query()
            ->select('id', 'persona_id')
            ->addSelect(['ascendido_id' => DocenteAscendido::select('id')
                ->whereColumn('docente_id', 'docentes.id')
                ->where('departamento_id', $this->depto->id)
                ->take(1)
            ])
            ->with('persona:id,apellido_paterno,apellido_materno,nombres,dni')
            ->whereIn('id', function ($query) {
                $query->select('docente_id')->from('docente_semestre')->where('semestre_id', $this->semestre)->where('departamento_id', $this->depto->id);
            })->get();
        return view('livewire.docente.lista-docentes-ascendidos', compact('docentes'));
    }

    public function agregarAscendido($docente_id)
    {
        DocenteAscendido::create([
            'docente_id' => $docente_id,
            'ascendido' => true,
            'departamento_id' => $this->depto->id,
            'semestre_id' => $this->semestre,
        ]);
    }

    public function quitarAscendido($ascendido_id)
    {
        DocenteAscendido::find($ascendido_id)->delete();
    }
}
