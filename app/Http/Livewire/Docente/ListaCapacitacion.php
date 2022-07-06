<?php

namespace App\Http\Livewire\Docente;

use App\Lib\UsuarioHelper;
use App\Models\Capacitacion;
use App\Models\Departamento;
use Livewire\Component;

class ListaCapacitacion extends Component
{
    public $departamentos=null;
    protected $listeners = [
        "guardarInformacion" => "render"
    ];

    public function mount()
    {
        $this->departamentos = Departamento::query()
            ->with('facultad')
            ->where('id', UsuarioHelper::escuelasDelUsuario()->pluck('depto_id')[0])
            ->first();
    }

    public function render()
    {
        $capacitaciones = Capacitacion::query()->where('departamento_id',$this->departamentos->id)->get();
        return view('livewire.docente.lista-capacitacion', compact('capacitaciones'));
    }
}
