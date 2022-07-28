<?php

namespace App\Http\Livewire\Actividad;

use App\Models\Cliente;
use App\Models\Documento;
use App\Models\DocumentoEnviado;
use App\Models\Proceso;
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

    public $salida_seleccionada = null;

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
        $salidas = Salida::query()
            ->withCount(['documentos' => function ($query) {
                $query->whereHas('documento', function ($query2) {
                    $query2->where('semestre_id', $this->semestre);
                });
            }])
            ->whereIn('id', function ($query) {
                $query->select('salida_id')->from('responsables_salidas')
                    ->whereIn('id', function ($query2) {
                        $query2->select('responsable_salida_id')->from('clientes')->whereIn('entidad_id', $this->entidades);
                    })
                    ->whereIn('responsable_id', function ($query2) {
                        $query2->select('id')->from('responsables')->whereIn('actividad_id', function ($query3) {
                            $query3->select('id')->from('actividades')->where('proceso_id', $this->proceso);
                        });
                    });
            })->get();

        return view('livewire.actividad.lista-documentos-recibidos', compact('salidas'));
    }

    public function abrirModal($salida_id)
    {
        $this->salida_seleccionada = Salida::query()
            ->with(['documentos' => function ($query) {
                $query->whereHas('documento', function ($query2) {
                    $query2->where('semestre_id', $this->semestre);
                });
            }])->find($salida_id);

//            ->with('documentos', 'documentos.documento.entidad')
//            ->whereIn('id', function ($query) {
//                $query->select('salida_id')
//                    ->from('clientes')
//                    ->whereIn('entidad_id', $this->entidades)
//                    ->whereIn('responsable_id', function ($query) {
//                        $query->select('id')
//                            ->from('responsables')
//                            ->whereIn('actividad_id', function ($query) {
//                                $query->select('id')
//                                    ->from('actividades')
//                                    ->where('proceso_id', $this->proceso_seleccionado);
//                            });
//                    });
//            })
//            ->whereHas('documentos', function ($query) {
//                $query->whereColumn('documentable_id', 'salidas.id')
//                    ->whereHas('documento', function ($q) {
//                        $q->where('semestre_id', $this->semestre_seleccionado);
//                    });
//            })
//            ->where('id', $salida_id)
//            ->first();
//
        $this->open = true;
    }
}
