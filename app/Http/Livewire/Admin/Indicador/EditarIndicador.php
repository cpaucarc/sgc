<?php

namespace App\Http\Livewire\Admin\Indicador;

use App\Models\Frecuencia;
use App\Models\Indicador;
use App\Models\Proceso;
use App\Models\UnidadMedida;
use Livewire\Component;

class EditarIndicador extends Component
{
    public $indicador_id;

    public $unidades = null, $unidad = 1;
    public $mediciones = null, $medicion = 1;
    public $reportes = null, $reporte = 1;
    public $procesos = null, $proceso = 1;

    public $objetivo;
    public $interes, $total, $resultado;
    public $codigo, $formula;
    public $minimo, $sobresaliente;

    public function mount($indicador_id)
    {
        $this->indicador_id = $indicador_id;

        $this->unidades = UnidadMedida::all();
        $this->mediciones = Frecuencia::all();
        $this->reportes = Frecuencia::all();
        $this->procesos = Proceso::all();

        $indicador = Indicador::query()->where('id', $this->indicador_id)->first();

        $this->objetivo = $indicador->objetivo;
        $this->interes = $indicador->titulo_interes;
        $this->total = $indicador->titulo_total;
        $this->resultado = $indicador->titulo_resultado;
        $this->codigo = $indicador->cod_ind_inicial;
        $this->formula = $indicador->formula;
        $this->minimo = $indicador->minimo;
        $this->sobresaliente = $indicador->sobresaliente;

        $this->unidad = $indicador->unidad_medida_id;
        $this->medicion = $indicador->frecuencia_medicion_id;
        $this->reporte = $indicador->frecuencia_reporte_id;
        $this->proceso = $indicador->proceso_id;
    }

    public function render()
    {
        if ($this->unidad == 1) {
            $this->formula = 'x = ' . $this->resultado;
        } elseif ($this->unidad == 2) {
            $this->formula = 'x = (' . $this->interes . ')/(' . $this->total . ') x 100';
        }

        return view('livewire.admin.indicador.editar-indicador');
    }

//    public function updatedUnidad($value)
//    {
//        $this->emit('error', "Hubo un error inesperado" . $value);
//        if ($value > 0) {
//            if ($value == 1) {
//                $this->formula = 'x = ' . $this->resultado;
//            } elseif ($value == 2) {
//                $this->formula = 'x = (' . $this->interes . ')/(' . $this->total . ') x 100';
//            }
//        }
//    }

    public function actualizar()
    {
        $rules = [
            'objetivo' => 'required',
            'resultado' => 'required',
            'codigo' => 'required|unique:indicadores,cod_ind_inicial,' . $this->indicador_id,
            'formula' => 'required',
            'minimo' => 'required',
            'sobresaliente' => 'required',
            'unidad' => 'required',
            'medicion' => 'required',
            'reporte' => 'required',
            'proceso' => 'required',
        ];

        $this->validate($rules);
        $indicador = Indicador::find($this->indicador_id);
        try {
            $indicador->update([
                'objetivo' => $this->objetivo,
                'titulo_interes' => $this->interes,
                'titulo_total' => $this->total,
                'titulo_resultado' => $this->resultado,
                'cod_ind_inicial' => $this->codigo,
                'formula' => $this->formula,
                'minimo' => $this->minimo,
                'sobresaliente' => $this->sobresaliente,
                'unidad_medida_id' => $this->unidad,
                'frecuencia_medicion_id' => $this->medicion,
                'frecuencia_reporte_id' => $this->reporte,
                'proceso_id' => $this->proceso
            ]);

            $this->reset('objetivo', 'interes', 'total', 'resultado', 'codigo', 'formula', 'minimo', 'sobresaliente');

            $msg = "El indicador " . $this->codigo . " fue actualizado con éxito.";
            $this->emit('guardado', ['titulo' => 'Indicador actualizado', 'mensaje' => $msg]);
            return redirect()->route('admin.panel.indicadores');
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado: \n" . $e);
        }
    }
}
