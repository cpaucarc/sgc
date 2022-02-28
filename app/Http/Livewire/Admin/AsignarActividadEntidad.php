<?php

namespace App\Http\Livewire\Admin;

use App\Models\Actividad;
use App\Models\Proceso;
use App\Models\Responsable;
use Livewire\Component;

class AsignarActividadEntidad extends Component
{
    public $open = false;
    public $selected = []; // actividades seleccionados
    public $entidad_id, $procesos, $proceso = 0;

    public $listeners = ['openModal'];

    protected $rules = [
        'selected' => 'required|array|min:1',
    ];

    public function mount($entidad_id)
    {
        $this->entidad_id = $entidad_id;
        $this->procesos = Proceso::query()->orderBy('nombre')->get();
    }

    public function render()
    {
        $actividades = Actividad::query()
            ->with('proceso')
            ->whereNotIn('id', function ($query) {
                $query->select('actividad_id')
                    ->from('responsables')
                    ->where('entidad_id', $this->entidad_id);
            })
            ->orderBy('proceso_id')
            ->orderBy('nombre');

        if ($this->proceso > 0) {
            $actividades->where('proceso_id', $this->proceso);
        }
        $actividades = $actividades->get();

        return view('livewire.admin.asignar-actividad-entidad', compact('actividades'));
    }

    /* Funciones */

    public function openModal()
    {
        $this->open = true;
    }

    public function asignarActividades()
    {
        $this->validate();

        foreach ($this->selected as $actividad_id) {
            $responsabilidades[] = [
                'entidad_id' => $this->entidad_id,
                'actividad_id' => intval($actividad_id)
            ];
        }

        Responsable::insert($responsabilidades);

        $this->emitTo('admin.lista-entidad-responsable', 'render');
        $this->reset(['selected', 'open']);
    }
}
