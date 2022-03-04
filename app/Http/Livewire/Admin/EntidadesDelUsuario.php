<?php

namespace App\Http\Livewire\Admin;

use App\Models\Entidad;
use App\Models\User;
use Livewire\Component;

class EntidadesDelUsuario extends Component
{
    public $uuid, $usuario;
    public $open = false;
    public $entidades_actuales = [];
    public $entidades = null, $selected = [];

    public $listeners = ['render', 'eliminarEntidad'];

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
            ->with('entidades')
            ->where('uuid', $this->uuid)->first();

        $this->entidades_actuales = $this->usuario->entidades->pluck('id');

        return view('livewire.admin.entidades-del-usuario');
    }

    /* Funciones */
    public function openModal()
    {
        $this->open = true;
        $this->entidades = Entidad::query()->whereNotIn('id', $this->entidades_actuales)->get();
    }

    public function asignarEntidades()
    {
        $this->validate();

        $this->usuario->entidades()->attach($this->selected, ['created_at' => now(), 'updated_at' => now()]);

        $this->reset(['selected', 'open']);
    }

    public function eliminarEntidad($id)
    {
        $this->usuario->entidades()->detach($id);
    }
}
