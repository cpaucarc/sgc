<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $table = "actividades";
    public $timestamps = false;
    public $fillable = ['nombre', 'descripcion', 'tipo_actividad_id', 'proceso_id'];

    public function tipo()
    {
        return $this->belongsTo(TipoActividad::class, 'tipo_actividad_id', 'id');
    }

    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'proceso_id', 'id');
    }
}
