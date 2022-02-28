<?php

namespace App\Http\Livewire\Admin;

use App\Models\Entidad;
use Livewire\Component;

class ListaEntidadResponsable extends Component
{
    public $entidad_id;

    public function mount($entidad_id)
    {
        $this->entidad_id = $entidad_id;
    }

    public function render()
    {
        $entidad = Entidad::query()
            ->with('actividades')
            ->where('id', $this->entidad_id)
            ->first();

        return view('livewire.admin.lista-entidad-responsable', compact('entidad'));
    }
}
