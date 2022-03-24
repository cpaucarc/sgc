<?php

namespace App\Http\Livewire\Admin\Rsu;

use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\ResponsabilidadSocial;
use App\Models\Semestre;
use Livewire\Component;
use Livewire\WithPagination;

class ListaRsuReporte extends Component
{
    use WithPagination;

    public $facultades = null, $facultad = 0;
    public $semestres = null, $semestre = 0;
    public $escuelas = null, $escuela = 0;

    public function mount()
    {
        $this->facultades = Facultad::query()->orderBy('nombre')->get();
        $this->semestres = Semestre::query()->orderBy('nombre', 'desc')->get();
    }

    public function render()
    {
        $rsu = ResponsabilidadSocial::query()
            ->select("id", "titulo", "uuid", "fecha_inicio", "fecha_fin", "semestre_id", "escuela_id")
            ->with('escuela:id,nombre,facultad_id', 'semestre:id,nombre')
            ->orderBy('semestre_id', 'desc')
            ->orderBy(Escuela::select('nombre')->whereColumn('escuelas.id', 'responsabilidad_social.escuela_id'));

        if ($this->facultad > 0) {
            if ($this->escuela > 0) {
                $rsu = $rsu->where('escuela_id', $this->escuela);
            } else {
                $rsu = $rsu->whereIn('escuela_id', function ($query) {
                    $query->select('id')->from('escuelas')
                        ->where('facultad_id', $this->facultad);
                });
            }
        }
        if ($this->semestre > 0) {
            $rsu = $rsu->where('semestre_id', $this->semestre);
        }

        $rsu = $rsu->paginate(20);

        return view('livewire.admin.rsu.lista-rsu-reporte', compact('rsu'));
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
