<?php

namespace App\Http\Livewire\Admin;

use App\Models\Entrada;
use App\Models\Proceso;
use Livewire\Component;

class CrearEntrada extends Component
{
    public $open = false;
    public $procesos, $proceso = 0;
    public $nombre, $codigo, $descripcion = null;

    protected $rules = [
        'nombre' => 'required|max:250|unique:entradas,nombre',
        'descripcion' => 'nullable|max:250',
        'proceso' => 'required|gt:0',
        'codigo' => 'required|max:10'
    ];

    public function mount()
    {
        $this->procesos = Proceso::query()->orderBy('nombre')->get();
    }

    public function render()
    {
        return view('livewire.admin.crear-entrada');
    }

    /* Funciones */
    public function openModal()
    {
        $this->open = true;
    }

    public function crearEntrada()
    {
        $this->validate();
        try {
            Entrada::create([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion ?? null,
                'proceso_id' => $this->proceso,
                'codigo' => strtoupper($this->codigo),
            ]);

            $msg = 'La entrada ' . $this->nombre . ' se registró correctamente.';
            $this->emit('guardado', ['titulo' => 'Entrada agregado', 'mensaje' => $msg]);

            $this->reset('open', 'nombre', 'codigo', 'descripcion', 'proceso');
            $this->emitTo('admin.lista-entradas', 'render');
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado: \n" . $e);
        }
    }

}
