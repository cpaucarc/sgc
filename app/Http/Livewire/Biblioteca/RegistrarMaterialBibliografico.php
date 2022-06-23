<?php

namespace App\Http\Livewire\Biblioteca;

use App\Models\Entidadable;
use App\Models\Facultad;
use App\Models\MaterialBibliografico;
use App\Models\Semestre;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegistrarMaterialBibliografico extends Component
{

    public $inicio, $fin;
    public $adquirido, $prestado, $perdido, $restaurado, $total;
    public $semestre = 0, $semestres = null;
    public $ultimo_registro = null;
    public $facultad = 0, $facultades = null;

    protected $rules = [
        'inicio' => 'required|date|before:fin',
        'fin' => 'required|date|after:inicio',
        'adquirido' => 'required|integer',
        'prestado' => 'required|integer',
        'perdido' => 'required|integer',
        'restaurado' => 'required|integer',
        'total' => 'required|integer',
        'facultad' => 'required|gt:0',
        'semestre' => 'required|gt:0',
    ];

    public function mount()
    {
        $callback = function ($query) {
            $query->whereIn('id', Auth::user()->entidades->pluck('id'));
        };

        $facultad_ids = Entidadable::query()
            ->where('entidadable_type', "App\\Models\\Facultad")
            ->whereHas('entidad', $callback)
            ->pluck('entidadable_id');

        if (count($facultad_ids) < 1) {
            abort(403, 'No tienes los permisos para estar en esta página');
        } else {
            $this->facultades = Facultad::findOrFail($facultad_ids);
        }

        $this->facultad = $this->facultades->first()->id;

        $this->updatedFacultad($this->facultad);

        $this->semestres = Semestre::query()->orderBy('nombre', 'desc')->get();
        $this->semestre=$this->semestres->where('activo',true)->first()->id;

        $this->inicio = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->fin = Carbon::now()->endOfMonth()->format('Y-m-d');
    }

    public function updatedFacultad($value)
    {
        if ($value > 0) {
            $this->ultimo_registro = MaterialBibliografico::query()
                ->where('facultad_id', $this->facultad)
                ->orderBy('id', 'desc')
                ->first();
        } else {
            $this->ultimo_registro = null;
        }
    }

    public function render()
    {
        return view('livewire.biblioteca.registrar-material-bibliografico');
    }

    /* Funciones */
    public function registrar()
    {
        $this->validate();

        MaterialBibliografico::create([
            'fecha_inicio' => $this->inicio,
            'fecha_fin' => $this->fin,
            'adquirido' => $this->adquirido,
            'prestado' => $this->prestado,
            'perdido' => $this->perdido,
            'restaurados' => $this->restaurado,
            'total_libros' => $this->total,
            'semestre_id' => $this->semestre,
            'facultad_id' => $this->facultad
        ]);

        return redirect()->route('biblioteca.index');
    }
}
