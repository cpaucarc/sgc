<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class ListaUsuarios extends Component
{
    public $search = "";
//    public $proceso, $procesos = 0;
//    public $salidas = null;

    public $listeners = ['render', 'eliminar'];

    public function mount()
    {
//        $this->procesos = Proceso::query()->orderBy('nombre')->get();
    }

//    public function updatedProceso($value)
//    {
//        if ($value > 0) {
//            $this->salidas = Salida::query()
//                ->where('nombre', 'like', '%' . $this->search . '%')
//                ->where('proceso_id', $value)
//                ->orderBy('codigo')
//                ->get();
//        } else {
//            $this->salidas = null;
//        }
//    }

    public function render()
    {
        $usuarios = User::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy('activo', 'desc')
            ->orderBy('name')
            ->get();

        return view('livewire.admin.lista-usuarios', compact('usuarios'));
    }

    /* Funciones */

    public function eliminar($id)
    {
        $user = User::find($id);
        $user->activo = !$user->activo;
        $user->save();
    }
}
