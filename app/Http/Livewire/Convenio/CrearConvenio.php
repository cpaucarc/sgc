<?php

namespace App\Http\Livewire\Convenio;

use App\Models\Convenio;
use App\Models\Facultad;
use App\Models\Semestre;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CrearConvenio extends Component
{

    public $semestres = null, $semestre = 0;
    public $facultades = null, $facultad = 0;

    public $realizados, $vigentes, $culminados;

    public $facultades_id = [];


    protected $rules = [
        'realizados' => 'required|gte:0',
        'vigentes' => 'required|gte:0',
        'culminados' => 'required|gte:0',
    ];

    public function mount()
    {
        $this->facultades_id = User::facultades_id(Auth::user()->id);
        if (count($this->facultades_id) < 1) {
            abort(403, 'No tienes los permisos para estar en esta página');
        } else {
            $this->facultades = Facultad::findOrFail($this->facultades_id);
            $this->facultad = $this->facultades->first()->id;
        }

        $this->semestres = Semestre::orderBy('nombre', 'desc')->get();
        $this->semestre = $this->semestres->first()->id;
    }

    public function registrar()
    {
        $this->validate();

        $convenios = Convenio::query()
            ->where('facultad_id', $this->facultad)
            ->where('semestre_id', $this->semestre)
            ->get();

        if (count($convenios) < 1) {
            Convenio::create([
                'realizados' => $this->realizados,
                'vigentes' => $this->vigentes,
                'culminados' => $this->culminados,
                'semestre_id' => $this->semestre,
                'facultad_id' => $this->facultad
            ]);
            $this->reset(['realizados', 'vigentes', 'culminados']);
            $this->emit('guardado', 'Se registro la información de convenios correctamente.');
            return redirect()->route('convenio.index');
        } else {
            $this->emit('error', 'Ya se registró la información de convenios en este ciclo.');
        }
    }

    public function render()
    {
        return view('livewire.convenio.crear-convenio');
    }
}
