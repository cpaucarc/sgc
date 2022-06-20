<?php

namespace App\Http\Livewire\Auditoria;

use App\Models\Auditoria;
use App\Models\Documento;
use App\Models\Entidadable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaAuditorias extends Component
{
    public $open = false;
    public $auditoria_seleccionado = null;
    public $documentos = null;
    public $auditoria = -1;

    public function render()
    {
        $facultad_id = Entidadable::query()
            ->where('entidadable_type', 'App\\Models\\Facultad')
            ->whereIn('entidad_id', function ($query) {
                $query->select('id')->from('entidades')->whereIn('id', function ($query2) {
                    $query2->select('entidad_id')->from('entidad_user')->where('user_id', Auth::user()->id);
                });
            })->get()->pluck('entidadable_id');

        $auditorias = Auditoria::query()
            ->withCount('documentos')
            ->whereIn('facultad_id', $facultad_id)
            ->with('facultad:id,nombre')
            ->get();

        if ($this->auditoria > -1) {
            $auditorias = $auditorias->where('es_auditoria_interno', $this->auditoria);
        }

        return view('livewire.auditoria.lista-auditorias', compact('auditorias'));
    }

    /* Funciones */
    public function abrirModal($auditoria_id)
    {
        $this->open = true;

        $this->auditoria_seleccionado = Auditoria::query()
            ->with('facultad:id,nombre')
            ->where('id', $auditoria_id)
            ->first();

        $this->documentos = Documento::query()
            ->whereIn('id', function ($query) {
                $query->select('documento_id')
                    ->from('documento_enviado')
                    ->where('documentable_id', $this->auditoria_seleccionado->id)
                    ->where('documentable_type', 'App\\Models\\Auditoria');
            })
            ->get();

    }
}
