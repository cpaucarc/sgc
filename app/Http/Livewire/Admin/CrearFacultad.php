<?php

namespace App\Http\Livewire\Admin;

use App\Models\Facultad;
use Illuminate\Support\Str;
use Livewire\Component;

class CrearFacultad extends Component
{
    public $open = false;
    public $nombre, $abrev, $direccion;

    protected $rules = [
        'nombre' => 'required|max:250|unique:facultades,nombre',
        'abrev' => 'required|max:10|unique:facultades,abrev',
        'direccion' => 'required|max:250'
    ];

    public function render()
    {
        return view('livewire.admin.crear-facultad');
    }

    /* Funciones */
    public function openModal()
    {
        $this->open = true;
    }

    public function crearFacultad()
    {
        $this->validate();
        Facultad::create([
            'nombre' => $this->nombre,
            'abrev' => $this->abrev,
            'direccion' => $this->direccion,
            'uuid' => Str::uuid()
        ]);
        $this->reset('open', 'nombre', 'abrev', 'direccion');
        $this->emitTo('admin.lista-facultades', 'render');
    }
}
