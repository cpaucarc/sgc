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
