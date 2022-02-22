<?php

namespace App\Http\Livewire\Indicador;

use App\Models\Indicadorable;
use Livewire\Component;

class GraficoGeneral extends Component
{
    public $indicadorable_id, $indicadorable;
    public $open = false;

    protected $listeners = ['renderizarGrafico' => 'mostrarGrafico'];

    public function mount($indicadorable_id)
    {
        $this->indicadorable_id = $indicadorable_id;
    }

    public function render()
    {
        return view('livewire.indicador.grafico-general');
    }

    /* Funciones */

    public function mostrarGrafico()
    {
        $this->indicadorable = Indicadorable::query()
            ->with('analisis:id,minimo,satisfactorio,sobresaliente,resultado,created_at,indicadorable_id')
            ->findOrFail($this->indicadorable_id);
        if ($this->indicadorable) {
            $this->generarDatos();
        }
        $this->open = true;
    }

    public function generarDatos()
    {
        $sobresaliente = array();
        $satisfactorio = array();
        $minimo = array();
        $bar = array();
        $labels = array();
        $colors = array();

        foreach ($this->indicadorable->analisis as $an) {
            array_push($sobresaliente, $an->sobresaliente);
            array_push($satisfactorio, $an->satisfactorio);
            array_push($minimo, $an->minimo);
            array_push($bar, $an->resultado);
            array_push($labels, $an->created_at->format('d-M-Y'));
            array_push($colors, $this->asignarColor($an->sobresaliente, $an->satisfactorio, $an->minimo, $an->resultado));
        }

        $size = count($sobresaliente);
        if ($size < 5) {
            for ($i = $size; $i < 5; $i++) {
                array_push($sobresaliente, 0);
                array_push($satisfactorio, 0);
                array_push($minimo, 0);
                array_push($bar, 0);
                array_push($labels, '-');
            }
        }

        $datos = [
            'sobresaliente' => $sobresaliente,
            'satisfactorio' => $satisfactorio,
            'minimo' => $minimo,
            'bar' => $bar,
            'labels' => $labels,
            'colors' => $colors
        ];

//        $this->mostrarGrafico = true;

//        $this->dispatchBrowserEvent('grafico', ['datos' => $datos]);
        $this->emit('eventRenderGraph', $datos);

    }

    private function asignarColor($sobresaliente, $satisfactorio, $minimo, $valor)
    {
        if ($valor <= $minimo) {
            return "#FDA4AF"; // Rojo - Tailwind: rose-300
        } elseif ($valor <= $satisfactorio) {
            return "#FCD34D"; // Rojo - Tailwind: amber-300
        } elseif ($valor <= $sobresaliente) {
            return "#86EFAC"; // Verde - Tailwind: green-300
        }
        return "#7DD3FC"; // Azul - Tailwind: sky-300
    }
}
