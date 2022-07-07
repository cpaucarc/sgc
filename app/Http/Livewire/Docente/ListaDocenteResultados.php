<?php

namespace App\Http\Livewire\Docente;

use App\Lib\UsuarioHelper;
use App\Models\Departamento;
use App\Models\Docente;
use App\Models\DocenteSemestre;
use App\Models\Persona;
use App\Models\Semestre;
use Livewire\Component;

class ListaDocenteResultados extends Component
{
    public $depto;
    public $semestres = null;
    public $semestre, $semestre_activo;
    public $search = "";

    protected $listeners = ['cumplimiento40h', 'cumplimientoLabores'];

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
        $docentes_semestre = DocenteSemestre::query()
            ->with('docente', 'docente.persona', 'semestre')
            ->where('semestre_id', $this->semestre)
            ->where('departamento_id', $this->depto->id)
            ->get();

        return view('livewire.docente.lista-docente-resultados', compact('docentes_semestre'));
    }

    public function cumplimiento40h($docente_semestre_id, $cumplio)
    {
        $ds = DocenteSemestre::find($docente_semestre_id);
        $ds->cumplio_40h = $cumplio;
        $ds->save();
    }

    public function cumplimientoLabores($docente_semestre_id, $cumplio)
    {
        $ds = DocenteSemestre::find($docente_semestre_id);
        $ds->cumplio_labores = $cumplio;
        $ds->save();
    }
}
