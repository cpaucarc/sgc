<?php

namespace App\Http\Livewire\Rsu;

use App\Models\ResponsabilidadSocial;
use Livewire\Component;

class Participantes extends Component
{
    public $rsu_id;
    public $es_responsable;

    public function mount($rsu_id, $es_responsable)
    {
        $this->rsu_id = $rsu_id;
        $this->es_responsable = $es_responsable;
    }

    public function render()
    {
        $rsu = ResponsabilidadSocial::query()
            ->select('id')
            ->withCount('participantes')
            ->with('participantes')
            ->where('id', $this->rsu_id)
            ->first();

        return view('livewire.rsu.participantes', compact('rsu'));
    }
}
