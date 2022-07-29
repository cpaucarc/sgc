<?php

namespace App\Http\Livewire\Actividad;

use App\Models\Cliente;
use App\Models\Documento;
use App\Models\DocumentoEnviado;
use App\Models\Escuela;
use App\Models\Proceso;
use App\Models\ResponsableSalida;
use App\Models\Salida;
use App\Models\Semestre;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaDocumentosRecibidos extends Component
{
    public $open = false;
    public $semestres = null, $semestre = 0;
    public $procesos = null, $proceso = 0;
    public $entidades = [];

    public $resp_salida_seleccionada = null;

    public function mount()
    {
        $this->semestres = Semestre::orderBy('nombre', 'desc')->get();
        $this->semestre = $this->semestres->where('activo', 1)->first()->id;

        $this->entidades = Auth::user()->entidades->pluck('id');

        $this->procesos = Proceso::query()
            ->whereIn('id', function ($query) {
                $query->select('proceso_id')->from('actividades')->whereIn('id', function ($query2) {
                    $query2->select('actividad_id')->from('responsables')->whereIn('id', function ($query3) {
                        $query3->select('responsable_id')->from('responsables_salidas')->whereIn('id', function ($query4) {
                            $query4->select('responsable_salida_id')->from('clientes')->whereIn('entidad_id', $this->entidades);
                        });
                    });
                });
            })->orderBy('nombre')->get();
        $this->proceso = $this->procesos->first()->id;
    }

    public function render()
    {
        $responsable_salidas = ResponsableSalida::query()
            ->with('salida')
            ->withCount(['documentos' => function ($query) {
                $query->whereHas('documento', function ($query2) {
                    $query2->where('semestre_id', $this->semestre);
                });
            }])
            ->whereIn('responsable_id', function ($query) {
                $query->select('id')->from('responsables')->whereIn('actividad_id', function ($query2) {
                    $query2->select('id')->from('actividades')->where('proceso_id', $this->proceso);
                });
            })
            ->whereIn('id', function ($query) {
                $query->select('responsable_salida_id')->from('clientes')->whereIn('entidad_id', $this->entidades);
            })->orderBy(Salida::select('nombre')->whereColumn('salidas.id', 'responsables_salidas.salida_id'))->get();

        return view('livewire.actividad.lista-documentos-recibidos', compact('responsable_salidas'));
    }

    public function abrirModal($resp_salida_id)
    {
        $this->resp_salida_seleccionada = ResponsableSalida::query()
            ->with(['salida', 'documentos' => function ($query) {
                $query->whereHas('documento', function ($query2) {
                    $query2->where('semestre_id', $this->semestre);
                });
            }])->find($resp_salida_id);

        $this->open = true;
    }
}
