<?php

namespace App\Http\Livewire\Indicador;

use App\Models\AnalisisIndicador;
use App\Models\Indicador;
use App\Models\Indicadorable;
use Livewire\Component;

class TablaAnalisis extends Component
{
    public $tipo, $uuid;
    public $indicadorable_id, $indicadorable;
    public $open = false;
    public $openEdit = false, $analisis_seleccionado = null, $modoEdit = false;
    public $interpretacion = null, $observacion = null, $elaborado_por = null, $revisado_por = null, $aprobado_por = null;

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
//        $this->openGraph();
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

    public function openEditModal($analisis_id, $modoEdit)
    {
        $this->analisis_seleccionado = AnalisisIndicador::find($analisis_id);
        $this->interpretacion = $this->analisis_seleccionado->interpretacion;
        $this->observacion = $this->analisis_seleccionado->observacion;
        $this->elaborado_por = $this->analisis_seleccionado->elaborado_por;
        $this->revisado_por = $this->analisis_seleccionado->revisado_por;
        $this->aprobado_por = $this->analisis_seleccionado->aprobado_por;
        $this->modoEdit = $modoEdit;
        $this->openEdit = true;
    }

    public function closeEditModal()
    {
        $this->analisis_seleccionado = null;
        $this->openEdit = false;
    }

    public function editarInfo()
    {
        $this->analisis_seleccionado->interpretacion = $this->interpretacion;
        $this->analisis_seleccionado->observacion = $this->observacion;
        $this->analisis_seleccionado->elaborado_por = $this->elaborado_por;
        $this->analisis_seleccionado->revisado_por = $this->revisado_por;
        $this->analisis_seleccionado->aprobado_por = $this->aprobado_por;
        $this->analisis_seleccionado->save();
        $this->closeEditModal();
    }

}
