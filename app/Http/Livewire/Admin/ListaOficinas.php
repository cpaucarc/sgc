<?php

namespace App\Http\Livewire\Admin;

use App\Models\Oficina;
use Livewire\Component;

class ListaOficinas extends Component
{
    public function render()
    {
        $oficinas = Oficina::all();

        return view('livewire.admin.lista-oficinas', compact('oficinas'));
    }
}
