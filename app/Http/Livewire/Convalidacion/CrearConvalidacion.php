<?php

namespace App\Http\Livewire\Convalidacion;

use App\Models\Convalidacion;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Semestre;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CrearConvalidacion extends Component
{
    public $semestres = null, $semestre = 0;
    public $escuelas = null, $escuela = 0;
    public $facultades = null, $facultad = 0;

    public $vacantes, $postulantes, $convalidados;

    public $escuelas_id = [], $facultades_id = [];


    protected $rules = [
        'vacantes' => 'required|gte:0',
        'postulantes' => 'required|gte:0',
        'convalidados' => 'required|gte:0',
    ];

    public function mount()
    {
        $this->facultades_id = User::facultades_id(Auth::user()->id);
        $this->escuelas_id = User::escuelas_id(Auth::user()->id);

        if (count($this->escuelas_id) > 0) {
            $this->escuelas = Escuela::query()->orderBy('nombre')
                ->whereIn('id', $this->escuelas_id)->get();
            $this->escuela = $this->escuelas->first()->id;
        } elseif (count($this->facultades_id) > 0) {
            $this->facultades = Facultad::query()->orderBy('nombre')
                ->whereIn('id', $this->facultades_id)->get();
            $this->facultad = $this->facultades->first()->id;

            $this->escuelas = Escuela::query()->orderBy('nombre')
                ->where('facultad_id', $this->facultad)->get();
            $this->escuela = $this->escuelas->first()->id;
        } else {
            abort(403, 'No tienes los permisos para estar en esta página');
        }

        $this->semestres = Semestre::orderBy('nombre', 'desc')->get();
        $this->semestre = $this->semestres->where('activo', true)->first()->id;
    }

    public function registrar()
    {
        $this->validate();
        try {
            $convalidaciones = Convalidacion::query()
                ->where('escuela_id', $this->escuela)
                ->where('semestre_id', $this->semestre)
                ->get();

            if (count($convalidaciones) < 1) {
                Convalidacion::create([
                    'vacantes' => $this->vacantes,
                    'postulantes' => $this->postulantes,
                    'convalidados' => $this->convalidados,
                    'semestre_id' => $this->semestre,
                    'escuela_id' => $this->escuela
                ]);
                $this->reset(['vacantes', 'postulantes', 'convalidados']);

                $msg = 'La información de Convalidacion se registró correctamente.';
                $this->emit('guardado', ['titulo' => 'Convalidación agregado', 'mensaje' => $msg]);
                return redirect()->route('convalidacion.index');
            } else {
                $this->emit('error', 'Ya se registraron las convalidaciones en este ciclo.');
            }
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado: \n" . $e);
        }
    }

    public function render()
    {
        return view('livewire.convalidacion.crear-convalidacion');
    }
}
