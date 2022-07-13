<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class InfoUsuario extends Component
{
    public $uuid;

    public $listeners = ['eliminar', 'render'];

    public function mount($uuid)
    {
        $this->uuid = $uuid;
    }

    public function render()
    {
        $usuario = User::where('uuid', $this->uuid)->first();
        return view('livewire.admin.info-usuario', compact('usuario'));
    }

    public function eliminar($id)
    {
        $user = User::find($id);
        $user->activo = !$user->activo;
        $user->save();
    }
}
