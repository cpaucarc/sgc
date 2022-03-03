<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ListaUsuarios extends Component
{
    use WithPagination;
    public $search = "";

    public $listeners = ['render', 'eliminar'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $usuarios = User::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy('activo', 'desc')
            ->orderBy('name')
            ->paginate(10);

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
