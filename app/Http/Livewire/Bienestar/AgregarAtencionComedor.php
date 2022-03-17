<?php

namespace App\Http\Livewire\Bienestar;

use App\Models\Comedor;
use App\Models\Escuela;
use Carbon\Carbon;
use Livewire\Component;

class AgregarAtencionComedor extends Component
{
    public $fecha, $cantidad, $total, $escuela = 0, $escuelas = null;

    protected $rules = [
        'cantidad' => 'required|gt:0',
        'total' => 'required|gt:0'
    ];

    public function mount()
    {
        $this->fecha = now()->format('Y-m');
        $this->escuelas = Escuela::all();
        $this->escuela = $this->escuelas->first()->id;
    }

    public function render()
    {
        return view('livewire.bienestar.agregar-atencion-comedor');
    }

    public function guardar()
    {
        $this->validate();
        Comedor::create([
            'mes' => Carbon::createFromFormat('Y-m', $this->fecha)->month,
            'anio' => Carbon::createFromFormat('Y-m', $this->fecha)->year,
            'atenciones' => $this->cantidad,
            'total' => $this->total,
            'escuela_id' => $this->escuela
        ]);
        $this->reset('cantidad');
        $this->emitTo('bienestar.lista-atencion-comedor', "cargarDatos");
    }
}
