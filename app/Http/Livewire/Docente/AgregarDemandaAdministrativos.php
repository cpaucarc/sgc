<?php

namespace App\Http\Livewire\Docente;

use App\Lib\UsuarioHelper;
use App\Models\CapacitacionDocente;
use App\Models\DemandaAdministrativo;
use App\Models\Departamento;
use App\Models\Docente;
use App\Models\Semestre;
use Carbon\Carbon;
use Livewire\Component;

class AgregarDemandaAdministrativos extends Component
{

    public $depto = null, $departamento = 0;
    public $semestres = null, $semestre = 0;
    public $numDocentes = 0, $numAdministrativos = 0;

    public $open = false;


    protected $rules = [
        'numDocentes' => 'required|not_in:0',
        'numAdministrativos' => 'required|not_in:0',
    ];

    public function mount()
    {
        $this->depto = Departamento::query()
            ->with('facultad')
            ->where('id', UsuarioHelper::escuelasDelUsuario()->pluck('depto_id')[0])
            ->first();

        $this->departamento = $this->depto->id;

        $this->semestres = Semestre::query()->orderBy('nombre', 'desc')->get();
        $this->semestre = $this->semestres->where('activo', true)->first()->id;

        $this->contarDocentes();
    }

    public function render()
    {
        return view('livewire.docente.agregar-demanda-administrativos');
    }

    public function updatedSemestre()
    {
        $this->contarDocentes();
    }

    public function updatedDepartamento()
    {
        $this->contarDocentes();
    }

    public function contarDocentes()
    {
        $this->numDocentes = Docente::query()
            ->select('id', 'persona_id')
            ->whereIn('id', function ($query) {
                $query->select('docente_id')->from('docente_semestre')->where('semestre_id', $this->semestre)->where('departamento_id', $this->departamento);
            })->count();
    }

    public function abrirModal()
    {
        $this->open = true;
    }

    public function guardar()
    {
        $this->validate();
        DemandaAdministrativo::create([
            'num_docentes' => $this->numDocentes,
            'num_administrativos' => $this->numAdministrativos,
            'departamento_id' => $this->departamento,
            'semestre_id' => $this->semestre
        ]);
        $this->reset('numAdministrativos', 'open');
        $this->emitTo('docente.lista-demanda-administrativos', "guardarInformacion");
    }
}
