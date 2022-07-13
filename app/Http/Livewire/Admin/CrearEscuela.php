<?php

namespace App\Http\Livewire\Admin;

use App\Models\Escuela;
use App\Models\Facultad;
use Illuminate\Support\Str;
use Livewire\Component;

class CrearEscuela extends Component
{
    public $open = false;
    public $nombre, $abrev, $facultad;
    public $facultades;

    protected $rules = [
        'nombre' => 'required|max:250|unique:escuelas,nombre',
        'abrev' => 'required|max:10|unique:escuelas,abrev',
        'facultad' => 'required|gt:0'
    ];

    public function mount()
    {
        $this->facultades = Facultad::orderBy('nombre')->get();
    }

    public function render()
    {
        return view('livewire.admin.crear-escuela');
    }

    /* Funciones */
    public function openModal()
    {
        $this->open = true;
    }

    public function crearEscuela()
    {
        $this->validate();
        try {
            Escuela::create([
                'nombre' => $this->nombre,
                'abrev' => $this->abrev,
                'facultad_id' => $this->facultad,
                'uuid' => Str::uuid()
            ]);
            $this->reset('open', 'nombre', 'abrev', 'facultad');

            $msg = 'El programa académico se registró correctamente.';
            $this->emit('guardado', ['titulo' => 'Programa académico agregado', 'mensaje' => $msg]);
            $this->emitTo('admin.lista-escuelas', 'render');
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado: \n" . $e);
        }
    }
}
