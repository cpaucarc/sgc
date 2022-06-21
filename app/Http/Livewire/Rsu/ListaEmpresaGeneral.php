<?php

namespace App\Http\Livewire\Rsu;

use App\Models\Empresa;
use Livewire\Component;
use Livewire\WithPagination;

class ListaEmpresaGeneral extends Component
{
    use WithPagination;

    public $search = "";

    public $listeners = ['render', 'eliminar'];

    public function render()
    {
        $empresas = Empresa::query()
            ->where(function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('ruc', 'like', '%' . $this->search . '%')
                    ->orWhere('ubicacion', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('livewire.rsu.lista-empresa-general', compact('empresas'));
    }

    /* Funciones */

    public function eliminar($id)
    {
        $dependientes = Empresa::query()
            ->whereIn('id', function ($query) use ($id) {
                $query->select('empresa_id')->from('responsabilidad_social')
                    ->where('empresa_id', $id);
            })
            ->count();

        if ($dependientes > 0) {
            $this->emit('error', 'No es posible eliminar esta empresa porque se encuentra en uso en Responsabilidad Social.');
        } else {
            Empresa::find($id)->delete();
        }
    }
}
