<?php

namespace App\Http\Livewire\Admin;

use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Indicador;
use App\Models\Indicadorable;
use Livewire\Component;

class AsignarIndicador extends Component
{
    public $indicador_id;
    public $indicador = null;

    public $open = false;
    public $indicador_en_facultades = null, $ind_fac_actual = [];
    public $indicador_en_escuelas = null, $ind_esc_actual = [];

    public $facultades = null, $facultades_selected = [];
    public $escuelas_not_indicador = null, $escuelas_selected = [];

    public $fac_repetidos = [];

    public function mount($indicador_id)
    {
        $this->indicador_id = $indicador_id;
        $this->indicador = Indicador::find($this->indicador_id);
    }

    public function render()
    {
        $query_fac = Indicadorable::query()
            ->where('indicador_id', $this->indicador_id)
            ->where('indicadorable_type', 'App\Models\Facultad');
        $this->indicador_en_facultades = $query_fac->get();
        $this->ind_fac_actual = $query_fac->pluck('id');

        $query_esc = Indicadorable::query()
            ->where('indicador_id', $this->indicador_id)
            ->where('indicadorable_type', 'App\Models\Escuela');
        $this->indicador_en_escuelas = $query_esc->get();
        $this->ind_esc_actual = $query_esc->pluck('indicadorable_id');

        return view('livewire.admin.asignar-indicador');
    }

    /* Funciones */
    public function openModal()
    {
        $this->open = true;
        $this->facultades = Facultad::all();
    }

    public function updatedFacultadesSelected()
    {
        if (count($this->facultades_selected) === 0) {
            $this->escuelas_not_indicador = null;
        } else {
            $this->escuelas_not_indicador = Escuela::query()
                ->whereIn('facultad_id', function ($query) {
                    $query->select('id')->from('facultades')->whereIn('id', $this->facultades_selected);
                })
                ->whereNotIn('id', $this->ind_esc_actual)->get();
        }
    }

    public function asignarIndicador()
    {
        try {
            if (count($this->facultades_selected) > 0 or count($this->escuelas_selected) > 0) {
                if (count($this->facultades_selected) > 0) {
                    foreach ($this->facultades_selected as $facultad_id) {
                        $facultad = Facultad::select(['abrev', 'nombre'])->where('id', $facultad_id)->first();
                        $exists = Indicadorable::query()
                            ->where('indicador_id', $this->indicador_id)
                            ->where('indicadorable_type', 'App\Models\Facultad')
                            ->where('indicadorable_id', $facultad_id)
                            ->whereIn('id', $this->ind_fac_actual)->get();

                        $this->emit('error', "Hubo un error inesperado " . count($exists));

                        if (count($exists) === 0) {
                            Indicadorable::create([
                                'cod_ind_final' => ($this->indicador->cod_ind_inicial . '-' . $facultad->abrev),
                                'minimo' => $this->indicador->minimo,
                                'sobresaliente' => $this->indicador->sobresaliente,
                                'indicadorable_id' => $facultad_id,
                                'indicadorable_type' => 'App\Models\Facultad',
                                'indicador_id' => $this->indicador_id
                            ]);
                        } else {
                            array_push($this->fac_repetidos, $facultad->nombre);
                        }

                    }
                }
                if (count($this->escuelas_selected) > 0) {
                    foreach ($this->escuelas_selected as $escuela_id) {
                        $escuela = Escuela::select('abrev')->where('id', $escuela_id)->first();
                        Indicadorable::create([
                            'cod_ind_final' => ($this->indicador->cod_ind_inicial . '-' . $escuela->abrev),
                            'minimo' => $this->indicador->minimo,
                            'sobresaliente' => $this->indicador->sobresaliente,
                            'indicadorable_id' => $escuela_id,
                            'indicadorable_type' => 'App\Models\Escuela',
                            'indicador_id' => $this->indicador_id
                        ]);
                    }
                }
                if (count($this->fac_repetidos) > 0) {
                    $msg = "El indicador " . $this->indicador->cod_ind_inicial . " fue asignado con éxito.\n Ya agregados anteriormente:";
                    foreach ($this->fac_repetidos as $reptido) {
                        $msg .= $reptido . "\n";
                    }
                } else {
                    $msg = "El indicador " . $this->indicador->cod_ind_inicial . " fue asignado con éxito.";
                }
                $this->emit('guardado', ['titulo' => 'Indicador asignado', 'mensaje' => $msg]);
                $this->reset(['facultades_selected', 'escuelas_selected', 'open']);
            } else {
                $this->emit('error', "No ha seleccionado una facultad o un programa de estudio");
            }

        } catch (\Exception $e) {
            $this->emit('error', "Hubo un error inesperado \n " . $e);
        }
    }
}
