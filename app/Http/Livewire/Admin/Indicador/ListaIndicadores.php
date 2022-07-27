<?php

namespace App\Http\Livewire\Admin\Indicador;

use App\Models\Frecuencia;
use App\Models\Indicador;
use App\Models\Proceso;
use App\Models\UnidadMedida;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class ListaIndicadores extends Component
{
    use WithPagination;

    public $search = "";

    public $modal = false;
    public $unidades = null, $unidad = 1;
    public $mediciones = null, $medicion = 1;
    public $reportes = null, $reporte = 1;
    public $procesos = null, $proceso = 1;

    public $objetivo = null;
    public $interes, $total, $resultado;
    public $codigo, $formula;
    public $minimo, $sobresaliente;
    public $indicador_id;

    public function mount()
    {
        $this->unidades = UnidadMedida::all();
        $this->mediciones = Frecuencia::all();
        $this->reportes = Frecuencia::all();
        $this->procesos = Proceso::all();
    }

    public $listeners = ['render'];

    public function render()
    {
        $indicadores = Indicador::query()
            ->with('unidadMedida', 'medicion', 'reporte', 'proceso:id,nombre')
            ->where('cod_ind_inicial', 'like', '%' . $this->search . '%')
            ->orWhere('objetivo', 'like', '%' . $this->search . '%')
            ->orderBy('cod_ind_inicial')
            ->paginate(10);
        return view('livewire.admin.indicador.lista-indicadores', compact('indicadores'));
    }

    /* Funciones */
    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function seleccionar($estado, Indicador $indicador)
    {
        $this->modal = $estado;
        $this->indicador_id = $indicador->id;

        $this->objetivo = $indicador->objetivo;
        $this->interes = ($indicador->titulo_interes);
        $this->total = ($indicador->titulo_total);
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

    public function actualizarIndicador()
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

            $msg = "El indicador " . $this->codigo . " fue actualizado con éxito.";
            $this->emit('guardado', ['titulo' => 'Indicador actualizado', 'mensaje' => $msg]);

            $this->reset('modal', 'objetivo', 'interes', 'total', 'resultado', 'codigo', 'formula', 'minimo', 'sobresaliente', 'indicador_id');
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado: \n" . $e);
        }
    }

    public function cambiarEstado($id, $nuevo_estado)
    {
        Indicador::where('id', $id)->update(['esta_implementado' => $nuevo_estado]);
    }
}
