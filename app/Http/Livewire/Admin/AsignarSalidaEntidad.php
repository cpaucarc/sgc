<?php

namespace App\Http\Livewire\Admin;

use App\Models\Cliente;
use App\Models\Entidad;
use App\Models\Proceso;
use App\Models\Responsable;
use App\Models\Salida;
use Livewire\Component;

class AsignarSalidaEntidad extends Component
{
    public $open = false;
    public $selected = []; // salidas seleccionados
    public $entidad_id;
    public $procesos = null, $proceso = 0;
    public $entidades, $entidad = 0; // Entidades responsables de las actividades
    public $actividades = null, $actividad = 0; // Actividades
    public $salidas = null;

    public $listeners = ['openModal'];

    protected $rules = [
        'selected' => 'required|array|min:1',
    ];

    public function mount($entidad_id)
    {
        $this->entidad_id = $entidad_id;
        $this->entidades = Entidad::query()->select('id', 'nombre')->orderBy('nombre')->get();
    }

    public function updatedEntidad($value)
    {
        if ($value > 0) {
            $this->procesos = Proceso::whereIn('id', function ($query) use ($value) {
                $query->select('proceso_id')->from('actividades')
                    ->whereIn('id', function ($query2) use ($value) {
                        $query2->select('actividad_id')->from('responsables')->where('entidad_id', $value);
                    });
            })->orderBy('nombre')->get();
        } else {
            $this->procesos = null;
        }

        $this->proceso = 0;
        $this->actividades = null;
        $this->actividad = 0;
        $this->salidas = null;
    }

    public function updatedProceso($value)
    {
        if ($value > 0) {
            $this->actividades = Responsable::query()
                ->with('actividad')->where('entidad_id', $this->entidad)->get();
        } else {
            $this->actividades = null;
        }

        $this->actividad = 0;
        $this->salidas = null;
    }

    public function render()
    {
        if ($this->actividad > 0) {
            $this->salidas = Salida::query()
                ->where('proceso_id', $this->proceso)
                ->whereNotIn('id', function ($query) {
                    $query->select('salida_id')->from('clientes')
                        ->where('responsable_id', $this->actividad)
                        ->where('entidad_id', $this->entidad_id);
                })->get();
        }

        return view('livewire.admin.asignar-salida-entidad');
    }

    /* Funciones */

    public function openModal()
    {
        $this->open = true;
    }

    public function asignarSalidas()
    {
        $this->validate();

        foreach ($this->selected as $salida_id) {
            $clientes[] = [
                'responsable_id' => $this->actividad,
                'entidad_id' => $this->entidad_id,
                'salida_id' => intval($salida_id)
            ];
        }

        Cliente::insert($clientes);

        $this->emitTo('admin.lista-entidad-cliente', 'render');
        $this->reset(['selected', 'open']);
    }
}
