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
    public $departamentos = null, $departamento = 0;
    public $semestres = null, $semestre = 0;
    public $nombre;

    protected $rules = [
        'nombre' => 'required'
    ];

    public function mount()
    {
        $this->departamentos = Departamento::query()
            ->where('id', UsuarioHelper::escuelasDelUsuario()->pluck('depto_id')[0])
            ->first();
        $this->departamento = $this->departamentos->id;

        $this->semestres = Semestre::query()->orderBy('nombre', 'desc')->get();
        $this->semestre = $this->semestres->where('activo', true)->first()->id;

    }

    public function render()
    {
        return view('livewire.docente.agregar-capacitacion');
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
        $this->reset('nombre');
        $this->emitTo('docente.lista-capacitacion', "guardarInformacion");
    }
}
