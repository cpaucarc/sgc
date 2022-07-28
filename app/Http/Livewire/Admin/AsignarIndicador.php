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

    public $facultades_not_indicador = null, $facultades_selected = [];
    public $escuelas_not_indicador = null, $escuelas_selected = [];


    public function mount($indicador_id)
    {
        $this->indicador_id = $indicador_id;
        $this->indicador = Indicador::query()->where('id', $this->indicador_id)->first();
    }

    public function render()
    {
        $query_fac = Indicadorable::query()
            ->where('indicador_id', $this->indicador_id)
            ->where('indicadorable_type', 'App\Models\Facultad');
        $this->indicador_en_facultades = $query_fac->get();
        $this->ind_fac_actual = $query_fac->pluck('indicadorable_id');

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
        $this->facultades_not_indicador = Facultad::query()
            ->whereNotIn('id', $this->ind_fac_actual)->get();
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
        if (count($this->facultades_selected) > 0) {
            foreach ($this->facultades_selected as $facultad) {
                $fac_abrev = Facultad::select('abrev')->where('id', $facultad)->first();
                Indicadorable::create([
                    'cod_ind_final' => ($this->indicador->cod_ind_inicial . '-' . $fac_abrev->abrev),
                    'minimo' => $this->indicador->minimo,
                    'sobresaliente' => $this->indicador->sobresaliente,
                    'indicadorable_id' => $facultad,
                    'indicadorable_type' => 'App\Models\Facultad',
                    'indicador_id' => $this->indicador_id
                ]);
            }
        }
        if (count($this->escuelas_selected) > 0) {
            foreach ($this->escuelas_selected as $escuela) {
                $esc_abrev = Escuela::select('abrev')->where('id', $escuela)->first();
                Indicadorable::create([
                    'cod_ind_final' => ($this->indicador->cod_ind_inicial . '-' . $esc_abrev->abrev),
                    'minimo' => $this->indicador->minimo,
                    'sobresaliente' => $this->indicador->sobresaliente,
                    'indicadorable_id' => $facultad,
                    'indicadorable_type' => 'App\Models\Escuela',
                    'indicador_id' => $this->indicador_id
                ]);
            }
        }
        $this->emit('guardado', ['titulo' => 'Entidad quitado', 'mensaje' => 'guardado']);
    }
}
