<?php

namespace App\Http\Livewire\Admin\Investigacion;

use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Investigacion;
use App\Models\Semestre;
use Livewire\Component;

class ListaInvestigacionReporte extends Component
{
    public $facultades = null, $facultad = 0;
    public $escuelas = null, $escuela = 0;
    public $estado = 0;

    public function mount()
    {
        $this->facultades = Facultad::query()->orderBy('nombre')->get();
    }

    public function render()
    {
        $investigaciones = Investigacion::query()
            ->select("id", "titulo", "fecha_publicacion", "escuela_id", "estado_id", "created_at")
            ->with('escuela:id,nombre', 'estado:id,nombre,color')
            ->orderBy(Escuela::select('nombre')->whereColumn('escuelas.id', 'investigaciones.escuela_id'))
            ->orderBy('titulo');

        if ($this->facultad > 0) {
            if ($this->escuela > 0) {
                $investigaciones = $investigaciones->where('escuela_id', $this->escuela);
            } else {
                $investigaciones = $investigaciones->whereIn('escuela_id', function ($query) {
                    $query->select('id')->from('escuelas')->where('facultad_id', $this->facultad);
                });
            }
        }

        if ($this->estado > 0) {
            $investigaciones = $investigaciones->where('estado_id', $this->estado);
        }

        $investigaciones = $investigaciones->get();

        return view('livewire.admin.investigacion.lista-investigacion-reporte',
            compact('investigaciones'));
    }

    public function updatedFacultad($value)
    {
//        $this->resetPage();

        if (intval($value) === 0) {
            $this->escuelas = null;
        } else {
            $this->escuelas = Escuela::query()->where('facultad_id', $value)->orderBy('nombre')->get();
        }
        $this->escuela = 0;
    }

    public function updatedSemestre()
    {
//        $this->resetPage();
    }

    public function updatedEscuela()
    {
//        $this->resetPage();
    }
}
