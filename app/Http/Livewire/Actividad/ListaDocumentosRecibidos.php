<?php

namespace App\Http\Livewire\Actividad;

use App\Models\Documento;
use App\Models\DocumentoEnviado;
use App\Models\Proceso;
use App\Models\Salida;
use App\Models\Semestre;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaDocumentosRecibidos extends Component
{
    public $semestres = null;
    public $semestre_seleccionado = null;
    public $entidades = [];
    public $procesos = null;
    public $proceso_seleccionado = null;

    public $salida_seleccionada = null;
    public $open = false;

    public function mount()
    {
        $this->semestres = Semestre::orderBy('nombre', 'desc')->get();
        $this->semestre_seleccionado = $this->semestres->first()->id;

        $this->entidades = Auth::user()->entidades->pluck('id');

        $this->procesos = Proceso::query()
            ->whereIn('id', function ($query) {
                $query->select('proceso_id')->from('actividades')
                    ->whereIn('id', function ($query2) {
                        $query2->select('actividad_id')->from('responsables')
                            ->whereIn('id', function ($query3) {
                                $query3->select('responsable_id')->from('clientes')
                                    ->whereIn('entidad_id', $this->entidades);
                            });
                    });
            })
            ->orderBy('nombre')->get();
        $this->proceso_seleccionado = $this->procesos->first()->id;
    }

    public function render()
    {
        $salidas = Salida::query()
            ->withCount('documentos')
            ->whereIn('id', function ($query) {
                $query->select('salida_id')
                    ->from('clientes')
                    ->whereIn('entidad_id', $this->entidades);
            })
            ->whereHas('documentos', function ($query) {
                $query->whereColumn('documentable_id', 'salidas.id')
                    ->whereHas('documento', function ($q) {
                        $q->where('semestre_id', $this->semestre_seleccionado);
                    });
            })
            ->get();

        return view('livewire.actividad.lista-documentos-recibidos', compact('salidas'));
    }

    public function abrirModal($salida_id)
    {
        $this->salida_seleccionada = Salida::query()
            ->with('documentos', 'documentos.documento.entidad')
            ->whereIn('id', function ($query) {
                $query->select('salida_id')
                    ->from('clientes')
                    ->whereIn('entidad_id', $this->entidades)
                    ->whereIn('responsable_id', function ($query) {
                        $query->select('id')
                            ->from('responsables')
                            ->whereIn('actividad_id', function ($query) {
                                $query->select('id')
                                    ->from('actividades')
                                    ->where('proceso_id', $this->proceso_seleccionado);
                            });
                    });
            })
            ->whereHas('documentos', function ($query) {
                $query->whereColumn('documentable_id', 'salidas.id')
                    ->whereHas('documento', function ($q) {
                        $q->where('semestre_id', $this->semestre_seleccionado);
                    });
            })
            ->where('id', $salida_id)
            ->first();

        $this->open = true;
    }
}
