<?php

namespace App\Http\Livewire\Indicador;

use App\Models\Indicador;
use App\Models\Indicadorable;
use Livewire\Component;

class TablaAnalisis extends Component
{
    public $tipo, $uuid;
    public $indicadorable_id, $indicadorable;
    public $open = false;

    protected $listeners = ['renderizarTabla' => 'render'];

    public function mount($indicadorable_id, $tipo, $uuid)
    {
        $this->indicadorable_id = $indicadorable_id;
        $this->tipo = $tipo;
        $this->uuid = $uuid;
    }

    public function render()
    {
        $this->indicadorable = Indicadorable::query()
            ->with('indicador:id,titulo_interes,titulo_total,titulo_resultado', 'analisis')
            ->findOrFail($this->indicadorable_id);
        $this->openGraph();
        return view('livewire.indicador.tabla-analisis');
    }

    /* Funciones */
    public function openModal()
    {
        $this->emitTo('indicador.nuevo-analisis', 'openModal');
    }

    public function openGraph()
    {
        $this->emitTo('indicador.grafico-general', 'renderizarGrafico');
    }

}
