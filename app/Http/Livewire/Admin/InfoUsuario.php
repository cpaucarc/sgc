<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class InfoUsuario extends Component
{
    public $usuario;

    public $listeners = ['eliminar'];

    public function mount($uuid)
    {
        $this->usuario = User::where('uuid', $uuid)->first();
    }

    public function render()
    {
        return view('livewire.admin.info-usuario');
    }

    public function eliminar()
    {
        $this->usuario->activo = !$this->usuario->activo;
        $this->usuario->save();
    }
}
