<?php

namespace App\Http\Livewire\Admin\Indicador;

use App\Models\Frecuencia;
use App\Models\Indicador;
use App\Models\Proceso;
use App\Models\UnidadMedida;
use Livewire\Component;

class CrearIndicador extends Component
{
    public $open = false;
    public $unidades = null, $unidad = 1;
    public $mediciones = null, $medicion = 1;
    public $reportes = null, $reporte = 1;
    public $procesos = null, $proceso = 1;

    public $objetivo = null;
    public $interes, $total, $resultado;
    public $codigo, $formula;
    public $minimo, $satisfactorio, $sobresaliente;

    protected $rules = [
        'objetivo' => 'required',
        'resultado' => 'required',
        'codigo' => 'required|unique:indicadores,cod_ind_inicial',
        'formula' => 'required',
        'minimo' => 'required',
        'satisfactorio' => 'required',
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
    }

    public function render()
    {
        return view('livewire.admin.indicador.crear-indicador');
    }

    /* Funciones */
    public function openModal()
    {
        $this->open = true;
    }

    public function crearIndicador()
    {
        $this->validate();

        Indicador::create([
            'objetivo' => $this->objetivo,
            'titulo_interes' => $this->interes,
            'titulo_total' => $this->total,
            'titulo_resultado' => $this->resultado,
            'cod_ind_inicial' => $this->codigo,
            'formula' => $this->formula,
            'minimo' => $this->minimo,
            'satisfactorio' => $this->satisfactorio,
            'sobresaliente' => $this->sobresaliente,
            'unidad_medida_id' => $this->unidad,
            'frecuencia_medicion_id' => $this->medicion,
            'frecuencia_reporte_id' => $this->reporte,
            'proceso_id' => $this->proceso
        ]);

        $this->emit('guardado', "El indicador " . $this->codigo . " fue creado con éxito.");
        $this->reset('open', 'objetivo', 'interes', 'total', 'resultado', 'codigo', 'formula', 'minimo', 'satisfactorio', 'sobresaliente');

        $this->emitTo('admin.indicador.lista-indicadores', 'render');
    }
}
