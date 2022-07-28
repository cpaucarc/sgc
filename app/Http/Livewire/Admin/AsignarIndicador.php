<?php

namespace App\Http\Livewire\Admin;

use App\Models\Indicador;
use App\Models\Indicadorable;
use Livewire\Component;

class AsignarIndicador extends Component
{
    public $indicador_id;
    public $open = false;
    public $indicador_en_facultades = null, $ind_fac_actual = [];
    public $indicador_en_escuelas = null, $ind_esc_actual = [];

    public function mount($indicador_id)
    {
        $this->indicador_id = $indicador_id;
    }

    public function render()
    {
        $query_fac = Indicadorable::query()
            ->where('indicador_id', $this->indicador_id)
            ->where('indicadorable_type', 'App\Models\Facultad');
        $this->indicador_en_facultades = $query_fac->get();
        $this->ind_fac_actual = $query_fac->pluck('id');

        $query_esc = Indicadorable::query()
            ->where('indicador_id', $this->indicador_id)
            ->where('indicadorable_type', 'App\Models\Escuela');
        $this->indicador_en_escuelas = $query_esc->get();
        $this->ind_esc_actual = $query_esc->pluck('id');

        return view('livewire.admin.asignar-indicador');
    }
}
