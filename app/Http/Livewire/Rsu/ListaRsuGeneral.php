<?php

namespace App\Http\Livewire\Rsu;

use App\Models\ResponsabilidadSocial;
use Livewire\Component;

class ListaRsuGeneral extends Component
{
    public function render()
    {
        $rsu = ResponsabilidadSocial::all();

        return view('livewire.rsu.lista-rsu-general', compact('rsu'));
    }
}
