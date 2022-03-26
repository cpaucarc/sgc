<?php

namespace App\Http\Livewire\Admin\Biblioteca;

use App\Models\BibliotecaVisitante;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Semestre;
use Livewire\Component;

class ListaVisitantes extends Component
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
        $visitantes = BibliotecaVisitante::query()
            ->select("id", "visitantes", "fecha_inicio", "fecha_fin", "semestre_id", "escuela_id")
            ->with('escuela:id,nombre,facultad_id', 'semestre:id,nombre')
            ->orderBy('semestre_id', 'desc')
            ->orderBy(Escuela::select('nombre')->whereColumn('escuelas.id', 'biblioteca_visitantes.escuela_id'));

        if ($this->facultad > 0) {
            if ($this->escuela > 0) {
                $visitantes = $visitantes->where('escuela_id', $this->escuela);
            } else {
                $visitantes = $visitantes->whereIn('escuela_id', function ($query) {
                    $query->select('id')->from('escuelas')
                        ->where('facultad_id', $this->facultad);
                });
            }
        }
        if ($this->semestre > 0) {
            $visitantes = $visitantes->where('semestre_id', $this->semestre);
        }

        $visitantes = $visitantes->get();

        return view('livewire.admin.biblioteca.lista-visitantes', compact('visitantes'));
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
