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

    public $listeners = ['eliminarRol'];

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
            ->with('entidades', 'entidades.rol')
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

        $this->usuario->assignRole($this->roles_selected);
        $this->usuario->entidades()->attach($this->entidades_selected);

        $this->emit('guardado', "Roles y entidades asignados con éxito.");
        $this->reset(['roles_selected', 'entidades_selected', 'open']);
    }

    public function eliminarRol($entidad_id, $entidad_nombre, $rol_id, $rol_nombre)
    {
        try {
            $entidad = Entidad::query()->where('id', $entidad_id)->first();
            $this->usuario->entidades()->detach($entidad_id);
            $entidad->delete();
            $mensaje = "La entidad llamada '" . $entidad_nombre . "' ";

            $entidades = DB::table('entidad_user')
                ->where('user_id', $this->usuario->id)
                ->whereIn('entidad_id', function ($query) use ($rol_id) {
                    $query->select('id')->from('entidades')->where('role_id', $rol_id);
                })
                ->count();

            if ($entidades === 0) {
                $this->usuario->removeRole($rol_nombre);
                $mensaje .= "y el rol '" . $rol_nombre . "'";
            }

            $this->emit('guardado', $mensaje . " fue quitada con éxito.");
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado \n " . $e);
        }
    }
}
