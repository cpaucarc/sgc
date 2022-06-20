<?php

namespace App\Http\Livewire\Admin\Semestre;

use App\Models\Semestre;
use Livewire\Component;

class UltimoSemestre extends Component
{
    public $listeners = ['render'];

    public function render()
    {
        $semestre = Semestre::query()->where('activo', true)->first();
        return view('livewire.admin.semestre.ultimo-semestre', compact('semestre'));
    }
}
