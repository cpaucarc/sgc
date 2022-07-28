<?php

namespace App\Http\Livewire\Admin\Indicador;

use App\Models\Frecuencia;
use App\Models\Indicador;
use App\Models\Proceso;
use App\Models\UnidadMedida;
use Livewire\Component;

class CrearIndicador extends Component
{
    public $unidades = null, $unidad = 1;
    public $mediciones = null, $medicion = 1;
    public $reportes = null, $reporte = 1;
    public $procesos = null, $proceso = 1;

    public $objetivo = null;
    public $interes, $total, $resultado;
    public $codigo, $formula;
    public $minimo, $sobresaliente;

    protected $rules = [
        'objetivo' => 'required',
        'resultado' => 'required',
        'codigo' => 'required|unique:indicadores,cod_ind_inicial',
        'formula' => 'required',
        'minimo' => 'required',
        'sobresaliente' => 'required',
        'unidad' => 'required',
        'medicion' => 'required',
        'reporte' => 'required',
        'proceso' => 'required',
    ];

    public function mount()
    {
        $this->unidades = UnidadMedida::all();
        $this->mediciones = Frecuencia::all();
        $this->reportes = Frecuencia::all();
        $this->procesos = Proceso::all();

        $indicador = Indicador::query()
            ->distinct('cod_ind_inicial')
            ->orderBy('cod_ind_inicial', 'desc')
            ->first();
        $numero = intval(substr($indicador->cod_ind_inicial, -3)); //Esto devuelve "ndo)
        if ($numero > 99) {
            $this->codigo = 'IND-' . ($numero + 1);
        } else {
            $this->codigo = 'IND-0' . ($numero + 1);
        }
    }

    public function render()
    {
        if (!is_null($this->interes) or !is_null($this->total) or !is_null($this->resultado)) {
            if ($this->unidad == 1) {
                $this->formula = 'x = ' . $this->resultado;
            } elseif ($this->unidad == 2) {
                $this->formula = 'x = (' . $this->interes . ')/(' . $this->total . ') x 100';
            }
        }

        return view('livewire.admin.indicador.crear-indicador');
    }

    public function crearIndicador()
    {
        $this->validate();
        try {
            Indicador::create([
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
            $msg = "El indicador " . $this->codigo . " fue creado con éxito.";
            $this->emit('guardado', ['titulo' => 'Indicador actualizado', 'mensaje' => $msg]);
            $this->emitTo('admin.indicador.lista-indicadores', 'render');

            return redirect()->route('admin.panel.indicadores');
        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado: \n" . $e);
        }

    }
}
