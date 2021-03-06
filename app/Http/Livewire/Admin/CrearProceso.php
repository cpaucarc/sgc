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
        try {
            Proceso::create([
                'nombre' => $this->nombre,
            ]);

            $msg = 'El proceso ' . $this->nombre . ' se registró correctamente.';
            $this->emit('guardado', ['titulo' => 'Proceso agregado', 'mensaje' => $msg]);

            $this->reset('open', 'nombre');
            $this->emitTo('admin.lista-procesos', 'render');
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado: \n" . $e);
        }
    }
}
