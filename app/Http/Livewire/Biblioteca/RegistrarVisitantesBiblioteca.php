<?php

namespace App\Http\Livewire\Biblioteca;

use App\Models\BibliotecaVisitante;
use App\Models\Entidadable;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Semestre;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegistrarVisitantesBiblioteca extends Component
{
    public $escuelas_id = [], $facultades_id = [];
    public $facultades = null, $facultad = 0;
    public $escuelas = null, $escuela = 0;
    public $semestres = null, $semestre = 0;
    public $inicio, $fin, $visitantes;

    protected $rules = [
        'escuela' => 'required|gt:0',
        'semestre' => 'required|gt:0',
        'inicio' => 'required|date|before:fin',
        'fin' => 'required|date|after:inicio',
        'visitantes' => 'required|integer',
    ];

    public function mount()
    {
        $callback = function ($query) {
            $query->whereIn('id', Auth::user()->entidades->pluck('id'));
        };

        $this->escuelas_id = Entidadable::query()
            ->where('entidadable_type', "App\\Models\\Escuela")
            ->whereHas('entidad', $callback)
            ->pluck('entidadable_id');

        $this->facultades_id = Entidadable::query()
            ->where('entidadable_type', "App\\Models\\Facultad")
            ->whereHas('entidad', $callback)
            ->pluck('entidadable_id');

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

        $this->semestres = Semestre::orderByDesc('nombre')->get();
        $this->semestre = $this->semestres->firstWhere('activo', true)->id;

        $this->inicio = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->fin = Carbon::now()->endOfMonth()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.biblioteca.registrar-visitantes-biblioteca');
    }

    /* Funciones */
    public function registrar()
    {
        $this->validate();
        try {
            BibliotecaVisitante::create([
                'fecha_inicio' => $this->inicio,
                'fecha_fin' => $this->fin,
                'visitantes' => $this->visitantes,
                'semestre_id' => $this->semestre,
                'escuela_id' => $this->escuela
            ]);

            $msg = 'El número de Visitas a la Biblioteca fue agregado correctamente';
            $this->emit('guardado', ['titulo' => 'Número de Visitas a la Biblioteca agregado', 'mensaje' => $msg]);
            return redirect()->route('biblioteca.visitante');
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado: \n" . $e);

        }
    }
}
