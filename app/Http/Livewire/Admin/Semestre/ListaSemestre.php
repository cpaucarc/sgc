<?php

namespace App\Http\Livewire\Admin\Semestre;

use App\Models\Semestre;
use Livewire\Component;

class ListaSemestre extends Component
{
    public $search = "";

    public $listeners = ['render'];

    public function render()
    {
        $semestres = Semestre::query()
            ->where('nombre', 'like', '%' . $this->search . '%')
            ->orderBy('nombre', 'desc')
            ->get();
        return view('livewire.admin.semestre.lista-semestre', compact('semestres'));
    }

}
