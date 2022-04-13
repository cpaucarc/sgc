<?php

namespace App\Http\Livewire\Admin\Semestre;

use App\Models\Semestre;
use Livewire\Component;

class CrearSemestre extends Component
{
    public $open = false;
    public $nombre, $fecha_inicio, $fecha_fin;

    protected $rules = [
        'nombre' => 'required|max:100|unique:semestres,nombre',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after:fecha_inicio'
    ];

    public function render()
    {
        return view('livewire.admin.semestre.crear-semestre');
    }

    /* Funciones */
    public function openModal()
    {
        $this->open = true;
    }

    public function crearSemestre()
    {
        $this->validate();
        Semestre::create([
            'nombre' => $this->nombre,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin
        ]);
        $this->emit('guardado', "El semestre académico '.$this->nombre.' fue creado con éxito.");
        $this->reset('open', 'nombre', 'fecha_inicio', 'fecha_fin');

        $this->emitTo('admin.semestre.lista-semestre', 'render');
        $this->emitTo('admin.semestre.ultimo-semestre', 'render');
    }
}
