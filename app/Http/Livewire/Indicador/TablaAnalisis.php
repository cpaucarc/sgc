<?php

namespace App\Http\Livewire\Indicador;

use App\Models\AnalisisIndicador;
use App\Models\Capacitacion;
use App\Models\Curso;
use App\Models\Indicador;
use App\Models\Indicadorable;
use App\Models\Semestre;
use App\Models\Servicio;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class TablaAnalisis extends Component
{
    public $oficina, $tipo, $uuid;
    public $indicadorable_id, $indicadorable;
    public $open = false;
    public $openEdit = false, $analisis_seleccionado = null, $modoEdit = false;
    public $interpretacion = null, $observacion = null, $elaborado_por = null, $revisado_por = null, $aprobado_por = null;
    public $tieneCursos = false, $cursos = null, $semestres = null;
    public $tieneCapacitaciones = false, $capacitaciones = null;
    public $tieneServicios = false, $servicios = null;
    public $curso_seleccionado = 0, $capacitacion_seleccionado = 0, $servicio_seleccionado = 0, $semestre_seleccionado = 0;

    protected $listeners = ['renderizarTabla' => 'render'];

    public function mount($indicadorable_id, $oficina, $tipo, $uuid)
    {
        $this->indicadorable_id = $indicadorable_id;
        $this->oficina = $oficina;
        $this->tipo = $tipo;
        $this->uuid = $uuid;
        $this->semestres = Semestre::query()->orderBy('id', 'desc')->get();
    }

    public function render()
    {
        $this->indicadorable = Indicadorable::query()
            ->with('indicador:id,cod_ind_inicial,titulo_interes,titulo_total,titulo_resultado')
            ->with(['analisis' => function ($query) {
                if ($this->semestre_seleccionado > 0) {
                    $query->where('semestre_id', $this->semestre_seleccionado);
                }

                if ($this->curso_seleccionado > 0) {
                    $query->whereIn('id', function ($query2) {
                        $query2->select('analisis_indicador_id')->from('analisis_cursos')
                            ->where('curso_id', $this->curso_seleccionado);
                    });
                }

                if ($this->capacitacion_seleccionado > 0) {
                    $query->whereIn('id', function ($query2) {
                        $query2->select('analisis_indicador_id')->from('analisis_capacitaciones')
                            ->where('capacitacion_id', $this->capacitacion_seleccionado);
                    });
                }

                if ($this->servicio_seleccionado > 0) {
                    $query->whereIn('id', function ($query2) {
                        $query2->select('analisis_indicador_id')->from('analisis_servicios')
                            ->where('servicio_id', $this->servicio_seleccionado);
                    });
                }

                $query->with(['semestre', 'curso', 'capacitacion', 'servicio']);
            }])->findOrFail($this->indicadorable_id);

        if (in_array($this->indicadorable->indicador->cod_ind_inicial, ['IND-032', 'IND-033', 'IND-034'])) {
            $this->tieneCursos = true;
        }

        if (in_array($this->indicadorable->indicador->cod_ind_inicial, ['IND-075'])) {
            $this->tieneCapacitaciones = true;
        }

        if (in_array($this->indicadorable->indicador->cod_ind_inicial, ['IND-019'])) {
            $this->tieneServicios = true;
        }

        if ($this->tieneCursos && is_null($this->cursos)) {
            $this->cursos = Curso::query()
                ->whereIn('id', function ($query) {
                    $query->select('curso_id')->from('analisis_cursos')
                        ->whereIn('analisis_indicador_id', function ($quuer2) {
                            $quuer2->select('id')->from('analisis_indicador')
                                ->where('indicadorable_id', $this->indicadorable->id);
                        });
                })->get();
        }

        if ($this->tieneCapacitaciones && is_null($this->capacitaciones)) {
            $this->capacitaciones = Capacitacion::query()
                ->whereIn('id', function ($query) {
                    $query->select('capacitacion_id')->from('analisis_capacitaciones')
                        ->whereIn('analisis_indicador_id', function ($quuer2) {
                            $quuer2->select('id')->from('analisis_indicador')
                                ->where('indicadorable_id', $this->indicadorable->id);
                        });
                })->get();
        }

        if ($this->tieneServicios && is_null($this->servicios)) {
            $this->servicios = Servicio::query()
                ->whereIn('id', function ($query) {
                    $query->select('servicio_id')->from('analisis_servicios')
                        ->whereIn('analisis_indicador_id', function ($quuer2) {
                            $quuer2->select('id')->from('analisis_indicador')
                                ->where('indicadorable_id', $this->indicadorable->id);
                        });
                })->get();
        }

        return view('livewire.indicador.tabla-analisis');
    }

    /* Funciones */
    public function openModal()
    {
        $this->emitTo('indicador.nuevo-analisis', 'openModal');
    }

    public function openGraph()
    {
        $this->emitTo('indicador.grafico-general', 'renderizarGrafico', $this->semestre_seleccionado, $this->curso_seleccionado, $this->capacitacion_seleccionado, $this->servicio_seleccionado);
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
