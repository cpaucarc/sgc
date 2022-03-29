<?php

namespace App\Http\Livewire\Admin\Auditoria;

use App\Models\Auditoria;
use App\Models\Facultad;
use Livewire\Component;

class ListaAuditoriaReporte extends Component
{
    public $facultades = null, $facultad = 0;
    public $tipo = -1;

    public function mount()
    {
        $this->facultades = Facultad::query()->orderBy('nombre')->get();
    }

    public function render()
    {
        $auditorias = Auditoria::query()
            ->with('facultad:id,nombre')
            ->withCount('documentos');

        if ($this->tipo > -1) {
            $auditorias = $auditorias->where('es_auditoria_interno', $this->tipo);
        }

        if ($this->facultad > 0) {
            $auditorias = $auditorias->where('facultad_id', $this->facultad);
        }

        $auditorias = $auditorias->orderBy(Facultad::select('nombre')->whereColumn('facultades.id', 'auditorias.facultad_id'))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.admin.auditoria.lista-auditoria-reporte', compact('auditorias'));
    }
}
