<?php

namespace App\Http\Livewire\Admin;

use App\Models\Entidad;
use App\Models\Entidadable;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Oficina;
use Livewire\Component;

class CrearEntidad extends Component
{
    public $open = false;
    public $oficinas, $oficina = 0;
    public $nombre, $type = null, $ents = null, $seleccionado = 0;
    public int $nivel = 0;

    protected $rules = [
        'nombre' => 'required|max:250',
        'oficina' => 'required|gt:0',
    ];

    public function mount()
    {
        $this->oficinas = Oficina::query()->select('id', 'nombre')->orderBy('nombre')->get();
    }

    public function updatedNivel($value)
    {
        if (intval($value) === 2) { // Facultad
            $this->type = "App\\Models\\Facultad";
            $this->ents = Facultad::query()->select('id', 'nombre')->orderBy('nombre')->get();
        } elseif (intval($value) === 3) { //Escuela
            $this->type = "App\\Models\\Escuela";
            $this->ents = Escuela::query()->select('id', 'nombre')->orderBy('nombre')->get();
        } else { //0:Seleccione, 1:General
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

        $entidad = Entidad::create([
            'nombre' => $this->nombre,
            'oficina_id' => $this->oficina,
        ]);

        if ($this->nivel > 1) {
            Entidadable::create([
                'entidadable_id' => $this->seleccionado,
                'entidadable_type' => $this->type,
                'entidad_id' => $entidad->id
            ]);
        }

        $this->reset('nombre', 'oficina', 'type', 'ents', 'seleccionado');
        $this->emitTo('admin.lista-entidades', 'render');
        $this->open = false;
    }
}
