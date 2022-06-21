<?php

namespace App\Lib;

use App\Models\Entidadable;
use App\Models\Escuela;
use Illuminate\Support\Facades\Auth;

class UsuarioHelper
{
    // Retorna las escuelas (con id, nombre, ...) a las que pertenece el usuario logeado
    // Para obtener solo los id, se recomienda hacer: UsuarioHelper::escuelasDelUsuario()->pluck('id');
    public static function escuelasDelUsuario()
    {
        $entidades = Auth::user()->entidades->pluck('id');

        $callback = function ($query) use ($entidades) {
            $query->whereIn('id', $entidades);
        };

        $entidad_escuela = Entidadable::query()
            ->where('entidadable_type', "App\\Models\\Escuela")
            ->whereHas('entidad', $callback)
            ->pluck('entidadable_id');

        $entidad_facultad = Entidadable::query()
            ->where('entidadable_type', "App\\Models\\Facultad")
            ->whereHas('entidad', $callback)
            ->pluck('entidadable_id');

        if (count($entidad_facultad)) {
            return Escuela::whereIn('facultad_id', $entidad_facultad)
                ->orderBy('nombre')->get();
        } else {
            return Escuela::whereIn('id', $entidad_escuela)
                ->orderBy('nombre')->get();
        }
    }
}
