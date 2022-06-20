<?php

namespace App\Http\Livewire\Admin\Semestre;

use App\Models\Semestre;
use Livewire\Component;

class ListaSemestre extends Component
{
    public $search = "";

    public $listeners = ['render', 'activarSemestre'];

    public function render()
    {
        $semestres = Semestre::query()
            ->where('nombre', 'like', '%' . $this->search . '%')
            ->orderBy('nombre', 'desc')
            ->get();
        return view('livewire.admin.semestre.lista-semestre', compact('semestres'));
    }

    public function activarSemestre($semestre_id)
    {
        Semestre::where('id', '<>', $semestre_id)->update(['activo' => false]);
        Semestre::where('id', '=', $semestre_id)->update(['activo' => true]);
        $this->emitTo('admin.semestre.ultimo-semestre', 'render');
    }

}
