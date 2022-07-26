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

    public function mostrarGrafico($semestre = 0, $curso = 0, $capacitacion = 0, $servicio = 0)
    {
        $this->indicadorable = Indicadorable::query()
            ->with('indicador:id,cod_ind_inicial,titulo_interes,titulo_total,titulo_resultado')
            ->with(['analisis' => function ($query) use ($semestre, $curso, $capacitacion, $servicio) {
                if ($semestre > 0) {
                    $query->where('semestre_id', $semestre);
                }

                if ($curso > 0) {
                    $query->whereIn('id', function ($query2) use ($curso) {
                        $query2->select('analisis_indicador_id')->from('analisis_cursos')
                            ->where('curso_id', $curso);
                    });
                }

                if ($capacitacion > 0) {
                    $query->whereIn('id', function ($query2) use ($capacitacion) {
                        $query2->select('analisis_indicador_id')->from('analisis_capacitaciones')
                            ->where('capacitacion_id', $capacitacion);
                    });
                }

                if ($servicio > 0) {
                    $query->whereIn('id', function ($query2) use ($servicio) {
                        $query2->select('analisis_indicador_id')->from('analisis_servicios')
                            ->where('servicio_id', $servicio);
                    });
                }

                $query->with(['semestre', 'curso', 'capacitacion', 'servicio']);
            }])->findOrFail($this->indicadorable_id);

        if (!$this->indicadorable) {
            return;
        }

        $this->generarDatos();
        $this->open = true;
    }

    public function generarDatos()
    {
        $sobresaliente = array();
        $minimo = array();
        $bar = array();
        $labels = array();
        $colors = array();
        $lines = array(
            'minimo' => GraficoHelper::$colores['rose_600'],
            'sobresaliente' => GraficoHelper::$colores['green_600'],
        );

        foreach ($this->indicadorable->analisis as $an) {
            $sobresaliente[] = $an->sobresaliente;
            $minimo[] = $an->minimo;
            $bar[] = $an->resultado;
            $labels[] = $an->fecha_medicion_inicio->format('d-M-Y') . ' a ' . $an->fecha_medicion_fin->format('d-M-Y');
            $colors[] = GraficoHelper::asignarColor($an->sobresaliente, $an->minimo, $an->resultado);
        }

        $size = count($sobresaliente);
        if ($size < 5) {
            for ($i = $size; $i < 5; $i++) {
                $sobresaliente[] = 0;
                $minimo[] = 0;
                $bar[] = 0;
                $labels[] = '-';
            }
        }

        $datos = [
            'sobresaliente' => $sobresaliente,
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
