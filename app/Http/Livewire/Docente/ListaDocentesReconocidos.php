<?php

namespace App\Http\Livewire\Docente;

use App\Lib\UsuarioHelper;
use App\Models\Departamento;
use App\Models\Docente;
use App\Models\DocenteReconocido;
use App\Models\Semestre;
use Livewire\Component;

class ListaDocentesReconocidos extends Component
{
    public $semestres, $semestre, $semestre_activo, $depto;
    public $reconocidoss = null, $reconocido, $inicio, $fin;

    protected $listeners = ['agregarReconocimiento', 'quitarReconocimiento'];

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
            ->addSelect(['reconocido_id' => DocenteReconocido::select('id')
                ->whereColumn('docente_id', 'docentes.id')
                ->where('departamento_id', $this->depto->id)
                ->take(1)
            ])
            ->with('persona:id,apellido_paterno,apellido_materno,nombres,dni')
            ->whereIn('id', function ($query) {
                $query->select('docente_id')->from('docente_semestre')->where('semestre_id', $this->semestre)->where('departamento_id', $this->depto->id);
            })->get();

        return view('livewire.docente.lista-docentes-reconocidos', compact('docentes'));
    }

    public function agregarReconocimiento($docente_id)
    {
        DocenteReconocido::create([
            'docente_id' => $docente_id,
            'reconocido' => true,
            'departamento_id' => $this->depto->id,
            'semestre_id' => $this->semestre,
        ]);
    }

    public function quitarReconocimiento($reconocido_id)
    {
        DocenteReconocido::find($reconocido_id)->delete();
    }
}
