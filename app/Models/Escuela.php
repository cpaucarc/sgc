<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['nombre', 'uuid', 'abrev', 'facultad_id'];

    public function facultad()
    {
        return $this->belongsTo(Facultad::class)->orderBy('nombre');
    }

    public function convalidacion()
    {
        return $this->hasMany(Convalidacion::class)->orderBy('created_at');
    }

    public function rsu()
    {
        return $this->hasMany(ResponsabilidadSocial::class)->orderBy('fecha_fin');
    }

    // relacion uno a muchos polimorfica
    public function entidades()
    {
        return $this->morphMany(Entidadable::class, 'entidadable')
            ->with('entidad');
    }

    // relación muchos a muchos polimorfica
    public function indicadores()
    {
        return $this->morphToMany(Indicador::class, 'indicadorable');
    }
}
