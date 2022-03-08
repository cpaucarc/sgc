<?php

namespace App\Http\Livewire\Convalidacion;

use App\Models\Convalidacion;
use App\Models\Escuela;
use App\Models\Semestre;
use Livewire\Component;

class CrearConvalidacion extends Component
{
    public $open = false;
    public $semestres = null;
    public $semestreSeleccionado;
    public $escuelas = null;
    public $escuelaSeleccionado;

    public $vacantes = null;
    public $postulantes = null;
    public $convalidados = null;

    protected $rules = [
        'vacantes' => 'required',
        'postulantes' => 'required',
        'convalidados' => 'required',
    ];

    public function mount()
    {
        $this->semestres = Semestre::orderBy('nombre', 'desc')->get();
        $this->semestreSeleccionado = $this->semestres->first()->id;
        $this->escuelas = Escuela::orderBy('nombre', 'desc')->get();
        $this->escuelaSeleccionado = $this->escuelas->first()->id;
    }

    public function guardarConvalidacion()
    {
        $this->validate();
        $convalidaciones = Convalidacion::query()
            ->where('escuela_id', $this->escuelaSeleccionado)
            ->where('semestre_id', $this->semestreSeleccionado)
            ->get();
        if (!count($convalidaciones)) {
            Convalidacion::create([
                'vacantes' => $this->vacantes,
                'postulantes' => $this->postulantes,
                'convalidados' => $this->convalidados,
                'semestre_id' => $this->semestreSeleccionado,
                'escuela_id' => $this->escuelaSeleccionado
            ]);
            $this->reset(['vacantes', 'postulantes', 'convalidados']);
            $this->emit('guardado', 'Se registro la convalidacion correctamente.');
            $this->emit('convalidacionCreado');
        } else {
            $this->emit('error', 'Ya se registraron las convalidaciones en este ciclo.');
        }

        $this->open = false;
    }

    public function render()
    {
        return view('livewire.convalidacion.crear-convalidacion');
    }
}
