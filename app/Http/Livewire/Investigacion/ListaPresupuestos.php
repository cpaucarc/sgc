<?php

namespace App\Http\Livewire\Investigacion;

use App\Models\Financiador;
use App\Models\Investigacion;
use App\Models\InvestigacionFinanciacion;
use App\Models\InvestigacionInvestigador;
use Livewire\Component;

class ListaPresupuestos extends Component
{
    public $investigacion, $investigacion_id;
    public $financiadores;
    public $open = false;
    public $financiador_seleccionado = 0, $monto = null;

    protected $rules = [
        'financiador_seleccionado' => 'required|integer|gt:0',
        'monto' => 'required|gt:0',
    ];

    public function mount($investigacion_id)
    {
        $this->investigacion_id = $investigacion_id;
    }

    public function render()
    {
        $this->investigacion = Investigacion::query()
            ->select('id')
            ->with('financiaciones')
            ->where('id', $this->investigacion_id)
            ->first();

        $this->financiadores = Financiador::query()
            ->whereNotIn('id', function ($query) {
                $query->select('financiador_id')
                    ->from('investigacion_financiacion')
                    ->where('investigacion_id', $this->investigacion->id);
            })->get();

        return view('livewire.investigacion.lista-presupuestos');
    }

    /* Funciones */
    public function openModal()
    {
        $this->open = true;
    }

    public function guardarPresupuesto()
    {
        $this->validate();
        InvestigacionFinanciacion::create([
            'presupuesto' => $this->monto,
            'investigacion_id' => $this->investigacion->id,
            'financiador_id' => $this->financiador_seleccionado
        ]);
        $this->reset('open', 'financiador_seleccionado', 'monto');
    }
}
