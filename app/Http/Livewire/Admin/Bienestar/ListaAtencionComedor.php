<?php

namespace App\Http\Livewire\Admin\Bienestar;

use App\Models\BienestarAtencion;
use App\Models\Comedor;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Semestre;
use App\Models\Servicio;
use Livewire\Component;

class ListaAtencionComedor extends Component
{
    public $facultades = null, $facultad = 0;
    public $semestres = null, $semestre = 0;
    public $escuelas = null, $escuela = 0;
    public $servicios = null, $servicio = 0;
    public $anio = 0;


    public function mount()
    {
        $this->facultades = Facultad::query()->orderBy('nombre')->get();
        $this->semestres = Semestre::query()->orderBy('nombre', 'desc')->get();
        $this->servicios = Servicio::query()->select('id', 'nombre')->get();
    }

    public function render()
    {
        $atenciones = BienestarAtencion::query()
            ->select("id", "mes", "anio", "atenciones", "total", "servicio_id", "escuela_id")
            ->with('escuela:id,nombre,facultad_id', 'servicio')
            ->orderBy('mes', 'desc');

        if ($this->facultad > 0) {
            if ($this->escuela > 0) {
                $atenciones = $atenciones->where('escuela_id', $this->escuela);
            } else {
                $atenciones = $atenciones->whereIn('escuela_id', function ($query) {
                    $query->select('id')->from('escuelas')
                        ->where('facultad_id', $this->facultad);
                });
            }
        }

        if ($this->anio > 0) {
            $atenciones = $atenciones->where('anio', $this->anio);
        }

        if ($this->servicio > 0)
            $atenciones = $atenciones->whereIn('servicio_id', function ($query) {
                $query->from('servicios')->select('id')->where('id', $this->servicio);
            });

        $atenciones = $atenciones->get();

        return view('livewire.admin.bienestar.lista-atencion-comedor', compact('atenciones'));
    }

    public function updatedFacultad($value)
    {
        if (intval($value) === 0) {
            $this->escuelas = null;
        } else {
            $this->escuelas = Escuela::query()->where('facultad_id', $value)->orderBy('nombre')->get();
        }
        $this->escuela = 0;
    }
}
