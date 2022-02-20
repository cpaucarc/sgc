<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entidadable extends Model
{
    use HasFactory;

    protected $table = "entidadables";
    public $timestamps = false;
    public $fillable = ['entidadable_id', 'entidadable_type', 'entidad_id'];

    //relacion uno a muchos polimorfica con Escuela, Facultad
    public function entidadable()
    {
        return $this->morphTo();
    }

    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }
}
