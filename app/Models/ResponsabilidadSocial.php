<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsabilidadSocial extends Model
{
    use HasFactory;

    protected $table = "responsabilidad_social";
    public $fillable = ['titulo', 'uuid', 'descripcion', 'lugar', 'fecha_inicio', 'fecha_fin', 'semestre_id', 'escuela_id', 'empresa_id'];

    protected $dates = ['fecha_inicio', 'fecha_fin',];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function escuela()
    {
        return $this->belongsTo(Escuela::class);
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function participantes()
    {
        return $this->hasMany(RsuParticipante::class)->orderBy('es_responsable', 'desc');
    }

    public function links()
    {
        return $this->morphMany(EncuestaLink::class, 'encuestable');
    }
}
