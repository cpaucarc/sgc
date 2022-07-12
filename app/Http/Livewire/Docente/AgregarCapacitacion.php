<?php

namespace App\Http\Livewire\Docente;

use App\Lib\UsuarioHelper;
use App\Models\Capacitacion;
use App\Models\Departamento;
use App\Models\Semestre;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;

class AgregarCapacitacion extends Component
{
    public $depto = null, $departamento = 0;
    public $semestres = null, $semestre = 0;
    public $nombre, $inicio, $fin;

    public $open = false;


    protected $rules = [
        'inicio' => 'required|date|before:fin',
        'fin' => 'required|date|after:inicio',
        'nombre' => 'required'
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

        $this->inicio = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->fin = Carbon::now()->endOfMonth()->format('Y-m-d');
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
            'fecha_inicio' => $this->inicio,
            'fecha_fin' => $this->fin,
            'departamento_id' => $this->departamento,
            'semestre_id' => $this->semestre
        ]);
        $this->reset('nombre', 'open');
        $this->emitTo('docente.lista-capacitacion', "guardarInformacion");
    }
}
