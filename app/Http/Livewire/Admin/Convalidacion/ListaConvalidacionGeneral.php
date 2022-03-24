<?php

namespace App\Http\Livewire\Admin\Convalidacion;

use App\Models\Convalidacion;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Semestre;
use Livewire\Component;
use Livewire\WithPagination;

class ListaConvalidacionGeneral extends Component
{
    use WithPagination;

    public $facultades = null, $facultad = 0;
    public $escuelas = null, $escuela = 0;
    public $semestres = null, $semestre = 0;

    public function mount()
    {
        $this->facultades = Facultad::query()->select('id', 'nombre')->orderBy('nombre')->get();
        $this->semestres = Semestre::query()->select('id', 'nombre')->orderBy('nombre', 'desc')->get();
    }

    public function render()
    {
        $convalidaciones = Convalidacion::query()
            ->with('semestre', 'escuela')
            ->orderBy('semestre_id', 'desc')
            ->orderBy(Escuela::select('nombre')->whereColumn('escuelas.id', 'convalidaciones.escuela_id'));

        if ($this->facultad > 0) {
            if ($this->escuela > 0) {
                $convalidaciones = $convalidaciones->where('escuela_id', $this->escuela);
            } else {
                $convalidaciones = $convalidaciones->whereIn('escuela_id', function ($query) {
                    $query->select('id')->from('escuelas')
                        ->where('facultad_id', $this->facultad);
                });
            }
        }
        if ($this->semestre > 0) {
            $convalidaciones = $convalidaciones->where('semestre_id', $this->semestre);
        }
        $convalidaciones = $convalidaciones->paginate(20);

        return view('livewire.admin.convalidacion.lista-convalidacion-general', compact('convalidaciones'));
    }

    public function updatedFacultad($value)
    {
        $this->resetPage();

        if (intval($value) === 0) {
            $this->escuelas = null;
        } else {
            $this->escuelas = Escuela::query()->where('facultad_id', $value)->orderBy('nombre')->get();
        }
        $this->escuela = 0;
    }

    public function updatedSemestre()
    {
        $this->resetPage();
    }

    public function updatedEscuela()
    {
        $this->resetPage();
    }
}
