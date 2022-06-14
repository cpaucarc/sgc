<?php

namespace App\Http\Livewire\Rsu;

use App\Models\Entidadable;
use App\Models\ResponsabilidadSocial;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaMisRsu extends Component
{
    public $rsu = null;

    public function render()
    {
//        $entidades = Auth::user()->entidades->pluck('id');
//
//        $callback = function ($query) use ($entidades) {
//            $query->whereIn('id', $entidades);
//        };
//
//        $entidad_escuela = Entidadable::query()
//            ->where('entidadable_type', "App\\Models\\Escuela")
//            ->whereHas('entidad', $callback)
//            ->pluck('entidadable_id');
//
//        $entidad_facultad = Entidadable::query()
//            ->where('entidadable_type', "App\\Models\\Facultad")
//            ->whereHas('entidad', $callback)
//            ->pluck('entidadable_id');

        $this->rsu = ResponsabilidadSocial::query()
            ->select('id', 'uuid', 'titulo', 'lugar', 'fecha_inicio', 'fecha_fin', 'escuela_id', 'empresa_id')
            ->with('escuela:id,nombre', 'empresa:id,nombre,ruc')
            ->where('semestre_id', 3)
            ->whereIn('id', function ($query) {
                $query->select('responsabilidad_social_id')->from('rsu_participantes')
                    ->where('dni_participante', Auth::user()->dni);
            })->get();

//        if (count($entidad_facultad)) { // El usuario pertenece a alguna facultad
//            $rsu = $rsu->whereIn('escuela_id', function ($query) use ($entidad_facultad) {
//                $query->select('id')->from('escuelas')->whereIn('facultad_id', $entidad_facultad);
//            });
//        } else { // El usuario NO pertenece a ninguna facultad
//            $rsu = $rsu->whereIn('escuela_id', $entidad_escuela);
//        }

        return view('livewire.rsu.lista-mis-rsu');
    }
}
