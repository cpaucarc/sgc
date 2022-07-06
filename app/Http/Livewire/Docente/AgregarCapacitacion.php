<?php

namespace App\Http\Livewire\Docente;

use App\Lib\UsuarioHelper;
use App\Models\Capacitacion;
use App\Models\Departamento;
use App\Models\Semestre;
use Illuminate\Support\Str;
use Livewire\Component;

class AgregarCapacitacion extends Component
{
    public $depto = null, $departamento = 0;
    public $semestres = null, $semestre = 0;
    public $nombre;

    public $open = false;


    protected $rules = [
        'nombre' => 'required'
    ];

    public function mount()
    {
        $this->depto = Departamento::query()
            ->where('id', UsuarioHelper::escuelasDelUsuario()->pluck('depto_id')[0])
            ->first();
        $this->departamento = $this->depto->id;

        $this->semestres = Semestre::query()->orderBy('nombre', 'desc')->get();
        $this->semestre = $this->semestres->where('activo', true)->first()->id;

    }

    public function render()
    {
        return view('livewire.docente.agregar-capacitacion');
    }

    public function abrirModal()
    {
        $this->open = true;
    }

    public function guardar()
    {
        $this->validate();
        Capacitacion::create([
            'uuid' => Str::uuid(),
            'nombre' => $this->nombre,
            'departamento_id' => $this->departamento,
            'semestre_id' => $this->semestre
        ]);
        $this->reset('nombre','open');
        $this->emitTo('docente.lista-capacitacion', "guardarInformacion");
    }
}
