<?php

namespace App\Http\Livewire\Rsu;

use App\Models\ResponsabilidadSocial;
use Livewire\Component;

class Encuesta extends Component
{
    public $rsu_id;
    public $open = false;

    public function mount($rsu_id)
    {
        $this->rsu_id = $rsu_id;
    }

    public function render()
    {
        $rsu = ResponsabilidadSocial::query()
            ->select('id')
            ->withCount('links')
            ->with('links')
            ->where('id', $this->rsu_id)
            ->first();

        return view('livewire.rsu.encuesta', compact('rsu'));
    }

    /* Funciones */
    public function openModal(){

        $this->open = true;
    }
}
