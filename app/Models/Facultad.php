<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    use HasFactory;

    protected $table = "facultades";
    public $timestamps = false;
    public $fillable = ['nombre', 'uuid', 'abrev', 'direccion'];

    public function escuelas()
    {
        return $this->hasMany(Escuela::class);
    }

    public function auditorias()
    {
        return $this->hasMany(Auditoria::class);
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
            ->where('esta_implementado', true)
            ->orderBy('proceso_id')
            ->orderBy('cod_ind_inicial');
    }

    public function materialBibliografico()
    {
        return $this->hasMany(MaterialBibliografico::class)->orderBy('fecha_inicio');
    }
}
