<?php

namespace App\Http\Livewire\Rsu;

use App\Models\EncuestaLink;
use App\Models\ResponsabilidadSocial;
use App\Models\RsuParticipante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Encuesta extends Component
{
    public $rsu_id;
    public $es_responsable;
    public $open = false;
    public $fecha_de_expiracion;

    protected $rules = [
        'fecha_de_expiracion' => 'required'
    ];

    public function mount($rsu_id, $es_responsable)
    {
        $this->rsu_id = $rsu_id;
        $this->es_responsable = $es_responsable;
    }

    public function render()
    {
        $rsu = ResponsabilidadSocial::query()
            ->select('id')
            ->withCount('links')
            ->with('links')
            ->where('id', $this->rsu_id)
            ->first();

        return view('livewire.rsu.encuesta', compact('rsu'));
    }

    /* Funciones */
    public function openModal()
    {
        $this->open = true;
    }

    public function crearEncuesta()
    {
        $this->validate();

        $uuid = Str::uuid();

        $encuesta_creada = new EncuestaLink([
            'uuid' => $uuid,
            'link' => route('encuesta.rsu', '?encuesta=' . $uuid),
            'fecha_expiracion' => $this->fecha_de_expiracion,
        ]);

        $rsu = ResponsabilidadSocial::find($this->rsu_id);
        $rsu->links()->save($encuesta_creada);


        $this->open = false;
    }
}
