<?php

namespace App\Http\Livewire\Admin;

use App\Models\Actividad;
use App\Models\Proceso;
use App\Models\TipoActividad;
use Livewire\Component;

class CrearActividad extends Component
{
    public $open = false;
    public $procesos, $proceso = 0;
    public $tipos, $tipo = 0;
    public $nombre, $descripcion = null;

    protected $rules = [
        'nombre' => 'required|max:250|unique:procesos,nombre',
        'descripcion' => 'nullable|max:250',
        'proceso' => 'required|gt:0',
        'tipo' => 'required|gt:0'
    ];

    public function mount()
    {
        $this->procesos = Proceso::query()->orderBy('nombre')->get();
        $this->tipos = TipoActividad::query()->orderBy('nombre')->get();
    }

    public function render()
    {
        return view('livewire.admin.crear-actividad');
    }

    /* Funciones */
    public function openModal()
    {
        $this->open = true;
    }

    public function crearActividad()
    {
        $this->validate();
        Actividad::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion ?? null,
            'proceso_id' => $this->proceso,
            'tipo_actividad_id' => $this->tipo,
        ]);
        $this->reset('open', 'nombre', 'descripcion','proceso','tipo');
        $this->emitTo('admin.lista-actividades', 'render');
    }
}
