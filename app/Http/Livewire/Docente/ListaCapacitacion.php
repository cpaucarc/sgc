<?php

namespace App\Http\Livewire\Docente;

use App\Lib\UsuarioHelper;
use App\Models\Capacitacion;
use App\Models\Departamento;
use App\Models\Semestre;
use Livewire\Component;

class ListaCapacitacion extends Component
{
    public $depto = null;
    public $semestres = null, $semestre = 0;

    protected $listeners = [
        "guardarInformacion" => "render", "eliminar"
    ];

    public function mount()
    {
        $this->depto = Departamento::query()
            ->with('facultad')
            ->where('id', UsuarioHelper::escuelasDelUsuario()->pluck('depto_id')[0])
            ->first();
        $this->semestres = Semestre::query()->orderBy('nombre', 'desc')->get();
    }

    public function render()
    {
        $capacitaciones = Capacitacion::query()
            ->with('departamento', 'semestre')
            ->where('departamento_id', $this->depto->id);
        if ($this->semestre > 0) {
            $capacitaciones = $capacitaciones->where('semestre_id', $this->semestre);
        }
        $capacitaciones = $capacitaciones->paginate(15);

        return view('livewire.docente.lista-capacitacion', compact('capacitaciones'));
    }

    public function eliminar($id)
    {
        $dependientes = Capacitacion::query()
            ->whereIn('id', function ($query) use ($id) {
                $query->select('capacitacion_id')->from('capacitacion_docente')
                    ->where('capacitacion_id', $id);
            })->count();

        if ($dependientes > 0) {
            $this->emit('error', 'No es posible eliminar este proceso porque está asociado a una activiad o un módulo.');
        } else {
            Capacitacion::find($id)->delete();
        }
    }
}
