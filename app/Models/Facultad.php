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
