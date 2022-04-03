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

    public function investigaciones()
    {
        return $this->hasMany(Investigacion::class)
            ->with('estado')
            ->orderBy('estado_id');
    }

    public function bibliotecaVisitante()
    {
        return $this->hasMany(BibliotecaVisitante::class)->orderBy('fecha_fin');
    }

    public function bolsaPostulante()
    {
        return $this->hasMany(BolsaPostulante::class)->orderBy('fecha_fin');
    }

    public function comedor()
    {
        return $this->hasMany(Comedor::class)->orderBy('mes');
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
        return $this->morphToMany(Indicador::class, 'indicadorable')
            ->with('proceso', 'medicion')
            ->orderBy(Proceso::select('nombre')->whereColumn('procesos.id', 'indicadores.proceso_id'))
            ->orderBy('cod_ind_inicial');
    }
}
