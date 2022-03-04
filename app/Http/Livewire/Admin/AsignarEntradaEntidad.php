<?php

namespace App\Http\Livewire\Admin;

use App\Models\Actividad;
use App\Models\Entidad;
use App\Models\Entrada;
use App\Models\Escuela;
use App\Models\Proceso;
use App\Models\Proveedor;
use App\Models\Responsable;
use Livewire\Component;

class AsignarEntradaEntidad extends Component
{
    public $open = false;
    public $selected = []; // entradas seleccionados
    public $entidad_id;
    public $procesos = null, $proceso = 0;
    public $entidades, $entidad = 0; // Entidades responsables de las actividades
    public $actividades = null, $actividad = 0; // Actividades
    public $entradas = null;

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
        $this->entradas = null;
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
        $this->entradas = null;
    }

    public function render()
    {
        if ($this->actividad > 0) {
            $this->entradas = Entrada::query()
                ->where('proceso_id', $this->proceso)
                ->whereNotIn('id', function ($query) {
                    $query->select('entrada_id')->from('proveedores')
                        ->where('responsable_id', $this->actividad)
                        ->where('entidad_id', $this->entidad_id);
                })->get();
        }

        return view('livewire.admin.asignar-entrada-entidad');
    }

    /* Funciones */

    public function openModal()
    {
        $this->open = true;
    }

    public function asignarEntradas()
    {
        $this->validate();

        foreach ($this->selected as $entrada_id) {
            $proveer[] = [
                'responsable_id' => $this->actividad,
                'entidad_id' => $this->entidad_id,
                'entrada_id' => intval($entrada_id)
            ];
        }

        Proveedor::insert($proveer);

        $this->emitTo('admin.lista-entidad-proveedor', 'render');
        $this->reset(['selected', 'open']);
    }
}
