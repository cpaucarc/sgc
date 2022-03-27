<?php

namespace App\Http\Livewire\Admin\Bolsa;

use App\Models\BolsaPostulante;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Semestre;
use Livewire\Component;

class ListaBolsaPostulantes extends Component
{
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

        $bolsaPostulante = BolsaPostulante::query()
            ->select("id", "postulantes", "beneficiados", "fecha_inicio", "fecha_fin", "semestre_id", "escuela_id")
            ->with('escuela:id,nombre,facultad_id', 'semestre:id,nombre')
            ->orderBy('semestre_id', 'desc')
            ->orderBy(Escuela::select('nombre')->whereColumn('escuelas.id', 'bolsa_postulantes.escuela_id'));


        if ($this->facultad > 0) {
            if ($this->escuela > 0) {
                $bolsaPostulante = $bolsaPostulante->where('escuela_id', $this->escuela);
            } else {
                $bolsaPostulante = $bolsaPostulante->whereIn('escuela_id', function ($query) {
                    $query->select('id')->from('escuelas')
                        ->where('facultad_id', $this->facultad);
                });
            }
        }
        if ($this->semestre > 0) {
            $bolsaPostulante = $bolsaPostulante->where('semestre_id', $this->semestre);
        }

        $bolsaPostulante = $bolsaPostulante->get();

        return view('livewire.admin.bolsa.lista-bolsa-postulantes', compact('bolsaPostulante'));
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
