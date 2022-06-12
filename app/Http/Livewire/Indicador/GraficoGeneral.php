<?php

namespace App\Http\Livewire\Indicador;

use App\Lib\GraficoHelper;
use App\Lib\MedicionHelper;
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
            ->with('analisis:id,minimo,satisfactorio,sobresaliente,resultado,indicadorable_id,fecha_medicion_inicio,fecha_medicion_fin')
            ->findOrFail($this->indicadorable_id);

        if (!$this->indicadorable) {
            return;
        }

        $this->generarDatos();
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
        $lines = array(
            'minimo' => GraficoHelper::$colores['rose_600'],
            'satisfactorio' => GraficoHelper::$colores['amber_600'],
            'sobresaliente' => GraficoHelper::$colores['green_600'],
        );

        foreach ($this->indicadorable->analisis as $an) {
            $sobresaliente[] = $an->sobresaliente;
            $satisfactorio[] = $an->satisfactorio;
            $minimo[] = $an->minimo;
            $bar[] = $an->resultado;
            $labels[] = $an->fecha_medicion_inicio->format('d-M-Y') . ' a ' . $an->fecha_medicion_fin->format('d-M-Y');
            $colors[] = GraficoHelper::asignarColor($an->sobresaliente, $an->satisfactorio, $an->minimo, $an->resultado);
        }

        $size = count($sobresaliente);
        if ($size < 5) {
            for ($i = $size; $i < 5; $i++) {
                $sobresaliente[] = 0;
                $satisfactorio[] = 0;
                $minimo[] = 0;
                $bar[] = 0;
                $labels[] = '-';
            }
        }

        $datos = [
            'sobresaliente' => $sobresaliente,
            'satisfactorio' => $satisfactorio,
            'minimo' => $minimo,
            'bar' => $bar,
            'labels' => $labels,
            'colors' => $colors,
            'lines' => $lines
        ];

//        $this->mostrarGrafico = true;

//        $this->dispatchBrowserEvent('grafico', ['datos' => $datos]);
        $this->emit('eventRenderGraph', $datos);

    }
}
