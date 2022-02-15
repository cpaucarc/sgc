<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncuestaRespuesta extends Model
{
    use HasFactory;

    protected $table = "encuesta_respuestas";
    public $fillable = ['respuesta', 'pregunta_id', 'encuestado_id', 'encuesta_id'];
}
