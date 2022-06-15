<?php

namespace App\Http\Livewire\Admin;

use App\Models\Entidad;
use App\Models\Entidadable;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Oficina;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class CrearEntidad extends Component
{
    public $open = false;
    public $roles, $rol = 0;
    public $nombre, $type = null, $ents = null, $seleccionado = 0;
    public int $nivel = 0;

    protected $rules = [
        'nombre' => 'required|max:250',
        'rol' => 'required|gt:0',
        'nivel' => 'required|gt:0',
    ];

    public function mount()
    {
        $this->roles = Role::query()
            ->select('id', 'name')
            ->where('name', '<>', 'Administrador')
            ->orderBy('name')
            ->get();
    }

    public function updatedNivel($value)
    {
        if (intval($value) === 2) { // Facultad
            $this->type = "App\\Models\\Facultad";
            $this->ents = Facultad::query()->select('id', 'nombre')->orderBy('nombre')->get();
        } elseif (intval($value) === 3) { //Escuela
            $this->type = "App\\Models\\Escuela";
            $this->ents = Escuela::query()->select('id', 'nombre')->orderBy('nombre')->get();
        } else { //0:Seleccione o 1:General
            $this->reset('type', 'ents', 'seleccionado');
        }
    }

    public function render()
    {
        return view('livewire.admin.crear-entidad');
    }

    /* Funciones */
    public function openModal()
    {
        $this->open = true;
    }

    public function guardarEntidad()
    {
        $this->validate();

        try {
            $entidad = Entidad::create([
                'nombre' => $this->nombre,
                'role_id' => $this->rol,
            ]);

            if ($this->nivel > 1) {
                Entidadable::create([
                    'entidadable_id' => $this->seleccionado,
                    'entidadable_type' => $this->type,
                    'entidad_id' => $entidad->id
                ]);
            }

            $this->emit('guardado', "La nueva Entidad llamada '" . $this->nombre . "' fue creado con éxito.");
            $this->reset('nombre', 'rol', 'type', 'ents', 'seleccionado');
            $this->emitTo('admin.lista-entidades', 'render');
            $this->open = false;
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado: \n" . $e);
        }
    }
}
