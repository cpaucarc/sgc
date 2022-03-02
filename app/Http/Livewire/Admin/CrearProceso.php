<?php

namespace App\Http\Livewire\Admin;

use App\Models\Proceso;
use Livewire\Component;

class CrearProceso extends Component
{
    public $open = false;
    public $nombre;

    protected $rules = [
        'nombre' => 'required|max:250|unique:procesos,nombre'
    ];

    public function render()
    {
        return view('livewire.admin.crear-proceso');
    }

    /* Funciones */
    public function openModal()
    {
        $this->open = true;
    }

    public function crearProceso()
    {
        $this->validate();
        Proceso::create([
            'nombre' => $this->nombre,
        ]);
        $this->reset('open', 'nombre');
        $this->emitTo('admin.lista-procesos', 'render');
    }


}
