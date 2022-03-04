<?php

namespace App\Http\Livewire\Admin;

use App\Models\Entidad;
use App\Models\Oficina;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RolesDelUsuario extends Component
{
    public $uuid, $usuario, $roles_actuales = [];
    public $open = false;
    public $roles = null, $selected = [];

    public $listeners = ['eliminarRol'];

    protected $rules = [
        'selected' => 'required|array|min:1',
    ];

    public function mount($uuid)
    {
        $this->uuid = $uuid;
    }

    public function render()
    {
        $this->usuario = User::query()
            ->select('id')
            ->with('roles')
            ->where('uuid', $this->uuid)->first();

        $this->roles_actuales = $this->usuario->roles->pluck('id');

        return view('livewire.admin.roles-del-usuario');
    }

    /* Funciones */
    public function openModal()
    {
        $this->open = true;
        $this->roles = Role::query()->whereNotIn('id', $this->roles_actuales)->get();
    }

    public function asignarRol()
    {
        $this->validate();

        $this->usuario->assignRole($this->selected);

        $this->reset(['selected', 'open']);
    }

    public function eliminarRol($nombre)
    {
        $ents = Entidad::query()
            ->whereIn('oficina_id', function ($query) use ($nombre) {
                $query->select('id')->from('oficinas')->where('nombre', $nombre);
            })->pluck('id');

        if ($ents) {
            $this->usuario->entidades()->detach($ents);
            $this->emitTo('admin.entidades-del-usuario', 'render');
        }

        $this->usuario->removeRole($nombre);

    }
}
