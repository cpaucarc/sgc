<?php

namespace App\Http\Livewire\Admin;

use App\Models\Entidad;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RolesDelUsuario extends Component
{
    public $open = false, $uuid;
    public $usuario, $roles_actuales = [];
    public $roles = null, $roles_selected = [];
    public $entidades = null, $entidades_selected = [];

    public $listeners = ['eliminarRol', 'eliminarEntidad'];

    protected $rules = [
        'roles_selected' => 'required|array|min:1',
    ];

    public function mount($uuid)
    {
        $this->uuid = $uuid;
    }

    public function render()
    {
        $this->usuario = User::query()
            ->select('id')
            ->with('entidades', 'entidades.rol', 'roles')
            ->where('uuid', $this->uuid)->first();
        $this->roles_actuales = $this->usuario->entidades->pluck('role_id');

        return view('livewire.admin.roles-del-usuario');
    }

    /* Funciones */
    public function openModal()
    {
        $this->open = true;
        $this->roles = Role::query()->whereNotIn('id', $this->roles_actuales)->get();
    }

    public function updatedRolesSelected()
    {
        if (count($this->roles_selected) === 0) {
            $this->entidades = null;
        } else {
            $this->entidades = Entidad::query()
                ->whereIn('role_id', function ($query) {
                    $query->select('id')->from('roles')->whereIn('name', $this->roles_selected);
                })->get();
        }
    }

    public function asignarRol()
    {
        $this->validate();
        try {
            $this->usuario->assignRole($this->roles_selected);
            $this->usuario->entidades()->attach($this->entidades_selected);

            $msg = "Roles y entidades asignados con éxito.";
            $this->emit('guardado', ['titulo' => 'Roles y entidades asignados', 'mensaje' => $msg]);

            $this->reset(['roles_selected', 'entidades_selected', 'open']);
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado: \n" . $e);
        }
    }

    public function eliminarRol($rol_nombre, $rol_id)
    {
        try {
            // Quitar las entidades que pertenecen al rol y estan asociados al usuario
            $entidades_id = Entidad::query()
                ->where('role_id', $rol_id)
                ->whereIn('id', function ($query) {
                    $query->select('entidad_id')->from('entidad_user')
                        ->where('user_id', $this->usuario->id);
                })->pluck('id');
            $this->usuario->entidades()->detach($entidades_id);

            // Quitar el rol al usuario
            $this->usuario->removeRole($rol_nombre);

            $msg = "El rol '" . $rol_nombre . "' y cualquier entidad asociada a este fue quitado con éxito.";
            $this->emit('guardado', ['titulo' => 'Roles quitado', 'mensaje' => $msg]);
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado \n " . $e);
        }
    }

    public function eliminarEntidad($entidad_id, $entidad_nombre, $rol_nombre)
    {
        try {
            // Quitar la entidad seleccionada al usuario
            $this->usuario->entidades()->detach($entidad_id);

            // Quitar el rol al usuario
            $this->usuario->removeRole($rol_nombre);

            $msg = "La entidad '" . $entidad_nombre . "' y cualquier entidad asociada a este fue quitado con éxito.";
            $this->emit('guardado', ['titulo' => 'Entidad quitado', 'mensaje' => $msg]);
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado \n " . $e);
        }
    }
}
