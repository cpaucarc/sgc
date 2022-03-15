<?php

namespace App\Http\Livewire\Convenio;

use App\Models\Convenio;
use App\Models\Semestre;
use Livewire\Component;

class CrearConvenio extends Component
{

    public $semestres = null;
    public $semestreSeleccionado;

    public $realizados = null;
    public $vigentes = null;
    public $culminados = null;

    protected $rules = [
        'realizados' => 'required|gte:0',
        'vigentes' => 'required|gte:0',
        'culminados' => 'required|gte:0',
    ];

    public function mount()
    {
        $this->semestres = Semestre::orderBy('nombre', 'desc')->get();
        $this->semestreSeleccionado = $this->semestres->first()->id;
    }

    public function guardarConvenio()
    {
        $this->validate();
        $convenio = Convenio::query()
            ->where('semestre_id', $this->semestreSeleccionado)
            ->get();

        if (!count($convenio)) {
            Convenio::create([
                'realizados' => $this->realizados,
                'vigentes' => $this->vigentes,
                'culminados' => $this->culminados,
                'semestre_id' => $this->semestreSeleccionado,
            ]);
            $this->reset(['realizados', 'vigentes', 'culminados']);
            $this->semestreSeleccionado = $this->semestres->first()->id;

            $this->emit('guardado', 'Se registro los datos de convenio correctamente.');
            $this->emit('convenioCreado');
        } else {
            $this->emit('error', 'Ya se registraron los datos de convenio en este ciclo.');
        }

        $this->open = false;
    }

    public function render()
    {
        return view('livewire.convenio.crear-convenio');
    }
}
