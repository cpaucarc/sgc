<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsuParticipante extends Model
{
    use HasFactory;

    protected $table = "rsu_participantes";
    public $timestamps = false;
    public $fillable = ['fecha_incorporacion', 'es_responsable', 'es_estudiante', 'dni_participante', 'responsabilidad_social_id'];
    protected $dates = ['fecha_incorporacion',];
}
