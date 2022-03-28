<?php

namespace App\Http\Livewire\Admin\Indicador;

use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Semestre;
use Livewire\Component;

class ListaIndicadorReporte extends Component
{
    public $facultades = null, $facultad = 1;
    public $semestres = null, $semestre = 0;
    public $escuelas = null, $escuela = 0;

    public function mount()
    {
        $this->facultades = Facultad::query()->orderBy('nombre')->get();
        $this->semestres = Semestre::query()->orderBy('nombre', 'desc')->get();
        $this->escuelas = Escuela::query()->where('facultad_id', $this->facultad)->orderBy('nombre')->get();
    }

    public function render()
    {
        $entidad = null;

        if ($this->facultad > 0) {
            if ($this->escuela > 0) {
                $entidad = Escuela::query()->where('id', $this->escuela);
            } else {
                $entidad = Facultad::query()->where('id', $this->facultad);
            }

            $entidad = $entidad->withCount('indicadores')->with('indicadores')
                ->with(['indicadores.analisis' => function ($query) {
                    $query->whereIn('analisis_indicador.indicadorable_id', function ($query2) {
                        $query2->select('id')->from('indicadorables')
                            ->where('indicadorable_id', $this->escuela > 0 ? $this->escuela : $this->facultad)
                            ->where('indicadorable_type', $this->escuela > 0 ? "App\\Models\\Escuela" : "App\\Models\\Facultad");
                    });
//                    if ($this->semestre > 0) {
//                        $query->where('semestre_id', $this->semestre);
//                    }

                }])
                ->first();
        }

        return view('livewire.admin.indicador.lista-indicador-reporte', compact('entidad'));
    }

    public function updatedFacultad($value)
    {
        if (intval($value) === 0) {
            $this->escuelas = null;
        } else {
            $this->escuelas = Escuela::query()->where('facultad_id', $value)->orderBy('nombre')->get();
        }
        $this->escuela = 0;
    }
}
