<?php

namespace App\Http\Livewire\Docente;

use App\Lib\UsuarioHelper;
use App\Models\DemandaAdministrativo;
use App\Models\Departamento;
use App\Models\Semestre;
use Livewire\Component;

class ListaDemandaAdministrativos extends Component
{
    public $semestres, $semestre, $depto;

    protected $listeners = [
        "guardarInformacion" => "render", "eliminar"
    ];

    public function mount()
    {
        $this->semestres = Semestre::query()->orderBy('nombre', 'desc')->get();

        // TODO: reemplazar por deptosDelUsuario() [si no existe, crearlo]
        $this->depto = Departamento::query()
            ->with('facultad')
            ->where('id', UsuarioHelper::escuelasDelUsuario()->pluck('depto_id')[0])
            ->first();
    }

    public function render()
    {

        $demanda_administrativos = DemandaAdministrativo::query()
            ->with('departamento', 'semestre')
            ->where('departamento_id', $this->depto->id);

        if ($this->semestre > 0) {
            $demanda_administrativos = $demanda_administrativos->where('semestre_id', $this->semestre);
        }
        $demanda_administrativos = $demanda_administrativos->paginate(15);

        return view('livewire.docente.lista-demanda-administrativos', compact('demanda_administrativos'));
    }
}
