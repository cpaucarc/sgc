<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['actividad_id', 'entidad_id'];

    public function actividad()
    {
        return $this->belongsTo(Actividad::class);
    }

    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }

//    public function salidas()
//    {
//        return $this->hasManyThrough(Salida::class, ResponsableSalida::class, 'salida_id', 'id', 'id', 'salida_id');
//    }

    public function respsalidas()
    {
        return $this->hasMany(ResponsableSalida::class)->with('salida');
    }
}
