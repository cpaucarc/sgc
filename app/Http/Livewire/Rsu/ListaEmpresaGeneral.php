<?php

namespace App\Http\Livewire\Rsu;

use App\Models\Empresa;
use Livewire\Component;
use Livewire\WithPagination;

class ListaEmpresaGeneral extends Component
{
    use WithPagination;

    public function render()
    {
        $empresas = Empresa::query()->paginate(10);

        return view('livewire.rsu.lista-empresa-general', compact('empresas'));
    }
}
