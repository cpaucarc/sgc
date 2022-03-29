<?php

namespace App\Http\Livewire\Admin\Bienestar;

use App\Models\Comedor;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Semestre;
use Livewire\Component;

class ListaAtencionComedor extends Component
{
    public $facultades = null, $facultad = 0;
    public $semestres = null, $semestre = 0;
    public $escuelas = null, $escuela = 0;
    public $anio = 0;


    public function mount()
    {
        $this->facultades = Facultad::query()->orderBy('nombre')->get();
        $this->semestres = Semestre::query()->orderBy('nombre', 'desc')->get();
    }

    public function render()
    {
        $comedor = Comedor::query()
            ->select("id", "mes", "anio", "atenciones", "total", "escuela_id")
            ->with('escuela:id,nombre,facultad_id')
            ->orderBy('mes', 'desc')
            ->orderBy(Escuela::select('nombre')->whereColumn('escuelas.id', 'comedor.escuela_id'));

        if ($this->facultad > 0) {
            if ($this->escuela > 0) {
                $comedor = $comedor->where('escuela_id', $this->escuela);
            } else {
                $comedor = $comedor->whereIn('escuela_id', function ($query) {
                    $query->select('id')->from('escuelas')
                        ->where('facultad_id', $this->facultad);
                });
            }
        }

        if ($this->anio > 0) {
            $comedor = $comedor->where('anio', $this->anio);
        }

        $comedor = $comedor->get();

        return view('livewire.admin.bienestar.lista-atencion-comedor', compact('comedor'));
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
